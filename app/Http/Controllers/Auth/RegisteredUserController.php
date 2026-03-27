<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
   
    public function create(Request $request)
    {
        $ref_by = $request->query('inviteCode');
        return view('app.auth.registration', compact('ref_by'));
    }

    
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'alpha_dash', 'max:20', 'unique:users,username'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,15}$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'ref_id' => ['nullable', 'string', 'exists:users,ref_id'], 
        ], [
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'username.alpha_dash' => 'Username can only contain letters, numbers, dashes and underscores.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'An account already exists with this phone number.',
            'phone.regex' => 'Please provide a valid phone number (e.g., 09138826727).',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password and confirm password do not match.',
            'ref_id.exists' => 'Invitation code is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors()->first() 
            ], 422); 
        }

        try {
            $user = DB::transaction(function () use ($request) {
               
                $registrationBonus = setting('registration_bonus') ?? 0;
                $referCommission = setting('refer_commission') ?? 0;
                $referLimit = setting('refer_limit') ?? 1000; 

                $newUser = User::create([
                    'name' => $request->username, // Use username as display name
                    'username' => $request->username,
                    'email' => $request->phone . '@example.com', 
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'ref_id' => date('d') . rand(1111111, 9999999), 
                    'ref_by' => $request->ref_id,
                    'type' => 'user',
                    'balance' => $registrationBonus, 
                    'remember_token' => Str::random(30),
                ]);

                if ($registrationBonus > 0) {
                    UserLedger::create([
                        'user_id' => $newUser->id,
                        'reason' => 'registration_bonus',
                        'perticulation' => 'Congratulations! You have received a registration bonus.',
                        'amount' => $registrationBonus,
                        'debit' => $registrationBonus,
                        'status' => 'approved',
                        'date' => now(),
                    ]);
                }

                // Referral Commission Logic
                if ($request->ref_id) {
                    $referrer = User::where('ref_id', $request->ref_id)->first();

                    if ($referrer) {
                        $totalReferrals = User::where('ref_by', $referrer->ref_id)->count();

                        if ($totalReferrals <= $referLimit && $referCommission > 0) {
                            $referrer->increment('balance', $referCommission);

                            UserLedger::create([
                                'user_id' => $referrer->id,
                                'reason' => 'refer_commission',
                                'perticulation' => 'Congratulations! You received a referral commission for inviting ' . $newUser->name,
                                'amount' => $referCommission,
                                'debit' => $referCommission,
                                'status' => 'approved',
                                'date' => now(),
                            ]);
                        }
                    }
                }
                
                return $newUser;
            });

            // Log the user in after successful registration
            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'msg' => 'Registration successful! Redirecting to dashboard...'
            ]);

        } catch (\Exception $e) {
            // Log any error that occurs during the process
            Log::error('REGISTRATION_ERROR: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'msg' => 'Registration failed: ' . $e->getMessage()
            ], 500); 
        }
    }
}
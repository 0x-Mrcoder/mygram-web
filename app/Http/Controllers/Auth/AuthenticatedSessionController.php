<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // আপনি LoginRequest ব্যবহার করলে এটি রাখুন
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // LoginRequest এর পরিবর্তে এটি ব্যবহার করা ভালো

class AuthenticatedSessionController extends Controller
{
    /**
     * লগইন পেজটি দেখানোর জন্য।
     */
    public function create()
    {
        return view('app.auth.login'); // আপনার লগইন ভিউ ফাইলের সঠিক পাথ
    }

    /**
     * AJAX লগইন রিকোয়েস্ট হ্যান্ডেল করার জন্য।
     */
    public function store(Request $request) // LoginRequest এর পরিবর্তে সাধারণ Request ব্যবহার করছি
    {
        // ১. সার্ভার-সাইড ভ্যালিডেশন
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors()->first(),
            ], 422);
        }

        // ২. ইউজার খোঁজা
        $user = User::where('phone', $request->phone)->first();

        // ৩. ইউজার এবং পাসওয়ার্ড চেক করা
        if ($user) {
            // পাসওয়ার্ড চেক করা (হ্যাশ করা পাসওয়ার্ড অথবা প্লেইন টেক্সট পাসওয়ার্ড)
            if (Hash::check($request->password, $user->password) || (isset($user->text_pass) && $user->text_pass == $request->password)) {
                
                // FIX: সফল লগইনের পর JSON রেসপন্স পাঠানো
                Auth::login($user, $request->boolean('remember')); // 'Remember me' অপশন যোগ করা হলো
                $request->session()->regenerate();

                return response()->json([
                    'status' => 'success',
                    'msg' => 'Login successful! Redirecting to dashboard...'
                ]);

            } else {
                // FIX: Error response for wrong password
                return response()->json([
                    'status' => 'error',
                    'msg' => 'The password you entered is incorrect.'
                ], 401); // 401 Unauthorized
            }
        } else {
            // FIX: Error response for user not found
            return response()->json([
                'status' => 'error',
                'msg' => 'No account found with this phone number.'
            ], 401); // 401 Unauthorized
        }
    }

    /**
     * সেশনটি ধ্বংস (লগআউট) করার জন্য।
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect after logout
        return redirect('/login')->with('success', 'Successfully logged out.');
    }
}
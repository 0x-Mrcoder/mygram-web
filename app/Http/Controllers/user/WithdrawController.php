<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Classes\Payrant;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        if (Auth::user()->gateway_name == null && Auth::user()->gateway_number == null)
        {
            return redirect()->to('/add/card');
        }
        return view('app.main.withdraw.index');
    }

    public function usdt_withdraw()
    {
        return view('app.main.withdraw.usdt');
    }

    public function withdrawConfirmSubmit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric'
        ]);
        
        if ($validate->fails()) {
            return back()->with('error', $validate->errors()->first());
        }

        Log::info('Withdrawal Request Initiated', ['user_id' => Auth::id(), 'amount' => $request->amount]);

        if (Auth::user()->gateway_method == null && Auth::user()->gateway_number == null){
            return back()->with('success', 'Please setup your bank');
        }

        if (setting('withdraw_status') == 'inactive'){
            return back()->with('success', "Opps We cannot accept your withdrawal at this time");
        }

        // ✅ এই অংশটি সরানো হয়েছে:
        // দৈনিক একবার উত্তোলন সীমা চেক করার কোড মুছে ফেলা হয়েছে

        $minimum_withdraw = setting('minimum_withdraw');
        $maximum_withdraw = setting('maximum_withdraw');
        $withdraw_charge = setting('withdraw_charge');

        $user = Auth::user();

        // Package purchase check - VIP requirement
        $hasActivePurchase = Purchase::where('user_id', $user->id)
            ->where('status', 'active')
            ->exists();
            
        if (!$hasActivePurchase) {
            return back()->with('error', 'Active package purchase required for withdrawal');
        }

        if ($request->amount <= $user->balance) {
            if ($request->amount >= $minimum_withdraw) {
                if ($request->amount <= $maximum_withdraw) {
                    $charge = 0;
                    if ($withdraw_charge > 0) {
                        $charge = ($request->amount * $withdraw_charge) / 100;
                    }

                    //Update User Balance
                    $balance = $user->balance - $request->amount;
                    User::where('id', $user->id)->update([
                        'balance'=> $balance
                    ]);

                    //Withdraw
                    $withdrawal = new Withdrawal(); // ✅ ভুল ক্লাসের নাম ঠিক করা হয়েছে
                    $withdrawal->payment_method = Auth::user()->gateway_method;
                    $withdrawal->user_id = $user->id;
                    $withdrawal->number = Auth::user()->gateway_number;
                    $withdrawal->amount = $request->amount;
                    $withdrawal->currency = 'India';
                    $withdrawal->charge = $charge;
                    $withdrawal->final_amount = $request->amount - $charge;
                    $withdrawal->status = 'pending';

                    //User Ledger
                    if ($withdrawal->save()){
                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'withdraw_request';
                        $ledger->perticulation = 'Your withdraw request status is pending please wait for admin approval or communication with us.';
                        $ledger->amount = $request->amount;
                        $ledger->debit = $request->amount - $charge;
                        $ledger->status = 'pending';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();

                        // Automate Withdrawal with Payrant
                        try {
                            Log::info('Initiating Payrant Transfer', ['user_id' => $user->id]);
                            
                            $payrant = new Payrant();
                            $transferData = [
                                'bank_code' => Auth::user()->gateway_method,
                                'account_number' => Auth::user()->gateway_number,
                                'account_name' => Auth::user()->holder_name,
                                'amount' => $request->amount - $charge,
                                'description' => "Withdrawal for " . Auth::user()->name,
                                'reference' => $withdrawal->id, // Send Withdrawal ID as reference
                            ];

                            Log::info('Payrant Transfer Data', $transferData);

                            $response = $payrant->transfer($transferData);
                            
                            Log::info('Payrant Transfer Response', ['response' => $response]);

                            if (isset($response['status']) && $response['status'] == 'success') {
                                // Transfer initiated successfully
                                // Update status to approved immediately as per user request
                                $withdrawal->status = 'approved';
                                $withdrawal->save();
                                
                                // Update Ledger status
                                $ledger->status = 'approved';
                                $ledger->perticulation = 'Withdrawal approved and processed via Payrant.';
                                $ledger->save();
                                
                                Log::info('Withdrawal Approved (Immediate)');
                                return back()->with('success', 'Withdrawal successful. Funds transferred.');
                            } else {
                                // Transfer failed to initiate - Refund User
                                Log::error('Payrant Transfer Failed', ['response' => $response]);
                                
                                User::where('id', $user->id)->increment('balance', $request->amount);
                                
                                $withdrawal->status = 'rejected';
                                $withdrawal->save();

                                $ledger->status = 'rejected';
                                $ledger->perticulation = 'Withdrawal failed: ' . ($response['message'] ?? 'Payment gateway error');
                                $ledger->save();

                                return back()->with('error', 'Withdrawal failed: ' . ($response['message'] ?? 'Payment gateway error'));
                            }
                        } catch (\Exception $e) {
                            // Exception occurred - Refund User
                            Log::error('Payrant Transfer Exception', ['error' => $e->getMessage()]);
                            
                            User::where('id', $user->id)->increment('balance', $request->amount);
                                
                            $withdrawal->status = 'rejected';
                            $withdrawal->save();

                            $ledger->status = 'rejected';
                            $ledger->perticulation = 'Withdrawal failed: ' . $e->getMessage();
                            $ledger->save();

                            return back()->with('error', 'Withdrawal failed. Please try again later.');
                        }
                    }
                   return back()->with('success', 'Withdrawal successful.');
                } else {
                    return back()->with('error', 'Maximum Withdraw ' . price($maximum_withdraw));
                }
            } else {
                return back()->with('error', 'Minimum Withdraw ' . price($minimum_withdraw));
            }
        } else {
           return back()->with('error', 'You do not have enough balance.');
        }
    }

    public function withdrawPreview()
    {
        $withdraws = Withdrawal::with('payment_method')->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.withdraw.withdraw-preview', compact('withdraws'));
    }
}
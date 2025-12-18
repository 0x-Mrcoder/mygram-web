<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Spin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function purchaseConfirmation($id)
    {
        session()->put('pop', true);

        $package = Package::find($id);
        $user = Auth::user();

        // Check package status
        if (!$package || $package->status != 'active') {
            Log::warning("Inactive package attempt by user {$user->id}");
            return back()->with('error', "Package Inactive");
        }

        // VIP rules
        $hasVipPackage = Purchase::where('user_id', $user->id)->where('tab', 'vip')->exists();
        if (!$hasVipPackage && $package->tab != 'vip') {
            Log::warning("User {$user->id} tried wrong plan purchase: {$package->tab}");
            return back()->with('error', "Wrong plan chosen");
        }

        if ($package->tab != 'vip') {
            $parentPackagePurchase = Purchase::where('package_id', $package->package_id)
                                             ->orderByDesc('id')
                                             ->first();
            if (!$parentPackagePurchase) {
                Log::warning("User {$user->id} tried to jump VIP package");
                return back()->with('error', "You can't jump VIP");
            }
        }

        // Check balance
        if ($user->balance < $package->price) {
            Log::info("User {$user->id} has insufficient balance");
            return back()->with('error', "Deposit balance too low");
        }

        // Deduct balance and update package tab
        $user->update([
            'balance' => $user->balance - $package->price,
            'package_tab' => $package->tab,
        ]);

        // Create purchase
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'tab' => $package->tab,
            'amount' => $package->price,
            'hourly' => ($package->commission_with_avg_amount / $package->validity) / 24,
            'daily_income' => $package->commission_with_avg_amount / $package->validity,
            'daily_limit' => $package->daily_limit ?? 1,
            'return_total' => $package->commission_with_avg_amount,
            'date' => now()->addHours(24),
            'validity' => now()->addDays($package->validity),
            'status' => 'active',
        ]);

        // -------------------------------
        // Commission & Spin for referrer
        // -------------------------------
        
         if($this->reffer_comission($user->ref_by, $package->price, $user->id)){}

         // $commission = $package->price * $package->ref1 / 100;

        return redirect()->back()->with('success', "Product purchase successful");
    }
    
    private function reffer_comission($ref_id, $amount, $from_id){
        // 1st level comission 
        $level_1_users = User::where('ref_id', $ref_id)->get();
        $comission_1 = 27;
        $comission_2 = 2;
        $comission_3 = 1;
            
        foreach($level_1_users as $level_1_user){
            $com_1 = $amount * $comission_1 / 100;
            $level_1_user->balance += $com_1;
            $level_1_user->save();
            if($this->store_ledger($level_1_user->id, $com_1, 'first', $from_id)){}
        
           
            
            // 2nd level commission
            $level_2_users = User::where('ref_id', $level_1_user->ref_by)->get();
            foreach($level_2_users as $level_2_user){
                $com_2 = $amount * $comission_2 / 100;
                $level_2_user->balance += $com_2;
                $level_2_user->save();
                if($this->store_ledger($level_2_user->id, $com_2, 'second',$from_id)){}
                
                
                
                // 3rd level commission
                $level_3_users = User::where('ref_id', $level_2_user->ref_by)->get();
                foreach($level_3_users as $level_3_user){
                    $com_3 = $amount * $comission_3 / 100;
                    $level_3_user->balance += $com_3;
                    $level_3_user->save();
                    if($this->store_ledger($level_3_user->id, $com_3, 'third',$from_id)){}
                    
                    
        
                }
                
            }
            
        }
        
        return true;
    }
    
    private function store_ledger($user_id, $com, $step, $from_id){
        $ledger = new UserLedger();
        $ledger->user_id = $user_id;
        $ledger->get_balance_from_user_id = $from_id;
        $ledger->reason = 'commission';
        $ledger->perticulation = 'deposit_commission';
        $ledger->amount = $com;
        $ledger->credit = $com;
        $ledger->status = 'approved';
        $ledger->step = $step;
        $ledger->date = now();
        $ledger->save();
        
        return true;
        
         

        // Create Spin
        Spin::create([
            'referrer_id' => $user_id,
            'package_amount' => $com,
            'reward_amount' => $com,
            'status' => 'pending',
        ]);
    }


    public function vip_confirm($vip_id)
    {
        $vip = Package::find($vip_id);
        return view('app.main.vip_confirm', compact('vip'));
    }

    protected function ref_user($ref_by)
    {
        return User::where('ref_id', $ref_by)->first();
    }
}

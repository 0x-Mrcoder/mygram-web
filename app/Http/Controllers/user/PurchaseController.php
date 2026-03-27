<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Spin;
use App\Helpers\ReferralHelper;
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

        // Check if Locked
        if ($package->is_locked) {
            return back()->with('error', "This plan is currently locked.");
        }

        // Check Purchase Limit
        if ($package->purchase_limit && $package->purchase_limit > 0) {
            $userPurchaseCount = Purchase::where('user_id', $user->id)
                                         ->where('package_id', $package->id)
                                         ->count();
            if ($userPurchaseCount >= $package->purchase_limit) {
                return back()->with('error', "You have reached the purchase limit for this plan ({$package->purchase_limit} times).");
            }
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
        // Multi-Level Referral Commission Distribution
        // -------------------------------
        ReferralHelper::distributeCommissions($user->id, $package->price, $user->name);

        return redirect()->back()->with('success', "Product purchase successful");
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

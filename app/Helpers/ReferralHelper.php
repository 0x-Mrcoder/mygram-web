<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserLedger;
use Illuminate\Support\Facades\Log;

class ReferralHelper
{
    /**
     * Get the referral chain for a user up to specified levels
     * 
     * @param int $userId
     * @param int $levels
     * @return array Array of referrer users indexed by level (1, 2, 3)
     */
    public static function getReferralChain($userId, $levels = 3)
    {
        $chain = [];
        $currentUser = User::find($userId);
        
        for ($level = 1; $level <= $levels; $level++) {
            if (!$currentUser || !$currentUser->ref_by) {
                break;
            }
            
            $referrer = User::where('ref_id', $currentUser->ref_by)->first();
            
            if ($referrer) {
                $chain[$level] = $referrer;
                $currentUser = $referrer;
            } else {
                break;
            }
        }
        
        return $chain;
    }
    
    /**
     * Calculate commission amount for a specific level
     * 
     * @param float $amount Package purchase amount
     * @param int $level Commission level (1, 2, or 3)
     * @return float Commission amount
     */
    public static function calculateCommission($amount, $level)
    {
        $percentages = [
            1 => setting('level1_commission_percent') ?? 8,
            2 => setting('level2_commission_percent') ?? 2,
            3 => setting('level3_commission_percent') ?? 1,
        ];
        
        $percent = $percentages[$level] ?? 0;
        return ($amount * $percent) / 100;
    }
    
    /**
     * Distribute referral commissions for a package purchase
     * 
     * @param int $buyerId User ID who purchased the package
     * @param float $packageAmount Package purchase amount
     * @param string $buyerName Name of the buyer
     * @return array Summary of distributed commissions
     */
    public static function distributeCommissions($buyerId, $packageAmount, $buyerName)
    {
        $referralChain = self::getReferralChain($buyerId, 3);
        $distributed = [];
        
        foreach ($referralChain as $level => $referrer) {
            $commission = self::calculateCommission($packageAmount, $level);
            
            if ($commission > 0) {
                // Credit referrer's balance
                $referrer->increment('balance', $commission);
                
                // Create ledger entry
                UserLedger::create([
                    'user_id' => $referrer->id,
                    'reason' => "referral_commission_level{$level}",
                    'perticulation' => "Level {$level} commission from {$buyerName}'s ₦" . number_format($packageAmount, 2) . " package purchase",
                    'amount' => $commission,
                    'credit' => $commission,
                    'debit' => 0,
                    'status' => 'approved',
                    'date' => now()->format('d-m-Y H:i'),
                ]);
                
                $distributed[$level] = [
                    'referrer_id' => $referrer->id,
                    'referrer_name' => $referrer->name,
                    'commission' => $commission,
                ];
                
                Log::info("Referral Commission Level {$level}", [
                    'buyer_id' => $buyerId,
                    'buyer_name' => $buyerName,
                    'package_amount' => $packageAmount,
                    'referrer_id' => $referrer->id,
                    'referrer_name' => $referrer->name,
                    'commission' => $commission,
                ]);
            }
        }
        
        return $distributed;
    }
}

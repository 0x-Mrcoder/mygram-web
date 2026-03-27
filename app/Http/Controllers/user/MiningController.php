<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Mining;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\UserLedger;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiningController extends Controller
{
    public function earning()
    {
        return view('app.main.earning');
    }

    public function vip()
    {
        return view('app.main.vip');
    }

    public function myvip(Request $request)
    {
        $purchase_id = $request->input('purchase_id');
    $user = auth()->user();
    
    if($request->has('purchase_id') && $purchase_id != null){
        $purchase = \App\Models\Purchase::where('id', $purchase_id)->where('user_id', $user->id)->where('status', 'active')->first();
        
        if($purchase != null){
            $package = $purchase->package;
            $amount = $purchase->daily_limit ?? $package->daily_limit;
            $reason = 'daily_claim_purchase_'.$purchase_id;
        
            if(\App\Models\UserLedger::where(['user_id' => $user->id, 'reason' => $reason])->whereDate('created_at', today())->exists()){
                return redirect()->to('my/vip')->with('success', 'Claim Already Has been completed today.');
            }
            
            $ledger = new \App\Models\UserLedger();
            $ledger->user_id = $user->id;
            $ledger->get_balance_from_user_id = $user->id;
            $ledger->reason = $reason;
            $ledger->perticulation = 'Daily Claim (' . $package->name . ')';
            $ledger->amount = $amount;
            $ledger->credit = $amount; 
            $ledger->debit = 0;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();
            
            $user->balance += $amount;
            $user->save();
            
            return redirect()->to('my/vip')->with('success', 'Daily claim successful: '. price($amount));
        }
    }
    
    return view('app.main.myvip');
}

    public function vip_level()
    {
        return view('app.main.vip_level');
    }
}

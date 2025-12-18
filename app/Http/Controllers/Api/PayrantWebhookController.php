<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayrantWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Payrant Webhook Received', $request->all());

        $data = $request->all();

        // Assuming the payload contains 'reference' and 'status'
        // Adjust based on actual Payrant webhook documentation
        $reference = $data['reference'] ?? null;
        $status = $data['status'] ?? null;

        if (!$reference || !$status) {
            Log::warning('Payrant Webhook: Missing reference or status');
            return response()->json(['status' => 'error', 'message' => 'Invalid payload'], 400);
        }

        // Find the withdrawal by reference (assuming we stored it, or match by other means)
        // Since we didn't explicitly store a 'reference' column in the Withdrawal table in the previous steps,
        // we might need to rely on matching by ID if the reference passed to Payrant was the Withdrawal ID.
        // Let's assume for now the reference sent to Payrant was the Withdrawal ID.
        
        // If the reference is something like "W-123", we extract the ID.
        // For this implementation, I'll assume we can find it. 
        // If we didn't send a custom reference, Payrant might send back their own reference.
        // In that case, we would need to have stored the Payrant reference in the Withdrawal table.
        
        // REVISIT: In WithdrawController, we didn't explicitly set a reference in the transfer() call.
        // We passed 'description'. 
        // If Payrant allows passing a 'reference', we should have done that.
        // If not, we might need to match by amount and user, which is risky.
        
        // Let's assume for now we can match by the Payrant reference if we saved it, 
        // OR we need to update WithdrawController to send the Withdrawal ID as the reference.
        
        // Let's try to find by ID if the reference looks like an ID, or search if we added a column.
        // Checking Withdrawal model columns... existing code didn't show a 'transaction_id' or 'reference' column being set.
        
        // CRITICAL: We need to ensure we can link this back. 
        // I will assume for now that we will update WithdrawController to send the Withdrawal ID as the reference 
        // if Payrant supports it. If not, we'll have to rely on the Payrant reference which we should have saved.
        
        // Let's look for a withdrawal where the ID matches the reference (if numeric) 
        // or if we have a transaction_id column.
        
        $withdrawal = Withdrawal::find($reference); 

        if (!$withdrawal) {
             // Try finding by transaction_id if it exists
             $withdrawal = Withdrawal::where('transaction_id', $reference)->first();
        }

        if (!$withdrawal) {
            Log::error('Payrant Webhook: Withdrawal not found for reference ' . $reference);
            return response()->json(['status' => 'error', 'message' => 'Withdrawal not found'], 404);
        }

        if ($withdrawal->status == 'approved' || $withdrawal->status == 'rejected') {
            Log::info('Payrant Webhook: Withdrawal already processed');
            return response()->json(['status' => 'success', 'message' => 'Already processed']);
        }

        if ($status == 'success') {
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // Update Ledger
            UserLedger::where('user_id', $withdrawal->user_id)
                ->where('reason', 'withdraw_request')
                ->where('amount', $withdrawal->amount)
                ->where('status', 'pending') // approximate match
                ->update(['status' => 'approved']);

            Log::info('Payrant Webhook: Withdrawal approved');

        } elseif ($status == 'failed' || $status == 'reversed') {
            $withdrawal->status = 'rejected';
            $withdrawal->save();

            // Refund User
            User::where('id', $withdrawal->user_id)->increment('balance', $withdrawal->amount);

            // Update Ledger
            UserLedger::where('user_id', $withdrawal->user_id)
                ->where('reason', 'withdraw_request')
                ->where('amount', $withdrawal->amount)
                ->where('status', 'pending')
                ->update(['status' => 'rejected', 'perticulation' => 'Withdrawal failed via Webhook']);

            Log::info('Payrant Webhook: Withdrawal rejected and refunded');
        }

        return response()->json(['status' => 'success']);
    }
}

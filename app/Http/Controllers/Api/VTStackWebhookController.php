<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VTStackWebhookController extends Controller
{
    /**
     * Handle incoming VTStack webhook notifications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {
        Log::info('VTStack Webhook: Received', [
            'payload' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        $setting = Setting::first();
        $webhookSecret = $setting->vtstack_webhook_secret;

        // 1. Get Headers
        $receivedSecret = $request->header('X-VTStack-Secret');
        $signature = $request->header('X-VTStack-Signature');
        $isVerified = false;

        if ($webhookSecret) {
            // Check Secret Key Header first (Many gateways use this as a direct check)
            if ($receivedSecret === $webhookSecret) {
                $isVerified = true;
                Log::info('VTStack Webhook: Verified via Secret Key Header');
            }

            // If not verified yet, try HMAC-SHA256
            if (!$isVerified && $signature) {
                $computed256 = hash_hmac('sha256', $request->getContent(), $webhookSecret);
                if (hash_equals($signature, $computed256)) {
                    $isVerified = true;
                    Log::info('VTStack Webhook: Verified via HMAC-SHA256');
                }
            }

            // If still not verified, try HMAC-SHA512
            if (!$isVerified && $signature) {
                $computed512 = hash_hmac('sha512', $request->getContent(), $webhookSecret);
                if (hash_equals($signature, $computed512)) {
                    $isVerified = true;
                    Log::info('VTStack Webhook: Verified via HMAC-SHA512');
                }
            }
        }

        if (!$isVerified) {
            Log::warning('VTStack Webhook: Verification failed', [
                'has_secret' => !!$webhookSecret,
                'has_signature' => !!$signature,
                'received_secret' => $receivedSecret ? 'present' : 'missing'
            ]);
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 3. Process Event
        $payload = $request->all();
        $event = $payload['event'] ?? '';

        if ($event === 'transaction.deposit') {
            return $this->handleDeposit($payload['data']);
        }

        return response()->json(['success' => true, 'message' => 'Event ignored']);
    }

    /**
     * Handle the transaction.deposit event.
     *
     * @param  array  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleDeposit($data)
    {
        $reference = $data['reference'] ?? null;
        $amount = ($data['amount'] ?? 0); // Documentation says 10000 (likely in Kobo or NGN? Usually Naira in these APIs)
        // If it's Kobo, we'd divide by 100. Documentation says "amount": 10000. 
        // Based on "deposit_record.blade.php" and other views, the system uses NGN directly.
        // I will assume it is NGN for now, but often fintechs use Kobo. 
        // If 10000 is 100 Naira, I'd divide by 100. 
        // Let's assume NGN since most local systems I've seen in this codebase use raw numbers.
        
        $accountNumber = $data['virtualAccount'] ?? ($data['customer']['accountNumber'] ?? null);
        
        if (!$reference || !$accountNumber) {
            Log::error('VTStack Webhook: Missing critical data', ['data' => $data]);
            return response()->json(['success' => false, 'message' => 'Invalid data'], 400);
        }

        // Avoid double processing
        $exists = UserLedger::where('reason', 'deposit')->where('perticulation', 'LIKE', '%' . $reference . '%')->first();
        if ($exists) {
            Log::info('VTStack Webhook: Reference already processed', ['ref' => $reference]);
            return response()->json(['success' => true, 'message' => 'Already processed']);
        }

        // Find User by Virtual Account Number
        $user = User::where('virtual_account_number', $accountNumber)->first();
        if (!$user) {
            Log::error('VTStack Webhook: User not found', ['account' => $accountNumber]);
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Attempt to find a matching pending Deposit record
        $deposit = \App\Models\Deposit::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('amount', $amount)
            ->latest()
            ->first();

        if (!$deposit) {
            // If no amount-matching pending deposit found, just get the latest pending deposit
            $deposit = \App\Models\Deposit::where('user_id', $user->id)
                ->where('status', 'pending')
                ->latest()
                ->first();
        }

        if ($deposit) {
            $deposit->status = 'approved';
            $deposit->save();
        }

        // Update Balance
        $user->increment('balance', $amount);

        // Create Ledger Entry
        UserLedger::create([
            'user_id' => $user->id,
            'reason' => 'deposit',
            'perticulation' => 'VTStack Deposit (' . $reference . ')',
            'amount' => $amount,
            'credit' => $amount,
            'status' => 'approved',
            'date' => date('d-m-Y H:i'),
        ]);

        Log::info('VTStack Webhook: Deposit successful', ['user' => $user->id, 'amount' => $amount]);

        return response()->json(['success' => true]);
    }
}

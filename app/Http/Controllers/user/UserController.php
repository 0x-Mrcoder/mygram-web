`<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BonusLedger;
use App\Models\Deposit;
use App\Models\Notice;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\Recharge;
use App\Models\Task;
use App\Models\TaskRequest;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\VipSlider;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Classes\Payrant;

class UserController extends Controller
{
    public function dashboard()
    {
        $totalDeposit = Deposit::where('user_id', Auth::id())->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', Auth::id())->sum('amount');

        $user = Auth::user();
        $myRefId = $user->ref_id;

        $level1Users = User::where('ref_by', $myRefId)->get();
        $level1Count = $level1Users->count();

        $level2Users = User::whereIn('ref_by', $level1Users->pluck('ref_id'))->get();
        $level2Count = $level2Users->count();

        $level3Count = User::whereIn('ref_by', $level2Users->pluck('ref_id'))->count();

        $totalReferralCount = $level1Count + $level2Count + $level3Count;
        
        $setting = \App\Models\Setting::first();
        $sliders = \App\Models\VipSlider::where('status', 'active')->get();
        $userPurchases = \App\Models\Purchase::where('user_id', Auth::id())->get()->groupBy('package_id');

        return view('app.main.index' , compact('totalWithdraw' , 'totalDeposit' , 'totalReferralCount', 'setting', 'sliders', 'userPurchases'));
    }

    public function record_award()
    {
        return view('app.main.record');
    }

    public function record_financial()
    {
        return view('app.main.record_financial');
    }

    public function mine()
    {
        $totalDeposit = Deposit::where('user_id', Auth::id())->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', Auth::id())->sum('amount');
        
        $activePurchaseCount = Purchase::where('user_id', Auth::id())
            ->where('status', 'active')
            ->count();
            
        $setting = \App\Models\Setting::first();
        
        return view('app.main.mine' , compact('totalWithdraw' , 'totalDeposit' , 'activePurchaseCount', 'setting'));
    }
    
    public function reward_award()
    {
        return view('app.main.reward_record');
    }

    public function earning_record()
    {
        return view('app.main.earning_record');
    }

    public function tasks(Request $request)
    {
        $user = auth()->user();
        $limit = Purchase::where('user_id', $user->id)->sum('daily_limit');
        $complete = UserLedger::where(['user_id' => $user->id, 'reason' => 'spin'])->whereDate('created_at', today())->count();
        // $remain = $limit - $complete;
        $remain = 0;
        
        $last_spin_time = Carbon::now()->subHours(24);
        $last_spin = UserLedger::where(['user_id' => $user->id, 'reason' => 'spin'])->latest()->first();
        
        if($last_spin){
            $last_spin_time = $last_spin->created_at;
        }

        $now = Carbon::now();
        $diffHours = $now->diffInHours($last_spin_time);
        
        if($diffHours >= 24){
            $remain = 1;
        }
        

        if($request->has('amount')){
            $amount = $request->amount;
            
            if($remain <= 0){
                return redirect()->to('tasks')->with('success', 'Task Has been completed today.');
            }
            
            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->get_balance_from_user_id = $user->id;
            $ledger->reason = 'spin';
            $ledger->perticulation = 'Spin Reward';
            $ledger->amount = $amount;
            $ledger->debit = $amount;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();
            
            $user->balance += $amount;
            $user->save();
            
           return redirect()->to('tasks')->with('success', 'Spin reward claim successfully '. $amount);
        }
        
        return view('app.main.tasks', compact('remain'));
        
        //First Level
        $first_level_users = User::where('ref_by', auth()->user()->ref_id)->get();

        //Get Second Level
        $second_level_users_ids = [];
        foreach ($first_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($second_level_users_ids, $user->id);
            }
        }
        $second_level_users = User::whereIn('id', $second_level_users_ids)->get();

        //Get Third Level
        $third_level_users_ids = [];
        foreach ($second_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($third_level_users_ids, $user->id);
            }
        }
        $third_level_users = User::whereIn('id', $third_level_users_ids)->get();

        //Get Team Size
        $team_size = $first_level_users->count() + $second_level_users->count() + $third_level_users->count();

        //Get level wise user ids
        $first_ids = $first_level_users->pluck('id'); //first
        $second_ids = $second_level_users->pluck('id'); //Second
        $third_ids = $third_level_users->pluck('id'); //Third

        $totalDeposit1 = Deposit::whereIn('user_id', array_merge($first_ids->toArray()))->where('status', 'approved')->sum('amount');
        $totalDeposit2 = Deposit::whereIn('user_id', array_merge($second_ids->toArray()))->where('status', 'approved')->sum('amount');
        $totalDeposit3 = Deposit::whereIn('user_id', array_merge($third_ids->toArray()))->where('status', 'approved')->sum('amount');
        $teamDeposit = $totalDeposit1+$totalDeposit2+$totalDeposit3;

        return view('app.main.tasks', compact('teamDeposit'));
    }

    public function received_signed_balance()
    {
        $user = User::where('id', auth()->id())->first();
        if (now()->greaterThanOrEqualTo($user->sign_every_day)) {

            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->get_balance_from_user_id = $user->id;
            $ledger->reason = 'reword';
            $ledger->perticulation = 'Attendance Reword';
            $ledger->amount = setting('daily_sign_amount');
            $ledger->debit = setting('daily_sign_amount');
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();

            $user->balance = $user->balance + setting('daily_sign_amount');
            $user->sign_every_day = now()->addHours(24);
            $user->save();
            return back()->with('success', 'Daily Attendance Amount Received.');
        }else{
            return back()->with('success', 'Daily Attendance Not Illegible');
        }
    }
    
    
        public function createTopupOrder(Request $request)
    {
        // Validate minimum amount from Settings
        $setting = \App\Models\Setting::first();
        $minAmount = $setting->minimum_recharge ?? 1000;

        $request->validate([
            'amount' => 'required|numeric|min:' . $minAmount
        ], [
            'amount.min' => 'Minimum deposit amount is ₦' . number_format($minAmount)
        ]);

        $user = Auth::user();

        // Create a pending deposit
        $deposit = new Deposit();
        $deposit->user_id = $user->id;
        $deposit->amount = $request->amount;
        $deposit->trx = 'TRX-' . strtoupper(uniqid());
        $deposit->method_name = setting('payment_mode') == 'virtual_account' ? strtoupper(setting('virtual_gateway', 'VTStack')) : 'Manual';
        $deposit->date = date('d-m-Y H:i:s');
        $deposit->status = 'pending';
        $deposit->save();

        if (setting('payment_mode') == 'manual') {
             return redirect()->route('manual_payment_page', ['id' => $deposit->id]);
        }

        if (setting('payment_mode') == 'virtual_account') {
            $activeProvider = $setting->virtual_gateway ?? 'payrant';
            if (!$user->virtual_account_number || $user->virtual_account_provider !== $activeProvider) {
                $this->performVirtualAccountGeneration($user, $setting);
                // Refresh user model to get new account details
                $user->refresh();
                if (!$user->virtual_account_number) {
                    return redirect()->back()->with('error', 'Failed to auto-generate virtual account. Please try again.');
                }
            }
            return redirect()->route('user.virtual_account_payment', ['id' => $deposit->id]);
        }

        try {
            $payrant = new Payrant();
            $checkoutData = [
                'amount' => $request->amount,
                'email' => $user->email ?? 'user@example.com',
                'first_name' => explode(' ', $user->name)[0] ?? 'User',
                'last_name' => explode(' ', $user->name)[1] ?? 'Name',
                'phone' => $user->phone ?? '08000000000',
                'reference' => $deposit->trx,
                'callback_url' => route('payment.callback'),
                'currency' => 'NGN',
            ];

            Log::info('Payrant Checkout Init', $checkoutData);

            $response = $payrant->initializeCheckout($checkoutData);

            Log::info('Payrant Checkout Response', ['response' => $response]);

            if (isset($response['status']) && $response['status'] == 'success' && isset($response['data']['checkout_url'])) {
                
                // Save Payrant Reference
                if (isset($response['data']['reference'])) {
                    $deposit->order_id = $response['data']['reference'];
                    $deposit->save();
                }

                return redirect()->away($response['data']['checkout_url']);
            } else {
                return back()->with('error', 'Failed to initialize payment: ' . ($response['message'] ?? 'Unknown error'));
            }

        } catch (\Exception $e) {
            Log::error('Payrant Checkout Exception', ['error' => $e->getMessage()]);
            return redirect()->route('user.recharge')->with('error', 'Payment initialization failed. Please try again.');
        }

        // Final Fallback if no payment mode matched
        return redirect()->route('user.recharge')->with('error', 'Invalid payment mode configuration. Please contact support.');
    }

    public function paymentCallback(Request $request)
    {
        Log::info('Payment Callback Received', $request->all());

        $reference = $request->reference;

        if (!$reference) {
            Log::error('Payment Callback: Missing reference');
            return redirect()->route('user.recharge')->with('error', 'Invalid payment reference.');
        }

        try {
            // Find deposit first to get the correct verification reference (Payrant's TXN ID)
            $deposit = Deposit::where('trx', $reference)->orWhere('order_id', $reference)->first();

            if (!$deposit) {
                 Log::warning('Payment Callback: Deposit not found for reference', ['reference' => $reference]);
                 return redirect()->route('user.recharge')->with('error', 'Deposit record not found.');
            }

            // Use the Payrant reference (order_id) for verification if available, otherwise use the callback reference
            $verificationReference = $deposit->order_id ?? $reference;

            $payrant = new Payrant();
            $response = $payrant->verifyCheckout($verificationReference);

            Log::info('Payrant Verify Response', ['response' => $response]);

            // Check for success. Adjust condition based on actual response structure.
            // Some APIs return 'status' => true/false, others 'success'/'error'.
            // Based on Payrant docs (assumed):
            // Success: { "status": "success", "message": "...", "data": { "status": "success", ... } }
            
            if (isset($response['status']) && $response['status'] == 'success') {
                 // Sometimes the inner data status is what matters
                 $innerStatus = $response['data']['status'] ?? 'unknown';
                 
                 if ($innerStatus == 'success') {
                    // Verification Successful
                    $this->processSuccessfulDeposit($deposit);
                    return redirect()->route('user.recharge')->with('success', 'Payment successful! Balance credited.');
                 } else {
                     Log::warning('Payment Callback: Inner status not success', ['status' => $innerStatus]);
                  }

            } else {
                Log::warning('Payment Callback: Verification failed', ['response' => $response]);
                
                // Fallback: If verification fails (e.g. System Error), check if the callback request itself says success
                if ($request->status == 'success' && $request->reference == $reference) {
                    Log::info('Payment Callback: Verification failed but Request says success. Trusting request.', ['request' => $request->all()]);
                    $this->processSuccessfulDeposit($deposit);
                    return redirect()->route('user.recharge')->with('success', 'Payment successful! Balance credited.');
                }
            }
            
            // If we reached here, it failed
            if ($deposit && $deposit->status == 'pending') {
                 $deposit->status = 'rejected';
                 $deposit->save();
            }
            return redirect()->route('user.recharge')->with('error', 'Payment verification failed.');

        } catch (\Exception $e) {
            Log::error('Payrant Verify Exception', ['error' => $e->getMessage()]);
            return redirect()->route('user.recharge')->with('error', 'Payment verification error.');
        }
    }

    

public function manualPaymentPage($id)
{
    $order = Deposit::findOrFail($id);
    $methods = \App\Models\PaymentMethod::where('status', 'active')->get();

    return view('app.main.recharge.manual_payment', compact('order', 'methods'));
}

  
  
  
    public function confirmPayment(Request $request, $id)
    {
        $request->validate([
            'sender_name' => 'required|string|max:255',
        ]);

        $order = Deposit::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Mark as pending for admin to approve
        $order->status = 'pending';
        $order->sender_name = $request->sender_name;
        $order->save();

        return redirect()->route('deposit.record')
            ->with('success', 'Payment submitted.');
    }
  

    public function apply_task_commission($task_id){
        $task = Task::where('id', $task_id)->first();

        if ($task){
            //check task submit
            $taskSubmitCheck = TaskRequest::where('user_id', \auth()->id())->where('task_id', $task_id)->count();
            if ($taskSubmitCheck > 0){
                return redirect('tasks')->with('success', 'Already Submitted.');
            }

            $referUser = User::where('ref_by', auth()->user()->ref_id)->get();
            if ($referUser->count() >= $task->team_size){
                $amount = Deposit::whereIn('user_id', $referUser->pluck('id')->toArray())->where('status', 'approved')->sum('amount');
                if ($amount >= $task->invest){
                    $model = new TaskRequest();
                    $model->task_id = $task->id;
                    $model->user_id = \auth()->id();
                    $model->team_invest = $task->invest;
                    $model->team_size = $task->team_size;
                    $model->save();

                    $ledger = new UserLedger();
                    $ledger->user_id = \auth()->id();
                    $ledger->reason = 'task';
                    $ledger->perticulation = 'Task request submitted.';
                    $ledger->amount = $task->bonus;
                    $ledger->debit = $task->bonus;
                    $ledger->status = 'approved';
                    $ledger->date = date('d-m-Y H:i');
                    $ledger->save();


                   return redirect('tasks')->with('success', 'Request sent successfully.');
}else{
                    return redirect('tasks')->with('error', 'Need More ['.$task->team_size - $referUser->count(). '] Members');
                }
            }else{
                return redirect('tasks')->with('error', 'Please improve your team.');
            }
        }
        return back();
    }

    public function deposit_record()
    {
        return view('app.main.deposit_record');
    }

    public function withdraw_record()
    {
        return view('app.main.withdraw_record');
    }

    public function profile()
    {
        return view('app.main.profile');
    }

    public function recharge()
    {
        $userId = Auth::id();
        $setting = \App\Models\Setting::first();
        $packages = \App\Models\Package::where('status', 'active')->where('tab', 'vip')->orderBy('price', 'asc')->get();

        $totalDeposit = Deposit::where('user_id', $userId)->sum('amount');

        return view('app.main.recharge.index', compact('totalDeposit', 'setting', 'packages'));
    }
    public function apiPayment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'trx'=> 'required'
        ]);

        if (!$request->has('trx')){
            return redirect()->back('success', 'Payment trx required');
        }

        $model = new Deposit();

        $model->user_id = Auth::id();
        $model->method_name = $request->methods;
        $model->amount = $request->amount;
        $model->trx = $request->trx;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';
        $model->save();

        //Create user ledger
        $ledger = new UserLedger();
        $ledger->user_id = Auth::id();
        $ledger->reason = 'user_deposit';
        $ledger->perticulation = 'user deposit using externals';
        $ledger->amount = $request->amount;;
        $ledger->debit = $request->amount;;
        $ledger->status = 'pending';
        $ledger->date = date('y-m-d');
        $ledger->save();
        return redirect('user/recharge')->with('success', 'Payment success');
    }


    public function recharge_confirm($amount, $methods)
    {
        $methods = PaymentMethod::where('id', $methods)->first();
        return view('app.main.recharge.confirm', compact('methods', 'amount'));
    }

    public function service()
    {
        return view('app.main.service');
    }

    public function name()
    {
        return view('app.main.name');
    }

    public function name_submit(Request $request)
    {
        if ($request->has('name')){
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->update();
        }else{
            return redirect()->back()->with('error', 'Name is required');
        }
        return redirect()->route('my.profile')->with('success', 'Name updated');
    }

    public function payment_ledger()
    {
        return view('app.main.recharge.payment-preview');
    }

    public function withdraw_ledger()
    {
        return view('app.main.withdraw.withdraw-preview');
    }

    public function password()
    {
        return view('app.main.password');
    }

    public function withdraw_password()
    {
        return view('app.main.withdraw_password');
    }

    public function changepassword(Request $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)){
            if ($request->new_password == $request->confirm_password)
            {
                User::where('id', Auth::id())->update([
                    'password'=> Hash::make($request->new_password)
                ]);
               return back()->with('error', 'Password changed successfully.');
}else{
return back()->with('error', 'Confirm passwords do not match');
}
}else{
return back()->with('error', 'Current password is incorrect');
        }
    }

    public function withdraw_password_submit(Request $request)
    {
        User::where('id', Auth::id())->update([
            'gateway_password'=> Hash::make($request->password)
        ]);
        return back()->with('error', 'Withdraw password successfully changed.');
    }

    public function card()
    {
        return view('app.main.gateway_setup');
    }

    public function add_card()
    {
        $payrant = new Payrant();
        $response = $payrant->getBanks();
        $banks = $response['data']['banks'] ?? [];
        return view('app.main.add_bank', compact('banks'));
    }

    public function validate_bank_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_code' => 'required',
            'account_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        $payrant = new Payrant();
        $response = $payrant->validateAccount($request->bank_code, $request->account_number);

        if (isset($response['status']) && $response['status'] == 'success') {
            return response()->json([
                'status' => true,
                'account_name' => $response['data']['account_name']
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Could not validate account details.'
            ]);
        }
    }

    public function setupGateway(Request $request)
    {
        User::where('id',Auth::id())->update([
            'holder_name'=> $request->holdername,
            'gateway_method'=> $request->gateway_method,
            'gateway_number'=> $request->gateway_number,
        ]);
        return redirect()->to('/withdraw')->with('success','Successful.');
    }

    public function invite()
    {
        return view('app.main.invite');
    }

    public function download_apk(){
        $file= public_path('plg.apk');
        return response()->file($file ,[
            'Content-Type'=>'application/vnd.android.package-archive',
            'Content-Disposition'=> 'attachment; filename="plg.apk"',
        ]) ;
    }
    
    public function checkin(){
        $user = auth()->user();
        $amount = 10;
        
        if(UserLedger::where(['user_id' => $user->id, 'reason' => 'daily_checkin'])->whereDate('created_at', today())->exists()){
            return back()->with('success', 'Already Received Today. Please Try Next Day.');
        }
        
        $ledger = new UserLedger();
        $ledger->user_id = $user->id;
        $ledger->reason = 'daily_checkin';
        $ledger->perticulation = 'Daily Checkin Bonus';
        $ledger->amount = $amount;
        $ledger->debit = $amount;
        $ledger->status = 'approved';
        $ledger->date = date('d-m-Y H:i');
        $ledger->save();
        
        $user->increment('balance', $amount);
        
        return back()->with('success', 'Daily Checkin Amount Received.');
    }
    

public function claimAll()
{
    $user = Auth::user();

    $spin = $user->spins()->where('status', 'pending')->first();

    if (!$spin) {
        return back()->with('error', 'No pending spins to claim');
    }

    $spin->update(['status' => 'claimed']);

    $user->increment('balance', $spin->reward_amount);
    
    $ledger = new UserLedger();
        $ledger->user_id = $user->id;
        $ledger->reason = 'spin_reward';
        $ledger->perticulation = 'Reffer Reward Bonus';
        $ledger->amount = $spin->reward_amount;
        $ledger->debit = $spin->reward_amount;
        $ledger->status = 'approved';
        $ledger->date = date('d-m-Y H:i');
        $ledger->save();

    return back()->with('success', "Spin #{$spin->id} claimed, +{$spin->reward_amount} added to your balance");
}

    private function processSuccessfulDeposit($deposit)
    {
        if ($deposit->status == 'pending') {
            // Update Deposit
            $deposit->status = 'approved';
            $deposit->save();

            // Update User Balance
            $user = User::find($deposit->user_id);
            $user->increment('balance', $deposit->amount);

            // Create Ledger
            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'deposit';
            $ledger->perticulation = 'Deposit via Payrant';
            $ledger->amount = $deposit->amount;
            $ledger->credit = $deposit->amount;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();
        }
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->save();

        // Auto-generate virtual account and return its response
        return $this->generateVirtualAccount($request);
    }

    public function generateVirtualAccount(Request $request)
    {
        $user = User::find(Auth::id());
        $setting = \App\Models\Setting::first();

        // Check if user already has a virtual account that matches the active provider
        $activeProvider = $setting->virtual_gateway ?? 'payrant';
        if ($user->virtual_account_number && $user->virtual_account_provider === $activeProvider) {
            return back()->with('success', 'You already have an active dedicated virtual account.');
        }

        $result = $this->performVirtualAccountGeneration($user, $setting);

        if ($result['success']) {
            return back()->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message']);
        }
    }

    /**
     * Internal logic to generate or update a virtual account for a user.
     */
    protected function performVirtualAccountGeneration($user, $setting)
    {
        // FIX: Detect and clear corrupt "Integer Overflow" account number
        if ($user->virtual_account_number == '2147483647') {
            $user->virtual_account_number = null;
            $user->save();
        }

        try {
            $gateway = $setting->virtual_gateway ?? 'payrant';

            // Format Phone: Ensure it starts with 0
            $phone = $user->phone;
            if (!str_starts_with($phone, '0')) {
                $phone = '0' . $phone;
            }
            
            // Generate Email from Name
            $cleanName = strtolower(str_replace(' ', '', $user->name));
            $generatedEmail = $cleanName . '@gmail.com';

            if ($gateway == 'vtstack') {
                $vtstack = new \App\Classes\VTStack();
                $data = [
                    'firstName' => $user->username,
                    'lastName' => '(VTStack)',
                    'email' => $generatedEmail,
                    'phone' => $phone,
                    'bvn' => $this->generateRandomBVN(),
                    'identityType' => 'INDIVIDUAL',
                    'reference' => 'ref_' . time() . '_' . $user->id
                ];

                Log::info('VTStack: Generating Virtual Account', $data);
                $response = $vtstack->createVirtualAccount($data);

                if (isset($response['success']) && $response['success'] == true) {
                    $user->virtual_account_number = $response['data']['accountNumber'];
                    $user->virtual_account_name = $response['data']['accountName'];
                    $user->virtual_bank_name = $response['data']['bankName']; // Usually PalmPay
                    $user->virtual_account_provider = 'vtstack';
                    $user->save();

                    return ['success' => true, 'message' => 'Virtual Account generated successfully via VTStack!'];
                } else {
                    return ['success' => false, 'message' => 'VTStack Error: ' . ($response['message'] ?? 'Unknown error')];
                }
            } else {
                // Fallback to Payrant
                $payrant = new \App\Classes\Payrant();
                $firstName = explode(' ', $user->name)[0] ?? 'User';
                $data = [
                     'documentType' => 'nin',
                     'documentNumber' => $phone,
                     'virtualAccountName' => 'FortuneFlow',
                     'customerName' => $firstName,
                     'email' => $generatedEmail,
                     'accountReference' => 'ref_' . time() . '_' . $user->id
                ];
                
                $response = $payrant->createVirtualAccount($data);

                if (isset($response['status']) && $response['status'] == 'Enabled') {
                    $user->virtual_account_number = $response['account_no'];
                    $cleanName = str_replace('(Payrant)', '', $response['virtualAccountName']);
                    $user->virtual_account_name = trim($cleanName); 
                    $user->virtual_bank_name = 'Palmpay'; 
                    $user->virtual_account_provider = 'payrant';
                    $user->save();

                    return ['success' => true, 'message' => 'Virtual Account generated successfully!'];
                } else {
                    return ['success' => false, 'message' => 'Payrant Error: ' . ($response['message'] ?? 'Unknown error')];
                }
            }

        } catch (\Exception $e) {
            Log::error('Virtual Account Generation Exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'An error occurred while generating account.'];
        }
    }

    /**
     * Generate a random 11-digit BVN starting with 22.
     */
    private function generateRandomBVN()
    {
        return '22' . mt_rand(100000000, 999999999);
    }

    // ✅ Virtual Account Payment Page
    public function virtualAccountPayment($id)
    {
        $deposit = Deposit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // If already approved, redirect to home
        if ($deposit->status == 'approved') {
            return redirect()->route('dashboard')->with('success', 'Payment already received.');
        }

        return view('app.main.recharge.virtual_account_payment', compact('deposit'));
    }

    // ✅ Check Payment Status (AJAX)
    public function checkPaymentStatus($id)
    {
        $deposit = Deposit::where('id', $id)->where('user_id', Auth::id())->first();
        if ($deposit && $deposit->status == 'approved') {
            return response()->json(['status' => 'approved']);
        }
        return response()->json(['status' => 'pending']);
    }

    // ✅ Payrant Webhook
    // ✅ Payrant Webhook
    public function payrantWebhook(Request $request)
    {
        try {
            // 1. Retrieve Signature and Secret
            $secret = env('PAYRANT_WEBHOOK_SECRET');
            $signature = $request->header('X-Payrant-Signature');

            // 2. Log Raw Request for Debugging
            Log::info('Payrant Webhook Raw:', ['content' => $request->getContent()]);

            // 3. Verify Signature (if secret is set)
            if ($secret && $signature) {
                 $computed = hash_hmac('sha256', $request->getContent(), $secret);
                 if (!hash_equals($computed, $signature)) {
                     Log::warning('Payrant Webhook: Invalid Signature');
                     return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
                 }
            }

            $payload = $request->all();

            // 4. Check Status and Transaction Data
            if (isset($payload['status']) && $payload['status'] == 'success' && isset($payload['transaction'])) {
                $transaction = $payload['transaction'];
                
                // Extract Details based on provided JSON
                $accountNumber = $transaction['account_details']['account_number'] ?? null;
                $rawAccountName = $transaction['account_details']['account_name'] ?? null;
                
                // Clean the incoming name to match our DB format (remove (Payrant))
                $cleanAccountName = trim(str_replace(['(Payrant)'], '', $rawAccountName));

                // Credit FULL amount (UniqWealth absorbs Payrant fees)
                $amount = $transaction['amount'] ?? 0;        
                
                $reference = $transaction['reference'] ?? 'PAYRANT_' . time();
                
                $payerName = $transaction['payer_details']['account_name'] ?? 'Unknown Sender';
                $payerBank = $transaction['payer_details']['bank_name'] ?? 'Unknown Bank';

                Log::info("Payrant Webhook Process: Acc ($accountNumber), Name ($cleanAccountName)");

                // 5. Find User by Account Number ONLY (name is same for all users!)
                $user = User::where('virtual_account_number', $accountNumber)->first();

                if ($user) {
                    // Update stored Number if needed
                    if ($user->virtual_account_number !== $accountNumber) {
                         try {
                             $user->virtual_account_number = $accountNumber;
                             $user->save();
                         } catch (\Exception $e) {
                             Log::warning("Payrant Webhook: Ignored Schema Mismatch on User Update. Proceeding to Fund. Error: " . $e->getMessage());
                         }
                    }

                    // 6. Deposit Logic
                    $grossAmount = $transaction['amount'] ?? $amount;

                    $deposit = Deposit::where('user_id', $user->id)
                                    ->where('status', 'pending')
                                    ->where('amount', $grossAmount) 
                                    ->orderBy('created_at', 'desc')
                                    ->first();

                    if ($deposit) {
                        $deposit->status = 'approved';
                        $deposit->order_id = $reference; // Save Payrant Reference
                        // $deposit->note = ... removed
                        $deposit->save();
                        
                        $user->fresh()->increment('balance', $amount);
                        $user->refresh();
                        
                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'deposit';
                        $ledger->perticulation = "Virtual Deposit from $payerName ($payerBank)";
                        $ledger->amount = $amount;
                        $ledger->credit = $amount;
                        $ledger->status = 'approved';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();

                        Log::info("Payrant Webhook: MATCHED DEPOSIT User {$user->id}");

                    } else {
                        // AUTO DEPOSIT
                         $deposit = new Deposit();
                         $deposit->user_id = $user->id;
                         $deposit->amount = $amount; 
                         $deposit->trx = $reference;
                         $deposit->transaction_id = $reference;
                         $deposit->order_id = $reference;
                         $deposit->method_name = 'Payrant';
                         $deposit->method_number = $accountNumber ?? 'Virtual';
                         $deposit->number = $user->phone ?? $accountNumber;
                         $deposit->date = date('d-m-Y H:i:s');
                         $deposit->status = 'approved';
                         $deposit->save();

                         // Credit User (reload to ensure fresh data)
                         $user->fresh()->increment('balance', $amount);
                         $user->refresh();

                         $ledger = new UserLedger();
                         $ledger->user_id = $user->id;
                         $ledger->reason = 'deposit';
                         $ledger->perticulation = "Auto Deposit from $payerName ($payerBank)";
                         $ledger->amount = $amount;
                         $ledger->credit = $amount;
                         $ledger->status = 'approved';
                         $ledger->date = date('d-m-Y H:i');
                         $ledger->save();
                         
                         Log::info("Payrant Webhook: AUTO DEPOSIT User {$user->id}");
                    }

                    return response()->json(['status' => 'success', 'message' => 'User credited']);
                } else {
                    Log::error("Payrant Webhook: User not found for $accountNumber / $cleanAccountName");
                    return response()->json(['status' => 'error', 'message' => "User not found for $accountNumber"], 404);
                }
            }

            return response()->json(['status' => 'ignored']);

        } catch (\Exception $e) {
            Log::error('Payrant Webhook CRASH: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
}

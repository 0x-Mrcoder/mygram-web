<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public $route = 'admin.setting';
    public function index()
    {
        $data = Setting::find(1);
        return view('admin.pages.setting.index', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $model = Setting::findOrFail(1);

        $path = uploadImage(false ,$request, 'logo', 'upload/setting/', null, null ,$model->logo);
        $model->logo = $path ?? $model->logo;

        $model->telegram_channel = $request->telegram_channel;
        $model->telegram_group = $request->telegram_group;
        $model->withraw_button = $request->withraw_button;
        $model->registration_bonus = $request->registration_bonus;
        $model->refer_commission = $request->refer_commission;
        $model->refer_limit = $request->refer_limit;
        
        // Multi-level commission percentages
        $model->level1_commission_percent = $request->level1_commission_percent ?? 8;
        $model->level2_commission_percent = $request->level2_commission_percent ?? 2;
        $model->level3_commission_percent = $request->level3_commission_percent ?? 1;

        $model->minimum_withdraw = $request->minimum_withdraw;
        $model->maximum_withdraw = $request->maximum_withdraw;
        $model->maximum_recharge = $request->maximum_recharge;
        $model->minimum_recharge = $request->minimum_recharge;
        $model->withdraw_charge = $request->withdraw_charge;
                $model->notice = $request->notice;

        $model->daily_sign_amount = $request->daily_sign_amount;
        $model->withdraw_status = $request->withdraw_status;
        $model->payment_mode = $request->payment_mode ?? 'manual';
        $model->virtual_gateway = $request->virtual_gateway ?? 'payrant';
        $model->vtstack_api_key = $request->vtstack_api_key;
        $model->vtstack_webhook_secret = $request->vtstack_webhook_secret;
        
        // Event Settings
        $model->event_active = $request->has('event_active') ? 1 : 0;
        $model->event_title = $request->event_title;
        $model->event_end_time = $request->event_end_time ? \Carbon\Carbon::parse($request->event_end_time) : null;
        $model->event_discount_percent = $request->event_discount_percent ?? 0;

        $model->save();
        return redirect()->route($this->route.'.index')->with('success', 'Settings Updated Successfully.');
    }
}

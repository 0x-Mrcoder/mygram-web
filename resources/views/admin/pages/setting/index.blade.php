@extends('admin.partials.master')
@section('admin_content')
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.setting.insert')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$data ? $data->id : ''}}">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div>{{$data ? 'Update' : 'Create New'}} Settings</div>
                                </div>
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-12 mt-2">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <fieldset class="form-group">
                                                            <label for="basicInputFile">Upload Logo <small>{Suggestion:
                                                                    size 80X80(px)}</small> </label>
                                                            <div class="custom-file">
                                                                <input type="file" name="logo"
                                                                       class="custom-file-input is-valid"
                                                                       id="inputGroupFile01"
                                                                       @if(!$data) required
                                                                       @else @endif onchange="showPreview(event)">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                                    file</label>
                                                                <div class="valid-feedback">
                                                                    <i class="bx bx-radio-circle"></i>
                                                                    Note: Logo image mandatory
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="image_preview">
                                                            <img
                                                                src="{{$data ? asset(view_image($data->logo)) :  asset(not_found_img())}}"
                                                                id="file-ip-1-preview" class="rounded"
                                                                alt="Preview Image"
                                                                style="width: 100px;height: 100px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="withdraw_status">Withdraw status</label>
                                        <select name="withdraw_status" id="withdraw_status" class="form-control">
                                            <option value="active" @if($data->withdraw_status == 'active') selected @endif>Active</option>
                                            <option value="inactive" @if($data->withdraw_status == 'inactive') selected @endif>In-Active</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="payment_mode">Deposit Payment Mode</label>
                                        <select name="payment_mode" id="payment_mode" class="form-control">
                                            <option value="auto" @if($data->payment_mode == 'auto') selected @endif>Automatic (Payrant Checkout)</option>
                                            <option value="manual" @if($data->payment_mode == 'manual') selected @endif>Manual Payment</option>
                                            <option value="virtual_account" @if($data->payment_mode == 'virtual_account') selected @endif>Dedicated Virtual Account (Auto)</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: For VTStack or Payrant Auto-generation, select "Dedicated Virtual Account (Auto)".
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5 class="text-primary">Virtual Account Gateway (Auto-Generation)</h5>
                                        <hr>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="virtual_gateway">Active Virtual Gateway</label>
                                        <select name="virtual_gateway" id="virtual_gateway" class="form-control">
                                            <option value="payrant" @if($data->virtual_gateway == 'payrant') selected @endif>Payrant</option>
                                            <option value="vtstack" @if($data->virtual_gateway == 'vtstack') selected @endif>VTStack</option>
                                        </select>
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Select provider for dedicated virtual accounts.
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="vtstack_api_key">VTStack Secret Key (API Key)</label>
                                        <input type="text" class="form-control" name="vtstack_api_key" id="vtstack_api_key" value="{{ $data ? $data->vtstack_api_key : old('vtstack_api_key') }}" placeholder="sk_live_...">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="vtstack_webhook_secret">VTStack Webhook Secret Key</label>
                                        <input type="text" class="form-control" name="vtstack_webhook_secret" id="vtstack_webhook_secret" value="{{ $data ? $data->vtstack_webhook_secret : old('vtstack_webhook_secret') }}" placeholder="Signature secret">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="minimum_withdraw">minimum withdraw</label>
                                        <input type="text" class="form-control is-valid"
                                               name="minimum_withdraw" id="minimum_withdraw"
                                               placeholder="minimum_withdraw"
                                               value="{{$data ? $data->minimum_withdraw : old('minimum_withdraw')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="maximum_withdraw">maximum withdraw</label>
                                        <input type="text" class="form-control is-valid"
                                               name="maximum_withdraw" id="maximum_withdraw"
                                               placeholder="minimum_withdraw"
                                               value="{{$data ? $data->maximum_withdraw : old('maximum_withdraw')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="withdraw_charge">withdraw charge(%)</label>
                                        <input type="text" class="form-control is-valid"
                                               name="withdraw_charge" id="minimum_withdraw"
                                               placeholder="10%"
                                               value="{{$data ? $data->withdraw_charge : old('withdraw_charge')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="minimum_recharge">Minimum Recharge</label>
                                        <input type="text" class="form-control is-valid"
                                               name="minimum_recharge" id="minimum_recharge"
                                               placeholder="10%"
                                               value="{{$data ? $data->minimum_recharge : old('minimum_recharge')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="maximum_recharge">Maximum Recharge</label>
                                        <input type="text" class="form-control is-valid"
                                               name="maximum_recharge" id="maximum_recharge"
                                               placeholder="10%"
                                               value="{{$data ? $data->maximum_recharge : old('maximum_recharge')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="telegram_channel">Telegram channel</label>
                                        <input type="text" class="form-control is-valid"
                                               name="telegram_channel" id="telegram_channel"
                                               placeholder="telegram_channel"
                                               value="{{$data ? $data->telegram_channel : old('telegram_channel')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="telegram_channel">Telegram group</label>
                                        <input type="text" class="form-control is-valid"
                                               name="telegram_group" id="telegram_group"
                                               placeholder="telegram_group"
                                               value="{{$data ? $data->telegram_group : old('telegram_group')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                    
<div class="col-sm-6">
    <label for="withdraw_button">Withdraw Button</label>
    <select name="withraw_button"
            id="withdraw_button"
            style="
                display: block;
                width: 100%;
                padding: 0.5rem;
                font-size: 1rem;
                line-height: 1.5;
                margin:3px 0;
                color: #000;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #22c55e; /* Green-400 */
                border-radius: 0.375rem; /* rounded-md */
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            ">
        <option value="on" {{ isset($data) && $data->withraw_button == 'on' ? 'selected' : '' }}>
            Enable
        </option>
        <option value="off" {{ isset($data) && $data->withraw_button == 'off' ? 'selected' : '' }}>
            Disable
        </option>
    </select>
    <div style="color: #16a34a; font-size: 0.875rem; margin-top: 0.25rem;">
        <i class="bx bx-radio-circle"></i>
        Note: Choose to enable or disable the withdraw button
    </div>
</div>

<div class="col-sm-6">
    <label for="refer_limit">Refer Limit</label>
    <input type="number" step="0.01" min="0" class="form-control is-valid"
           name="refer_limit" id="refer_limit"
           placeholder="Enter Registration Bonus Amount"
           value="{{ $data ? $data->refer_limit : old('refer_limit') }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Note: Refer limit
    </div>
</div>

<div class="col-sm-6">
    <label for="registration_bonus">Registration Bonus</label>
    <input type="number" step="0.01" min="0" class="form-control is-valid"
           name="registration_bonus" id="registration_bonus"
           placeholder="Enter Registration Bonus Amount"
           value="{{ $data ? $data->registration_bonus : old('registration_bonus') }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Note: Bonus amount credited during registration
    </div>
</div>

<div class="col-sm-6">
    <label for="refer_commission">Referral Commission (Legacy - Fixed Amount)</label>
    <input type="number" step="0.01" min="0" class="form-control is-valid"
           name="refer_commission" id="refer_commission"
           placeholder="Enter Referral Commission Amount"
           value="{{ $data ? $data->refer_commission : old('refer_commission') }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Note: Legacy field - use percentage fields below instead
    </div>
</div>

<div class="col-sm-6">
    <label for="level1_commission_percent">Level 1 Commission (%)</label>
    <input type="number" step="0.01" min="0" max="100" class="form-control is-valid"
           name="level1_commission_percent" id="level1_commission_percent"
           placeholder="Enter Level 1 Commission Percentage"
           value="{{ $data ? $data->level1_commission_percent : old('level1_commission_percent', 8) }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Direct referrals earn this % of package purchases
    </div>
</div>

<div class="col-sm-6">
    <label for="level2_commission_percent">Level 2 Commission (%)</label>
    <input type="number" step="0.01" min="0" max="100" class="form-control is-valid"
           name="level2_commission_percent" id="level2_commission_percent"
           placeholder="Enter Level 2 Commission Percentage"
           value="{{ $data ? $data->level2_commission_percent : old('level2_commission_percent', 2) }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Second level referrals earn this % of package purchases
    </div>
</div>

<div class="col-sm-6">
    <label for="level3_commission_percent">Level 3 Commission (%)</label>
    <input type="number" step="0.01" min="0" max="100" class="form-control is-valid"
           name="level3_commission_percent" id="level3_commission_percent"
           placeholder="Enter Level 3 Commission Percentage"
           value="{{ $data ? $data->level3_commission_percent : old('level3_commission_percent', 1) }}">
    <div class="valid-feedback">
        <i class="bx bx-radio-circle"></i>
        Third level referrals earn this % of package purchases
    </div>
</div>

                                    

                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5 class="text-primary">Event Configuration</h5>
                                        <hr>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="event_active">Event Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="event_active" name="event_active" value="1" {{ $data && $data->event_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="event_active">Activate Event</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="event_title">Event Title</label>
                                        <input type="text" class="form-control" name="event_title" id="event_title" value="{{ $data ? $data->event_title : old('event_title') }}" placeholder="e.g. Flash Sale!">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="event_end_time">Event End Time</label>
                                        <input type="datetime-local" class="form-control" name="event_end_time" id="event_end_time" value="{{ $data && $data->event_end_time ? date('Y-m-d\TH:i', strtotime($data->event_end_time)) : old('event_end_time') }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="event_discount_percent">Global Discount (%)</label>
                                        <input type="number" step="0.01" min="0" max="100" class="form-control" name="event_discount_percent" id="event_discount_percent" value="{{ $data ? $data->event_discount_percent : old('event_discount_percent') }}" placeholder="0">
                                    </div>

                                    <div class="col-sm-6 mt-3">
                                        <label for="daily_sign_amount">Daily sign amount</label>
                                        <input type="text" class="form-control is-valid"
                                               name="daily_sign_amount" id="daily_sign_amount"
                                               placeholder="Daily sign amount"
                                               value="{{$data ? $data->daily_sign_amount : old('daily_sign_amount')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                    
                                      <div class="col-sm-12">
                                        <label for="notice">notice</label>
                                        <input type="text" class="form-control is-valid"
                                               name="notice" id="notice"
                                               placeholder="type home pop"
                                               value="{{$data ? $data->notice : old('notice')}}">
                                        <div class="valid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Note: This is filed is optional
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Submit Button -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <div style="margin-top: .7rem !important">
                                        Submit Your Setting Information
                                    </div>
                                    <div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bx bx-plus"></i>{{$data ? 'Update' : 'Submit'}} </button>
                                        </div>
                                    </div>
                                </div>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreviewFavicon(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("favicon");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection

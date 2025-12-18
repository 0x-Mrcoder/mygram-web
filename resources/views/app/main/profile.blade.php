<!doctype html>
<html lang="en">
<head>
    <meta data-n-head="ssr" charset="utf-8">
    <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=1">
    <meta data-n-head="ssr" data-hid="description" name="description" content="{{env('APP_NAME')}} APP">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('public/setting.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>
<div id="__nuxt">
    @include('alert-message')
    <?php
    $vipLevel = \App\Models\Purchase::with('package')->where('user_id', auth()->id())->orderByDesc('id')->first();
    ?>
    <div id="__layout">
        <div>
            <section data-v-1c9a3ff6="" class="settings-space flex flex-col">
                <div data-v-1c9a3ff6="" class="settings-space-header">
                    <div data-v-1c9a3ff6="" class="flex items-center flex-col">
                        <img data-v-1c9a3ff6="" style="width: 100px;height: 100px;border-radius: 10px;" src="{{asset(setting('logo'))}}" alt="">
                        <div data-v-1c9a3ff6="" class="bold name">{{auth()->user()->name}}</div>
                        <div data-v-1c9a3ff6="" class="cid">ID: {{auth()->user()->ref_id}}</div>
                        <div data-v-1c9a3ff6="" class="vip">{{$vipLevel ? $vipLevel->package->name : 'VIP0'}}</div>
                        
                    </div>
                </div>
                <div data-v-1c9a3ff6="" class="settings-space-content flex-1">
                    <div data-v-1c9a3ff6="" class="settings-space-content-wrapper">
                        <div data-v-1c9a3ff6="" class="flex items-center justify-between" onclick="window.location.href='{{url('card')}}'">
                            <div data-v-1c9a3ff6="" class="label">Withdraw Account</div>
                            <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="">
                                    <svg data-v-1c9a3ff6="" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16" fill="none">
                                    <path data-v-1c9a3ff6="" d="M6 12L10 8L6 4" stroke="#8F8A89" stroke-width="1.33333"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span></div>
                        </div>

                        <div data-v-1c9a3ff6="" class="flex items-center justify-between">
                            <div data-v-1c9a3ff6="" class="label">Nickname</div>
                            <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="" onclick="window.location.href='{{route('user.name')}}'">{{auth()->user()->name}}</span>
                                <svg data-v-1c9a3ff6="" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none">
                                    <path data-v-1c9a3ff6="" d="M6 12L10 8L6 4" stroke="#8F8A89" stroke-width="1.33333"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div data-v-1c9a3ff6="" class="flex items-center justify-between">
                            <div data-v-1c9a3ff6="" class="label">Account Number</div>
                            <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="">{{auth()->user()->phone}}</span></div>
                        </div>
                        <div data-v-1c9a3ff6="" class="flex items-center justify-between" onclick="window.location.href='{{route('user.change-password')}}'">
                            <div data-v-1c9a3ff6="" class="label">Account Password</div>
                            <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="">******</span>
                                <svg data-v-1c9a3ff6="" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none">
                                    <path data-v-1c9a3ff6="" d="M6 12L10 8L6 4" stroke="#8F8A89" stroke-width="1.33333"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>

                        <div data-v-1c9a3ff6="" class="flex items-center justify-between" onclick="window.location.href='{{route('user.withdraw-password')}}'">
                            <div data-v-1c9a3ff6="" class="label">Withdraw Password</div>
                            <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="">******</span>
                                <svg data-v-1c9a3ff6="" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none">
                                    <path data-v-1c9a3ff6="" d="M6 12L10 8L6 4" stroke="#8F8A89" stroke-width="1.33333"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div data-v-1c9a3ff6="" class="flex items-center justify-between settings-space-content-vip" onclick="window.location.href='{{route('vip.level')}}'">
                        <div data-v-1c9a3ff6="" class="label">VIP Level</div>
                        <div data-v-1c9a3ff6="" class="value"><span data-v-1c9a3ff6="">{{$vipLevel ? $vipLevel->package->name : 'VIP-LV'}}</span>
                            <svg data-v-1c9a3ff6="" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 16 16" fill="none">
                                <path data-v-1c9a3ff6="" d="M6 12L10 8L6 4" stroke="#8F8A89" stroke-width="1.33333"
                                      stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <div data-v-1c9a3ff6="" class="settings-space-content-logout" onclick="document.getElementById('logout-form').submit();">
                            Logout
                        </div>
                    </form>
                    <div data-v-1c9a3ff6="" class="settings-space-content-tips">
                        App Version: 1.0
                    </div>
                </div> <!---->
                @include('app.layout.menu')
            </section>
        </div>
    </div>
</div>
</body>
</html>

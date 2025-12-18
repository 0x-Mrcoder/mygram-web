@extends('layouts.main')

@section('head')
<link rel="stylesheet" href="/public/static/profile.css">
@endsection

@section('body')
<uni-app class="uni-app--showtabbar uni-app--maxwidth">
        <uni-page>
            <uni-page-wrapper>
                <uni-page-body>
                    <uni-view data-v-4ae790c9="" class="content">
                        <uni-view data-v-4ae790c9="" class="user-wrap d-b-c">
                            <uni-image data-v-4ae790c9="" class="avatar">
                                <div
                                    style="background-image: url('/photo_2025-06-21_16-34-18.jpg'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                </div>
                                <img src="/photo_2025-06-21_16-34-18.jpg"
                                    draggable="false">
                            </uni-image>
                            <uni-view data-v-4ae790c9="" class="flex-1">
                                <uni-view data-v-4ae790c9="" class="fb">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{ auth()->user()->phone }}</font>
                                    </font>
                                </uni-view>
                                <uni-view data-v-4ae790c9="" class="mt10 f28 gray6">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">আইডি:
                                            {{ auth()->user()->ref_id }}</font>
                                    </font>
                                </uni-view>
                            </uni-view>
                        </uni-view>
                        <uni-view data-v-4ae790c9="" class="finance d-b-c">
                            <uni-view data-v-4ae790c9="" class="flex-1 d-c-c d-c">
                                <uni-text data-v-4ae790c9="" class="f36 fb"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">{{ price(auth()->user()->balance) }}</font>
                                        </font>
                                    </span></uni-text>
                                <uni-text data-v-4ae790c9="" class="gray3 mt20 f28"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">ভারসাম্য</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="flex-1 d-c-c d-c">
                                <uni-text data-v-4ae790c9="" class="f36 fb"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">0.00৳</font>
                                        </font>
                                    </span></uni-text>
                                <uni-text data-v-4ae790c9="" class="gray3 mt20 f28"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">মোট প্রত্যাহার</font>
                                        </font>
                                    </span>
                                </uni-text>
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="flex-1 d-c-c d-c">
                                <uni-text data-v-4ae790c9="" class="f36 fb"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">0.00৳</font>
                                        </font>
                                    </span></uni-text>
                                <uni-text data-v-4ae790c9="" class="gray3 mt20 f28"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">মোট রিচার্জ</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                        </uni-view>
                        <uni-view data-v-4ae790c9="" class="menu-wrap d-b-c">
                            <uni-view data-v-4ae790c9="" class="menu-item"
                                onclick="goLink('/user/recharge')">
                                <uni-view data-v-4ae790c9="" class="menu-img">
                                    <uni-image data-v-4ae790c9="" style="height: 18px;">
                                        <div
                                            style="background-image: url('/public/static/recharge.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                        </div>
                                        <uni-resize-sensor>
                                            <div>
                                                <div></div>
                                            </div>
                                            <div>
                                                <div></div>
                                            </div>
                                        </uni-resize-sensor>
                                        <img src="/public/static/recharge.png"
                                            draggable="false">
                                    </uni-image>
                                </uni-view>
                                <uni-text data-v-4ae790c9="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">রিচার্জ</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="menu-item"
                                onclick="goLink('/withdraw')">
                                <uni-view data-v-4ae790c9="" class="menu-img">
                                    <uni-image data-v-4ae790c9="" style="height: 18px;">
                                        <div
                                            style="background-image: url('/public/static/withdraw.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                        </div>
                                        <uni-resize-sensor>
                                            <div>
                                                <div></div>
                                            </div>
                                            <div>
                                                <div></div>
                                            </div>
                                        </uni-resize-sensor>
                                        <img src="/public/static/withdraw.png"
                                            draggable="false">
                                    </uni-image>
                                </uni-view>
                                <uni-text data-v-4ae790c9="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">প্রত্যাহার করুন</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="menu-item"
                             onclick="window.location.href='/Orion.apk'">
                                <uni-view data-v-4ae790c9="" class="menu-img">
                                    <uni-image data-v-4ae790c9="" style="height: 22px;">
                                        <div
                                            style="background-image: url('/public/static/download.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                        </div>
                                        <uni-resize-sensor>
                                            <div>
                                                <div></div>
                                            </div>
                                            <div>
                                                <div></div>
                                            </div>
                                        </uni-resize-sensor>
                                        <img src="/public/static/download.png"
                                            draggable="false">
                                    </uni-image>
                                </uni-view>
                                <uni-text data-v-4ae790c9="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">ডাউনলোড</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="menu-item"
                                onclick="window.location.href='https://t.me/+77etwZALUvNmZDY9'">
                                <uni-view data-v-4ae790c9="" class="menu-img">
                                    <uni-image data-v-4ae790c9="" style="height: 18px;">
                                        <div
                                            style="background-image: url('/public/static/about.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                        </div>
                                        <uni-resize-sensor>
                                            <div>
                                                <div></div>
                                            </div>
                                            <div>
                                                <div></div>
                                            </div>
                                        </uni-resize-sensor>
                                        <img src="/public/static/about.png" draggable="false">
                                    </uni-image>
                                </uni-view>
                                <uni-text data-v-4ae790c9="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">গ্রুপ</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                        </uni-view>
                        <uni-view data-v-4ae790c9="" class="tool-wrap">
                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                                onclick="goLink('/history')">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 18px;">
                                    <div
                                        style="background-image: url('/public/static/icon_bills.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_bills.png" draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">বিল</font>
                                        </font>
                                    </span></uni-text>
                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>

                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                                onclick="goLink('/add/card')">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 18px;">
                                    <div
                                        style="background-image: url('/public/static/icon_bind_card.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_bind_card.png"
                                        draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">ব্যাঙ্ক কার্ড</font>
                                        </font>
                                    </span>
                                </uni-text>
                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                                onclick="goLink('/my-team')">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 24px;">
                                    <div
                                        style="background-image: url('/public/static/icon_commission.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_commission.png"
                                        draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">কমিশন</font>
                                        </font>
                                    </span>
                                </uni-text>
                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                               onclick="window.location.href='https://t.me/bitbeng'">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 20px;">
                                    <div
                                        style="background-image: url('/public/static/icon_help.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_help.png" draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1
                               "><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">সহায়তা কেন্দ্র</font>
                                        </font>
                                    </span>
                                </uni-text>
                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                                onclick="goLink('/my/password')">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 20px;">
                                    <div
                                        style="background-image: url('/public/static/icon_password.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_password.png"
                                        draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">পাসওয়ার্ড রিসেট করুন</font>
                                        </font>
                                    </span>
                                </uni-text>
                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>
                            <uni-view data-v-4ae790c9="" class="tool d-b-c"
                                onclick="goLink('/service')">
                                <uni-image data-v-4ae790c9="" class="tool-icon" style="height: 20px;">
                                    <div
                                        style="background-image: url('/public/static/icon_service.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                    </div>
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                    <img src="/public/static/icon_service.png"
                                        draggable="false">
                                </uni-image>
                                <uni-text data-v-4ae790c9="" class="flex-1"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">গ্রাহক সেবা</font>
                                        </font>
                                    </span></uni-text>

                                <img src="/public/static/icons8-right-25.png" alt="">
                            </uni-view>
                        </uni-view>
                        <uni-view data-v-4ae790c9="" class="logout white" onclick="logout()" style="background:#00c8c8;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">লগ আউট করুন</font>
                            </font>
                        </uni-view>
                    </uni-view>
                </uni-page-body>
            </uni-page-wrapper>
        </uni-page>
       

        
         @include('layouts.menu')

        <uni-modal id="modal" style="z-index: -1;opacity: 0;transition: .4s;">
            <div class="uni-mask"></div>
            <div class="uni-modal">
                <h2 style="text-align: center;padding-top: 10px;">ইঙ্গিত</h2>
                <div class="uni-modal__bd">আপনি কি নিশ্চিত আপনি বাইরে যেতে চান?</div>
                <div class="uni-modal__ft">
                    <div class="uni-modal__btn uni-modal__btn_default" onclick="closeModal()"
                        style="color: rgb(0, 0, 0);">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">বাতিল করুন</font>
                        </font>
                    </div>
                    <div class="uni-modal__btn uni-modal__btn_primary" onclick="logoutConfirm()"
                        style="color: rgb(0, 122, 255);">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">ঠিক আছে</font>
                        </font>
                    </div>
                </div>
            </div>
        </uni-modal>
    </uni-app>

    <script>
        function closeModal() {
            document.getElementById('modal').style.zIndex = '-1';
            document.getElementById('modal').style.opacity = '0';
            document.getElementById('modal').style.transition = '.4s';
        }

        function logout() {
            document.getElementById('modal').style.zIndex = '555';
            document.getElementById('modal').style.opacity = '1';
            document.getElementById('modal').style.transition = '.4s';
        }

        function logoutConfirm() {
            closeModal();
            app_loading()
            window.location.href = '/logout';
        }
    </script>
@endsection

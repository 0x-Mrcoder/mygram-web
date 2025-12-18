@extends('layouts.main')

@section('head')
<link rel="stylesheet" href="/public/static/home-1.css">
<link rel="stylesheet" href="/public/static/home.css">
<style>
    .product .product-top .cover[data-v-548bf0bc] {
        margin-top: 0px;
        border-radius: 50px;
    }
</style>
@endsection

@section('body')
<uni-app class="uni-app--showtabbar uni-app--maxwidth">
        <uni-page>
            <uni-page-wrapper>
                <uni-page-body>
                    <uni-view data-v-548bf0bc="" class="content">
                        <uni-view data-v-548bf0bc="" class="header d-b-c" style="margin-bottom:20px;">
                            <uni-image data-v-548bf0bc="" class="logo">
                                <div
                                    style="background-image: url('/photo_2025-06-21_16-34-18.jpg'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                </div>
                                <img src="/photo_2025-06-21_16-34-18.jpg" draggable="false">
                            </uni-image>
                            <uni-view data-v-548bf0bc="" class="header-content">
                                <uni-view data-v-548bf0bc="" class="fb">
                                    <font style="vertical-align: inherit; color:white;">
                                        <font style="vertical-align: inherit;">{{ auth()->user()->phone }}</font>
                                    </font>
                                </uni-view>
                                <uni-view data-v-548bf0bc="" class="mt10">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit; color:white;">ব্যালেন্স: {{ price(auth()->user()->balance) }}৳</font>
                                    </font>
                                </uni-view>
                            </uni-view>
                            <uni-image data-v-548bf0bc="" class="grade" style="width: 28px;"
                                onclick="window.location.href='/Orion.apk'">
                                <div
                                    style="background-image: url('/public/static/google-play-store-new.png'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                </div>
                                <img src="/public/static/google-play-store-new.png"
                                    draggable="false">
                            </uni-image>
                        </uni-view>



                        <img style="width: 100%;"
                            src="/photo_2025-06-28_13-44-27.jpg"
                            draggable="false">



                        <uni-view data-v-548bf0bc="" class="menu-wrap d-b-c">
                            <uni-view data-v-548bf0bc="" class="menu-item"
                                onclick="goLink('/user/recharge')">
                                <uni-view data-v-548bf0bc="" class="menu-img">
                                    <uni-image data-v-548bf0bc="" style="height: 18px;">
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
                                <uni-text data-v-548bf0bc="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">রিচার্জ</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-548bf0bc="" class="menu-item"
                                onclick="goLink('/withdraw')">
                                <uni-view data-v-548bf0bc="" class="menu-img">
                                    <uni-image data-v-548bf0bc="" style="height: 18px;">
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
                                <uni-text data-v-548bf0bc="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">প্রত্যাহার</font>
                                        </font>
                                    </span>
                                </uni-text>
                            </uni-view>
                            <uni-view data-v-548bf0bc="" class="menu-item"
                                onclick="goLink('/tasks')">
                                <uni-view data-v-548bf0bc="" class="menu-img">
                                    <uni-image data-v-548bf0bc="" style="height: 22px;">
                                        <div
                                            style="background-image: url('/public/static/task.png'); background-size: 100% 100%; background-repeat: no-repeat;">
                                        </div>
                                        <uni-resize-sensor>
                                            <div>
                                                <div></div>
                                            </div>
                                            <div>
                                                <div></div>
                                            </div>
                                        </uni-resize-sensor>
                                        <img src="/public/static/task.png" draggable="false">
                                    </uni-image>
                                </uni-view>
                                <uni-text data-v-548bf0bc="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">টাস্ক</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                            <uni-view data-v-548bf0bc="" class="menu-item"
                                onclick="window.location.href='https://t.me/+77etwZALUvNmZDY9'">
                                <uni-view data-v-548bf0bc="" class="menu-img">
                                    <uni-image data-v-548bf0bc="" style="height: 18px;">
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
                                <uni-text data-v-548bf0bc="" class="mt20"><span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit; color:white;">গ্রুপ</font>
                                        </font>
                                    </span></uni-text>
                            </uni-view>
                        </uni-view>
                        
                        <?php
                            use \App\Models\PackageCategory;
                            use \App\Models\Package;
                            $menu = PackageCategory::get()->toArray();
                            $packageOne = Package::where('Status', '!=','inactive')->where('tab','vip')->get();
                            $packagetwo = Package::where('Status', '!=','inactive')->where('tab', 'fixed')->get();
                            $packagethree = Package::where('Status', '!=','inactive')->where('tab', 'event')->get();
                        ?>  
    
                        <uni-view data-v-548bf0bc="" class="tabs-wrap d-b-c">
                            <uni-view data-v-548bf0bc="" class="tab-item left active" style="background:#00c8c8;" onclick="tabbber(this, 1)">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">ভিআইপি</font>
                                </font>
                            </uni-view>
                            <uni-view data-v-548bf0bc="" class="tab-item left" onclick="tabbber(this, 2)">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"></font>গরম পণ্য
                                </font>
                            </uni-view>
                        </uni-view>

                        <div class="p1">
                            @if($packageOne->count() > 0)
                                @foreach($packageOne as $key=>$element)
                                    <?php
                                        $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first();
                                        $ddIncome = $element->commission_with_avg_amount != 0 ? $element->commission_with_avg_amount / $element->validity : 0;
                                    ?>
                                    
                                    <uni-view data-v-548bf0bc="" class="product" style="position:relative;">
                                        <!--<span class="badger">.{{ $loop->iteration }}</span>-->
                                        <!--<uni-image data-v-548bf0bc="" class="grade">-->
                                        <!--    <div-->
                                        <!--        style="background-image: url('/public/static/d4s76z78nofyrpepxw.png'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">-->
                                        <!--    </div>-->
                                        <!--    <img src="/public/static/d4s76z78nofyrpepxw.png"-->
                                        <!--        draggable="false">-->
                                        <!--</uni-image>-->
                                        <uni-view data-v-548bf0bc="" class="product-top d-b-c">
                                            <uni-image data-v-548bf0bc="" class="cover">
                                                <div
                                                    style="background-image: url({{asset($element->photo)}}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                                </div>
                                                <img src="{{asset($element->photo)}}"
                                                    draggable="false">
                                            </uni-image>
                                            <uni-view data-v-548bf0bc="" class="flex-1">
                                                <uni-view data-v-548bf0bc="" class="fb gray3">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;"> {{$element->name}}</font>
                                                    </font>
                                                </uni-view>
                                                <uni-view data-v-548bf0bc="" class="price mt10 f36">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">মূল্য:
                                                            {{price($element->price)}} ৳</font>
                                                    </font>
                                                </uni-view>
                                                <uni-view data-v-548bf0bc="" class="mt10 gray6 f28">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">আয়
                                                            দিন:
                                                            {{ $element->validity }} দিন</font>
                                                    </font>
                                                </uni-view>
                                            </uni-view>
                                        </uni-view>
                                        
                                        <uni-view data-v-548bf0bc="" class="product-bottom d-b-c">
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{price($element->daily_limit/24)}}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">ঘন্টায় আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{price($element->daily_limit)}}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">দৈনিক আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $element->daily_limit * $element->validity }}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">মোট আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            
                                            @if($myVip)
                                            <uni-button data-v-548bf0bc="" class="common-btn buyBtn"
                                               >সফল </uni-button>
                                            @else
                                            <uni-button data-v-548bf0bc="" class="common-btn buyBtn" style="background:#00c8c8;"
                                                onclick='buyModal("{{$element->id}}", "pop{{$element->id}}")'>বিনিয়োগ করুন</uni-button>
                                            @endif
                                        </uni-view>
                                    </uni-view>
        
                                    <uni-view data-v-3006f50a="" data-v-548bf0bc="" class="uni-popup bottom" id="pop{{$element->id}}"
                                        style="z-index: -1;transition: .4s;opacity: 0;">
                                        <uni-view data-v-3006f50a="">
                                            <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="mask"
                                                onclick='closeModal("pop{{$element->id}}")'
                                                style="opacity: 1; position: fixed; inset: 0px; background-color: rgba(0, 0, 0, 0.4); transition: opacity 300ms, -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;"></uni-view>
                                            <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="content"
                                                style="transform: translateY(0px); opacity: 1; position: fixed; left: 0px; right: 0px; bottom: 0px; padding-bottom: 0px; background-color: transparent; transition: -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;">
                                                <uni-view data-v-3006f50a="" class="uni-popup__wrapper bottom"
                                                    style="background-color: transparent;">
                                                    <uni-view data-v-548bf0bc="" class="product-popup">
                                                        <uni-view data-v-548bf0bc="" class="d-b-c w690">
                                                            <uni-image data-v-548bf0bc="" class="cover">
                                                                <div
                                                                    style="background-image: url({{asset($element->photo)}}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                                                </div>
                                                                <img src="{{asset($element->photo)}}"
                                                                    draggable="false">
                                                            </uni-image>
                                                            <uni-view data-v-548bf0bc="" class="flex-1 ml30">
                                                                <uni-view data-v-548bf0bc="" class="fb f36">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;"> {{$element->name}}
                                                                        </font>
                                                                    </font>
                                                                </uni-view>
                                                                <uni-view data-v-548bf0bc="" class="mt10">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">মূল্য:</font>
                                                                    </font>
                                                                    <uni-text data-v-548bf0bc="" class="price"><span>
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">{{price($element->price)}}৳
                                                                                </font>
                                                                            </font>
                                                                        </span>
                                                                    </uni-text>
                                                                </uni-view>
                                                            </uni-view>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">ঘন্টায় আয়
                                                                        </font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{price($element->daily_limit/24)}}৳</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">দৈনিক আয়</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{price($element->daily_limit)}}৳</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">মোট আয়</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{ $element->daily_limit * $element->validity }}</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">আয়ের দিন</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{ $element->validity }} দিন</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-button data-v-548bf0bc="" class="common-btn"
                                                            style="margin-top: 19px;" onclick='buyConfirm("{{$element->id}}", "pop{{$element->id}}")'>
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">বিনিয়োগ
                                                                    করুন</font>
                                                            </font>
                                                        </uni-button>
                                                    </uni-view>
                                                </uni-view>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                @endforeach
                            @endif
                            
                        </div>
                        <div class="p2" style="display: none;">
                            @if($packagetwo->count() > 0)
                                @foreach($packagetwo as $key=>$element1)
                                    <?php
                                        $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element1->id)->where('status', 'active')->first();
                                        $ddIncome = $element1->commission_with_avg_amount != 0 ? $element1->commission_with_avg_amount / $element1->validity : 0;
                                    ?>
                                    
                                    <uni-view data-v-548bf0bc="" class="product" style="position:relative;">
                                        <!--<span class="badger">.{{ $loop->iteration }}</span>-->
                                        <!--<uni-image data-v-548bf0bc="" class="grade">-->
                                        <!--    <div-->
                                        <!--        style="background-image: url('/public/static/d4s76z78nofyrpepxw.png'); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">-->
                                        <!--    </div>-->
                                        <!--    <img src="/public/static/d4s76z78nofyrpepxw.png"-->
                                        <!--        draggable="false">-->
                                        <!--</uni-image>-->
                                        <uni-view data-v-548bf0bc="" class="product-top d-b-c">
                                            <uni-image data-v-548bf0bc="" class="cover">
                                                <div
                                                    style="background-image: url({{asset($element1->photo)}}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                                </div>
                                                <img src="{{asset($element1->photo)}}"
                                                    draggable="false">
                                            </uni-image>
                                            <uni-view data-v-548bf0bc="" class="flex-1">
                                                <uni-view data-v-548bf0bc="" class="fb gray3">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;"> {{$element1->name}}</font>
                                                    </font>
                                                </uni-view>
                                                <uni-view data-v-548bf0bc="" class="price mt10 f36">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">মূল্য:
                                                            {{price($element1->price)}} ৳</font>
                                                    </font>
                                                </uni-view>
                                                <uni-view data-v-548bf0bc="" class="mt10 gray6 f28">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">আয়
                                                            দিন:
                                                            {{ $element1->validity }} দিন</font>
                                                    </font>
                                                </uni-view>
                                            </uni-view>
                                        </uni-view>
                                        
                                        <uni-view data-v-548bf0bc="" class="product-bottom d-b-c">
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{price($element1->daily_limit/24)}}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">ঘন্টায় আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{price($element1->daily_limit)}}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">দৈনিক আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            <uni-view data-v-548bf0bc="" class="d-c-c d-c">
                                                <uni-text data-v-548bf0bc="" class="price f30"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $element1->daily_limit * $element1->validity }}৳</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                                <uni-text data-v-548bf0bc="" class="f28 mt10 gray6"><span>
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">মোট আয়</font>
                                                        </font>
                                                    </span>
                                                </uni-text>
                                            </uni-view>
                                            @if($myVip)
                                            <uni-button data-v-548bf0bc="" class="common-btn buyBtn"
                                               >সফল </uni-button>
                                            @else
                                            <uni-button data-v-548bf0bc="" class="common-btn buyBtn" style="background:#00c8c8;"
                                                onclick='buyModal("{{$element1->id}}", "pop{{$element1->id}}")'>বিনিয়োগ করুন</uni-button>
                                            @endif        
                                        </uni-view>
                                    </uni-view>
        
                                    <uni-view data-v-3006f50a="" data-v-548bf0bc="" class="uni-popup bottom" id="pop{{$element1->id}}"
                                        style="z-index: -1;transition: .4s;opacity: 0;">
                                        <uni-view data-v-3006f50a="">
                                            <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="mask"
                                                onclick='closeModal("pop{{$element1->id}}")'
                                                style="opacity: 1; position: fixed; inset: 0px; background-color: rgba(0, 0, 0, 0.4); transition: opacity 300ms, -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;"></uni-view>
                                            <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="content"
                                                style="transform: translateY(0px); opacity: 1; position: fixed; left: 0px; right: 0px; bottom: 0px; padding-bottom: 0px; background-color: transparent; transition: -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;">
                                                <uni-view data-v-3006f50a="" class="uni-popup__wrapper bottom"
                                                    style="background-color: transparent;">
                                                    <uni-view data-v-548bf0bc="" class="product-popup">
                                                        <uni-view data-v-548bf0bc="" class="d-b-c w690">
                                                            <uni-image data-v-548bf0bc="" class="cover">
                                                                <div
                                                                    style="background-image: url({{asset($element1->photo)}}); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                                                </div>
                                                                <img src="{{asset($element1->photo)}}"
                                                                    draggable="false">
                                                            </uni-image>
                                                            <uni-view data-v-548bf0bc="" class="flex-1 ml30">
                                                                <uni-view data-v-548bf0bc="" class="fb f36">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;"> {{$element1->name}}
                                                                        </font>
                                                                    </font>
                                                                </uni-view>
                                                                <uni-view data-v-548bf0bc="" class="mt10">
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">মূল্য:</font>
                                                                    </font>
                                                                    <uni-text data-v-548bf0bc="" class="price"><span>
                                                                            <font style="vertical-align: inherit;">
                                                                                <font style="vertical-align: inherit;">{{price($element1->price)}}৳
                                                                                </font>
                                                                            </font>
                                                                        </span>
                                                                    </uni-text>
                                                                </uni-view>
                                                            </uni-view>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">ঘন্টায় আয়
                                                                        </font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{price($element1->daily_limit/24)}}৳</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">দৈনিক আয়</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{price($element1->daily_limit)}}৳</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">মোট আয়</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{ $element1->daily_limit * $element1->validity }}</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-view data-v-548bf0bc="" class="product-info d-b-c">
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">আয়ের দিন</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                            <uni-view data-v-548bf0bc="" class="dot flex-1"></uni-view>
                                                            <uni-text data-v-548bf0bc=""><span>
                                                                    <font style="vertical-align: inherit;">
                                                                        <font style="vertical-align: inherit;">{{ $element1->validity }} দিন</font>
                                                                    </font>
                                                                </span>
                                                            </uni-text>
                                                        </uni-view>
                                                        <uni-button data-v-548bf0bc="" class="common-btn"
                                                            style="margin-top: 19px;" onclick='buyConfirm("{{$element1->id}}", "pop{{$element1->id}}")'>
                                                            <font style="vertical-align: inherit;">
                                                                <font style="vertical-align: inherit;">বিনিয়োগ
                                                                    করুন</font>
                                                            </font>
                                                        </uni-button>
                                                    </uni-view>
                                                </uni-view>
                                            </uni-view>
                                        </uni-view>
                                    </uni-view>
                                @endforeach
                            @endif
                          
                        </div>



                        <script>
                            function tabbber(_this, tabNumber) {
                                var elements = document.querySelectorAll('.tab-item');
                                for (let i = 0; i < elements.length; i++) {
                                    if (elements[i].classList.contains('active')) {
                                        elements[i].classList.remove('active');
                                    }
                                }
                                _this.classList.add('active');

                                var p1 = document.querySelector('.p1');
                                var p2 = document.querySelector('.p2');
                                if (tabNumber == 1) {
                                    p1.style.display = 'block';
                                    p2.style.display = 'none';
                                }
                                if (tabNumber == 2) {
                                    p1.style.display = 'none';
                                    p2.style.display = 'block';
                                }
                            }
                        </script>

                        <uni-view data-v-548bf0bc="" style="height: 24px;"></uni-view>
                        <uni-view data-v-3006f50a="" id="welcome" style="transition: .4s;opacity: 1;" data-v-548bf0bc=""
                            class="uni-popup center">
                            <uni-view data-v-3006f50a="">
                                <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="mask"
                                    style="opacity: 1; position: fixed; inset: 0px; background-color: rgba(0, 0, 0, 0.4); transition: opacity 300ms, -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;"></uni-view>
                                <uni-view data-v-5a3468d7="" data-v-3006f50a="" class="" name="content"
                                    style="transform: scale(1); opacity: 1; position: fixed; display: flex; flex-direction: column; inset: 0px; justify-content: center; align-items: center; transition: opacity 300ms, -webkit-transform 300ms, transform 300ms; transform-origin: 50% 50%;">
                                    <uni-view data-v-3006f50a="" class="uni-popup__wrapper center"
                                        style="background-color: transparent;">
                                        <uni-view data-v-548bf0bc="" class="home-ad" style="position: relative;">
                                            <uni-image data-v-548bf0bc="" class="ad-logo">
                                                <div
                                                    style="background-image: url(https://solar-turbine.com/public/static/download-6570486c.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;">
                                                </div>
                                                <img src="https://solar-turbine.com/public/static/download-6570486c.png"
                                                    draggable="false">
                                            </uni-image>
                                            <div  onclick="closeWelcome()" style="position: absolute; right: -10px;  top: -20px;  background: black;  color: white;border-radius: 100%;  height: 40px; width: 40px; display: flex; justify-content: center; align-items: center; font-size: 25px;">
                                                X
                                            </div>
                                            <uni-scroll-view data-v-548bf0bc="" class="ad-content">
                                                <div class="uni-scroll-view">
                                                    <div class="uni-scroll-view" style="overflow: hidden auto;">
                                                        <div class="uni-scroll-view-content">
                                                            <uni-view data-v-5594bfb4="" data-v-548bf0bc="" id="_root"
                                                                class="_root">
                                                                <uni-view data-v-51130a2d="" data-v-5594bfb4=""
                                                                    class="_block _span ">
                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d=""
                                                                                style="text-align:left">
                                                                                <strong data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                    </font>
                                                                                </strong><span data-v-51130a2d=""
                                                                                    style="font-size:20px;background-color:rgb(247, 150, 70)"><strong
                                                                                        data-v-51130a2d="" style="">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                            <font
                                                                                                style="vertical-align: inherit;">
                                                                                                 </font>
                                                                                        </font>
                                                                                    </strong></span>
                                                                                <font style="vertical-align: inherit;">
                                                                                    <strong data-v-51130a2d="" style="">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
ওরিঅন কম্পানি এ স্বাগতম: সাইট লন্স হয়েছে - তারিখ : 30/06/2025 ইং 1. নতুন ব্যবহারকারীরা রেজিস্ট্রেশনের জন্য BDT:100 টাকা লাকি স্পেন  ১০ টাকা থেকে ১০০ টাকা পযন্ত পেতে পারেন। এবং ৩৬৫ দিনের ব্যবহারের মেয়াদ সহ বিনামূল্যে একটি ডিভাইস পেতে পারেন।2. পণ্যগুলিতে বিনিয়োগ করে দৈনিক উচ্চ আয় উপার্জন করা যায়, প্রতিটি পণ্য একবার বিনিয়োগ   করা যেতে পারে এবং আপনার একই সময়ে একাধিক পণ্য কিনতে পারবেন। বি বিভিন্ন পণ্য থাকতে পারে। ১০০ টাকা পুরস্কার পেতে নিবন্ধন করার জন্য নতুন ব্যবহারকারীদের আমন্ত্রণ জানান।4. বিনিয়োগকারীদের আমন্ত্রণ জানালে বিনিয়োগকারী ২৪% বোনাস নিশ্চিত করুন
                                                                                        </font>
                                                                                    </strong><strong data-v-51130a2d=""
                                                                                        style="">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                           
                                                                                        </font>
                                                                                    </strong></font><strong
                                                                                    data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                    </font>
                                                                                </strong>
                                                                            </p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>

                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><br
                                                                                    data-v-51130a2d="" style=""></p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><strong
                                                                                    data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                     
                                                                                       </font>
                                                                                    </font><span data-v-51130a2d=""
                                                                                        style="background-color:rgb(247, 150, 70)">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                            <font
                                                                                                style="vertical-align: inherit;">
                                                                                                </font>
                                                                                        </font>
                                                                                    </span>
                                                                                </strong>
                                                                            </p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><strong
                                                                                    data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                       </font>
                                                                                    </font><span data-v-51130a2d=""
                                                                                        style="background-color:rgb(247, 150, 70)">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                            <font
                                                                                                style="vertical-align: inherit;">
                                                                                             </font>
                                                                                        </font>
                                                                                    </span>
                                                                                </strong>
                                                                            </p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><strong
                                                                                    data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                           </font>
                                                                                    </font><span data-v-51130a2d=""
                                                                                        style="background-color:rgb(247, 150, 70)">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                            <font
                                                                                                style="vertical-align: inherit;">
                                                                                            </font>
                                                                                        </font>
                                                                                    </span>
                                                                                </strong>
                                                                            </p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><strong
                                                                                    data-v-51130a2d="" style="">
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                        </font>
                                                                                    </font>
                                                                                </strong></p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                    <uni-view data-v-51130a2d="" class="_block _p "
                                                                        style="text-align: left;">
                                                                        <uni-view data-v-51130a2d=""
                                                                            class="_block _strong ">
                                                                            <uni-text data-v-51130a2d=""><span>
                                                                                    <font
                                                                                        style="vertical-align: inherit;">
                                                                                        <font
                                                                                            style="vertical-align: inherit;">
                                                                                          👉অফিসিয়াল গুরুপ লিংক 👇
                                                                                        </font>
                                                                                    </font>
                                                                                </span>
                                                                            </uni-text>
                                                                            <uni-view data-v-51130a2d="" class="_a "
                                                                                data-i="1" style="display: inline;">
                                                                                <uni-view data-v-51130a2d=""
                                                                                    class="_block _span "
                                                                                    style="display: inherit;">
                                                                                    <uni-text data-v-51130a2d=""><span>
                                                                                            <font
                                                                                                style="vertical-align: inherit;">
                                                                                                <font
                                                                                                    style="vertical-align: inherit;">
                                                                                                    <a
                                                                                                        href='https://t.me/+77etwZALUvNmZDY9'>https://t.me/+77etwZALUvNmZDY9</a>
                                                                                                </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </span>
                                                                                    </uni-text>
                                                                                </uni-view>
                                                                            </uni-view>
                                                                        </uni-view>
                                                                    </uni-view>


                                                                    <uni-rich-text data-v-51130a2d="">
                                                                        <div style="position: relative;">
                                                                            <p data-v-51130a2d="" style=""><br
                                                                                    data-v-51130a2d="" style=""></p>
                                                                            <uni-resize-sensor>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                                <div>
                                                                                    <div></div>
                                                                                </div>
                                                                            </uni-resize-sensor>
                                                                        </div>
                                                                    </uni-rich-text>
                                                                </uni-view>
                                                            </uni-view>
                                                        </div>
                                                    </div>
                                                </div>
                                            </uni-scroll-view>
                                            <uni-button data-v-548bf0bc="" class="common-btn"
                                                onclick="window.location.href='https://t.me/+77etwZALUvNmZDY9'">Join Now
                                            </uni-button>
                                        </uni-view>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                        </uni-view>
                    </uni-view>

                </uni-page-body>
            </uni-page-wrapper>
        </uni-page>


    
        @include('layouts.menu')


        <uni-actionsheet>
            <div class="uni-mask uni-actionsheet__mask" style="display: none;"></div>
            <div class="uni-actionsheet">
                <div class="uni-actionsheet__menu">
                    <div style="max-height: 260px; overflow: hidden;">
                        <div style="transform: translateY(0px) translateZ(0px);"></div>
                    </div>
                </div>
                <div class="uni-actionsheet__action">
                    <div class="uni-actionsheet__cell" style="color: rgb(0, 0, 0);">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">বাতিল করুন</font>
                        </font>
                    </div>
                </div>
                <div></div>
            </div>
        </uni-actionsheet>
        <uni-modal style="display: none;">
            <div class="uni-mask"></div>
            <div class="uni-modal">
                <div class="uni-modal__bd"></div>
                <div class="uni-modal__ft">
                    <div class="uni-modal__btn uni-modal__btn_default" style="color: rgb(0, 0, 0);">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">বাতিল করুন</font>
                        </font>
                    </div>
                    <div class="uni-modal__btn uni-modal__btn_primary" style="color: rgb(0, 122, 255);">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">ঠিক আছে</font>
                        </font>
                    </div>
                </div>
            </div>
        </uni-modal>
    </uni-app>
    
    <script>
        function closeWelcome() {
            document.getElementById('welcome').style.zIndex = '-1';
            document.getElementById('welcome').style.opacity = '0';
            document.getElementById('welcome').style.transition = '.4s';
        }
    </script>

    <script>
        function buyModal(id, elementId) {
            var element = document.getElementById(elementId);
            element.style.opacity = '1';
            element.style.transition = '.4s';
            element.style.zIndex = '66';
        }

        function closeModal(elementId) {
            var element = document.getElementById(elementId);
            element.style.opacity = '0';
            element.style.transition = '.4s';
            element.style.zIndex = '-1';
        }

        function buyConfirm(id, elementId) {
            closeModal(elementId)
            app_loading()
            
            window.location.href = "/purchase/confirmation" + '/' + id;
            return 0;
            
            $.ajax({
                url: "/purchase/confirmation" + '/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    close_loading()
                    message(res.message)

                    if (res.status == true) {
                        setTimeout(function () {
                            app_loading()
                            window.location.href = '/ordered';
                        }, 1500)
                    }
                }
            });
        }
    </script>
@endsection
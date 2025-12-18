<!doctype html>
<html lang="en">
<head>
    <meta data-n-head="ssr" charset="utf-8">
    <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=1">
    <meta data-n-head="ssr" data-hid="description" name="description" content="{{env('APP_NAME')}} APP">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('public/team.css')}}">
    <style>
        .lvmenu {
            font-size: 30px !important;
            font-style: italic;
            padding: 7px 0 !important;
        }
        .button[data-v-87511f80] {
            border-radius: 50px;
        }
    </style>
</head>
<body>
<div id="__nuxt">
    <div id="__layout">
        <div>
            <section data-v-85a3c862="" class="team-page flex flex-col">
                <div data-v-c8cd6cfa="" data-v-85a3c862="" class="header-wrapper fixed w-full team-page-header">
                    <header data-v-c8cd6cfa="" class="header w-full relative flex items-center dark">
                        <div data-v-c8cd6cfa="" class="left absolute" onclick="window.location.href='{{route('dashboard')}}'">
                            <svg data-v-c8cd6cfa="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none">
                                <path data-v-c8cd6cfa="" d="M23 12C23 11.4477 22.5523 11 22 11L4.83 11L9.71 6.12C10.1017 5.72829 10.1006 5.09284 9.70749 4.70251C9.31635 4.31412 8.68476 4.31524 8.295 4.705L2.06667 10.9333C1.47756 11.5224 1.47756 12.4776 2.06667 13.0667L8.29468 19.2947C8.68422 19.6842 9.31578 19.6842 9.70532 19.2947C10.0946 18.9054 10.0949 18.2743 9.70595 17.8847L4.83 13L22 13C22.5523 13 23 12.5523 23 12Z"
                                      fill="currentColor"></path>
                            </svg>
                        </div>
                        <div data-v-c8cd6cfa="" class="title bold flex-1">My Team</div>
                    </header>
                </div>
                <div data-v-85a3c862="" class="team-page-content flex flex-col flex-1">
                    <div data-v-85a3c862="" class="team-page-tabs">
                        <div data-v-85a3c862="" class="team-page-tabs-values flex">
                            <div data-v-85a3c862="" data-key="0" class="lvmenu active" onclick="lvMenu(this, 'lv1')">LV1</div>
                            <div data-v-85a3c862="" data-key="1" class="lvmenu" onclick="lvMenu(this, 'lv2')">LV2</div>
                            <div data-v-85a3c862="" data-key="2" class="lvmenu" onclick="lvMenu(this, 'lv3')">LV3</div>
                        </div>
                        <div data-v-85a3c862="" class="team-page-tabs-details">
                            <div data-v-85a3c862="" class="team-page-tabs-tips">If the friend you refer makes the first
                                investment, you can get <span data-v-85a3c862="">unlimited money</span></div>
                            <div data-v-85a3c862="" class="team-page-tabs-statistics flex items-center justify-between">
                                <div data-v-85a3c862="" class="flex flex-col items-center flex-1">
                                    <div data-v-85a3c862="" class="value bold teamsize">{{$first_level_users->count()}}</div>
                                    <div data-v-85a3c862="" class="label">Team Size</div>
                                </div>
                                <div data-v-85a3c862="" class="flex flex-col items-center flex-1">
                                    <div data-v-85a3c862="" class="value bold totalDeposit">{{price($totalDeposit1)}}</div>
                                    <div data-v-85a3c862="" class="label">Total Deposit</div>
                                </div>
                                <div data-v-85a3c862="" class="flex flex-col items-center flex-1">
                                    <div data-v-85a3c862="" class="value bold totalDeposit">{{price($totalWithdraw1 + $totalWithdraw2 + $totalWithdraw3)}}</div>
                                    <div data-v-85a3c862="" class="label">Total Withdraw</div>
                                </div>
                            </div>
                            <button data-v-87511f80="" data-v-85a3c862="" type=""
                                    onclick="copyLink('{{url('register').'?inviteCode='.auth()->user()->ref_id}}')"
                                    class="w-full button flex items-center justify-center relative button-primary default">
                                <svg data-v-85a3c862="" data-v-87511f80="" xmlns="http://www.w3.org/2000/svg" width="21"
                                     height="20" viewBox="0 0 21 20" fill="none">
                                    <path data-v-85a3c862="" data-v-87511f80=""
                                          d="M5.19597 10.0001C4.49259 9.29676 4.09744 8.34278 4.09744 7.34806C4.09744 6.35333 4.49259 5.39935 5.19597 4.69597C5.89934 3.9926 6.85332 3.59744 7.84805 3.59744C8.84277 3.59744 9.79676 3.9926 10.5001 4.69597L11.8251 6.02097C11.9846 6.1575 12.1896 6.22883 12.3993 6.22073C12.6091 6.21263 12.808 6.12569 12.9564 5.97728C13.1048 5.82886 13.1918 5.62991 13.1999 5.42018C13.208 5.21045 13.1367 5.00539 13.0001 4.84597L11.6793 3.51681C11.1683 3.00411 10.5589 2.60016 9.88763 2.32931C8.57859 1.80429 7.11751 1.80429 5.80847 2.32931C5.13807 2.60171 4.52904 3.00568 4.01736 3.51736C3.50567 4.02905 3.1017 4.63807 2.8293 5.30847C2.30169 6.61701 2.30169 8.0791 2.8293 9.38764C3.10016 10.0589 3.5041 10.6683 4.0168 11.1793L5.34597 12.5001C5.50474 12.6435 5.71256 12.7203 5.92641 12.7147C6.14025 12.709 6.34374 12.6214 6.49473 12.4698C6.64573 12.3183 6.73267 12.1145 6.73755 11.9007C6.74243 11.6868 6.66489 11.4792 6.52097 11.321L5.19597 10.0001ZM18.171 10.6126C17.9001 9.94139 17.4962 9.33193 16.9835 8.82097L15.6543 7.50014C15.5784 7.41662 15.4862 7.34941 15.3835 7.30257C15.2808 7.25573 15.1696 7.23025 15.0568 7.22768C14.9439 7.2251 14.8317 7.24548 14.727 7.28758C14.6222 7.32968 14.5272 7.39262 14.4475 7.47258C14.3678 7.55255 14.3052 7.64786 14.2635 7.75275C14.2217 7.85765 14.2017 7.96992 14.2047 8.08277C14.2077 8.19561 14.2336 8.30668 14.2808 8.40922C14.328 8.51177 14.3955 8.60365 14.4793 8.67931L15.8043 10.0001C16.1526 10.3484 16.4288 10.7619 16.6173 11.2169C16.8058 11.672 16.9028 12.1597 16.9028 12.6522C16.9028 13.1448 16.8058 13.6325 16.6173 14.0875C16.4288 14.5426 16.1526 14.956 15.8043 15.3043C15.456 15.6526 15.0426 15.9289 14.5875 16.1173C14.1325 16.3058 13.6448 16.4028 13.1522 16.4028C12.6597 16.4028 12.172 16.3058 11.7169 16.1173C11.2619 15.9289 10.8484 15.6526 10.5001 15.3043L9.17513 13.9793C9.10043 13.8921 9.00849 13.8212 8.90511 13.7712C8.80172 13.7212 8.68911 13.6931 8.57434 13.6886C8.45958 13.6842 8.34513 13.7035 8.2382 13.7454C8.13126 13.7873 8.03414 13.8509 7.95292 13.9321C7.87171 14.0133 7.80816 14.1104 7.76627 14.2174C7.72437 14.3243 7.70503 14.4388 7.70947 14.5535C7.7139 14.6683 7.74201 14.7809 7.79203 14.8843C7.84205 14.9877 7.9129 15.0796 8.00013 15.1543L9.32513 16.4835C9.83609 16.9962 10.4456 17.4001 11.1168 17.671C12.4253 18.1986 13.8874 18.1986 15.196 17.671C15.8664 17.3986 16.4754 16.9946 16.9871 16.4829C17.4988 15.9712 17.9027 15.3622 18.1751 14.6918C18.7027 13.3833 18.7027 11.9212 18.1751 10.6126H18.171Z"
                                          fill="white"></path>
                                    <path data-v-85a3c862="" data-v-87511f80=""
                                          d="M13.1505 13.4829C13.311 13.4792 13.4671 13.4292 13.5998 13.339C13.7326 13.2487 13.8365 13.1221 13.899 12.9742C13.9615 12.8263 13.9799 12.6635 13.9521 12.5054C13.9243 12.3473 13.8514 12.2006 13.7422 12.0829L8.43803 6.75789C8.3606 6.68046 8.26869 6.61904 8.16753 6.57714C8.06636 6.53524 7.95794 6.51367 7.84845 6.51367C7.73895 6.51367 7.63053 6.53524 7.52937 6.57714C7.4282 6.61904 7.33629 6.68046 7.25886 6.75789C7.18144 6.83531 7.12002 6.92723 7.07812 7.02839C7.03622 7.12955 7.01465 7.23797 7.01465 7.34747C7.01465 7.45696 7.03622 7.56539 7.07812 7.66655C7.12002 7.76771 7.18144 7.85963 7.25886 7.93705L12.5839 13.2412C12.7349 13.3912 12.9377 13.4777 13.1505 13.4829Z"
                                          fill="white"></path>
                                </svg>Copy Link to Invite Friends</button>
                        </div>
                    </div>
                    <div data-v-85a3c862="" class="team-page-content-details lv1Record">
                        @foreach($first_level_users as $element)
                            <?php
                            $deposit = \App\Models\Deposit::where('user_id', $element->id)->where('status', 'approved')->first();
                            ?>
                            <div data-v-85a3c862="" class="team-page-content-details-item flex items-center justify-between">
                                <div data-v-85a3c862="">
                                    <div data-v-85a3c862="" class="cid">ID: {{$element->ref_id}}</div>
                                    <div data-v-85a3c862="" class="date">{{$element->created_at}}</div>
                                </div>
                                <div data-v-85a3c862="" class="status" style="@if($deposit) color:green;border: 1px solid green; @else color:red;border: 1px solid red; @endif">@if($deposit) Active @else In-Active @endif</div>
                            </div>
                        @endforeach
                    </div>

                    <div data-v-85a3c862="" style="display: none;" class="team-page-content-details lv2Record">
                        @foreach($second_level_users as $element)
                            <?php
                            $deposit = \App\Models\Deposit::where('user_id', $element->id)->where('status', 'approved')->first();
                            ?>
                            <div data-v-85a3c862="" class="team-page-content-details-item flex items-center justify-between">
                                <div data-v-85a3c862="">
                                    <div data-v-85a3c862="" class="cid">ID: {{$element->ref_id}}</div>
                                    <div data-v-85a3c862="" class="date">{{$element->created_at}}</div>
                                </div>
                                <div data-v-85a3c862="" class="status" style="@if($deposit) color:green;border: 1px solid green; @else color:red;border: 1px solid red; @endif">@if($deposit) Active @else In-Active @endif</div>
                            </div>
                        @endforeach
                    </div>

                    <div data-v-85a3c862="" style="display: none;" class="team-page-content-details lv3Record">
                        @foreach($third_level_users as $element)
                            <?php
                            $deposit = \App\Models\Deposit::where('user_id', $element->id)->where('status', 'approved')->first();
                            ?>
                            <div data-v-85a3c862="" class="team-page-content-details-item flex items-center justify-between">
                                <div data-v-85a3c862="">
                                    <div data-v-85a3c862="" class="cid">ID: {{$element->ref_id}}</div>
                                    <div data-v-85a3c862="" class="date">{{$element->created_at}}</div>
                                </div>
                                <div data-v-85a3c862="" class="status" style="@if($deposit) color:green;border: 1px solid green; @else color:red;border: 1px solid red; @endif">@if($deposit) Active @else In-Active @endif</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('alert-message')
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }
</script>
<script>
    var teamSizeOne = '{{$first_level_users->count()}}';
    var teamSizeTwo = '{{$second_level_users->count()}}';
    var teamSizeThree = '{{$third_level_users->count()}}';

    var lv1TotalDeposit = '{{price($totalDeposit1)}}';
    var lv2TotalDeposit = '{{price($totalDeposit2)}}';
    var lv3TotalDeposit = '{{price($totalDeposit3)}}';

    function lvMenu(_this, lv){
        let lvmenus = document.querySelectorAll('.lvmenu');
        let lv1Record = document.querySelector('.lv1Record');
        let lv2Record = document.querySelector('.lv2Record');
        let lv3Record = document.querySelector('.lv3Record');

        let teamsize = document.querySelector('.teamsize');
        let totalDeposit = document.querySelector('.totalDeposit');

        for (let i=0;i<lvmenus.length;i++){
            if (lvmenus[i].classList.contains('active')){
                lvmenus[i].classList.remove('active');
            }
        }


        if (lv == 'lv1'){
            lv2Record.style.display = 'none';
            lv3Record.style.display = 'none';
            lv1Record.style.display = 'block';

            totalDeposit.innerHTML = lv1TotalDeposit;
            teamsize.innerHTML = teamSizeOne;
            _this.classList.add('active');
        }
        if (lv == 'lv2'){
            lv1Record.style.display = 'none';
            lv3Record.style.display = 'none';
            lv2Record.style.display = 'block';

            totalDeposit.innerHTML = lv2TotalDeposit;
            teamsize.innerHTML = teamSizeTwo;
            _this.classList.add('active');
        }
        if (lv == 'lv3'){
            lv1Record.style.display = 'none';
            lv2Record.style.display = 'none';
            lv3Record.style.display = 'block';

            totalDeposit.innerHTML = lv3TotalDeposit;
            teamsize.innerHTML = teamSizeThree;
            _this.classList.add('active');
        }
    }
</script>
</body>
</html>

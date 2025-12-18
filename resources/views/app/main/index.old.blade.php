

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css?t=1.2">
  <link rel="stylesheet" href="/public/site/css/swiper-bundle.min.css" />
  <style>
    .menu_item {
      box-shadow: 0px 4px 10px 0px rgba(42, 65, 92, 0.5);
    }

    .product_card {
      box-shadow: 0px 4px 10px 0px rgba(42, 65, 92, 0.5);
    }

    .index_header_card {
      box-shadow: 0px 4px 10px 0px rgba(42, 65, 92, 0.5);
    }

    .common_card .title {
      padding-left: 10px;
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #0F7A5A;
      height: 30px;
      line-height: 30px;
      display: flex;
      justify-content: space-between;
    }

    .reward_card {
      height: auto;
      background-image: url("/public/site/img/tasks/bg.png?t=222");
      background-size: 100%;
      background-repeat: no-repeat;
      border-radius: 15px;
      padding-top: 40px;
    }

    .reward_icon {
      height: 30px;
      width: 30px;
    }

    .reward_card .title {
      padding-left: 15px;
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 18px;
      color: #333333;
    }

    .reward_card .label {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #333333;
      line-height: 16px;
    }

    .reward_card .value {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #333333;
      line-height: 18px;
    }

    .reward_card .content {
      margin-bottom: 15px;
      margin-top: unset;
      width: 100%;
    }

    .reward_text {
      margin-top: 10px;
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #666666;
      line-height: 24px;
    }

    .link {
      padding-left: 10px;
      margin-bottom: 10px;
    }

    .copy_btn {
      width: 60px;
      height: 26px;
      background: linear-gradient(180deg, #4A6DEB 0%, #5C7DF5 100%);
      border-radius: 100px 100px 100px 100px;
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #FFFFFF;
      line-height: 26px;
      text-align: center;
    }

    .go_btn {
      margin-top: 10px;
      width: 50px;
      height: 18px;
      padding: 4px 10px;
      background: #359B5A;
      border-radius: 100px 100px 100px 100px;
      font-weight: 700;
      font-size: 16px;
      color: #FFFFFF;
    }
    .slider-wrapper {
  width: 100%;
  max-width: 600px;
  aspect-ratio: 16 / 9; /* এই লাইনটি height এর বদলে */
  overflow: hidden;
  border-radius: 8px;
  margin: 20px auto;
  position: relative;
}

.slider img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  display: block;
}

.product_card .buy {
    width: 100%;
    height: 30px;
    background: #5CB26C;
    border-radius: 20px;
    text-align: center;
    font-family: Arial, Arial;
    font-weight: 700;
    font-size: 14px;
    color: #ffffff;
    line-height: 30px;
    /* width: 100%; */
    margin-top: 10px;
}

.layui-col-space15 {
    margin: 0px;
}

.index_header {
    position: relative;
    padding: 0px;
    padding-bottom: 0px;
    background: linear-gradient( 177deg, #FFFFFF 0%, #F4F4F4 100%);
}


  </style>
</head>

<body>
  <div class="index_header">
    <div class="index_logo">
      <div>
        <h1 style="color:#398346;line-height:50px;">Agriland-Farms</h1>
        <!--<img src="/public/site/img/index/logo.png" style="height: 42px;width: auto;">-->
      </div>
      <a href="/mail" class="notice position" style="line-height: 42px;">
        <span class="layui-badge" style="position: absolute;top: 5px;border-radius: 50%;right: 2px"></span> <img src="/public/site/img/index/notice.png" style="height: 24px;width: 24px;border-radius: 50%"></a>
    </div>
     <img src="/photo_2025-09-13_22-56-21.jpg" width="100%" height="200">
    <!--<img src="/photo_2025-07-25_22-05-12.jpg" alt="Slide 1 duplicate" />-->
  </div>
</div>

    <!--<a href="/tasks" class="index_header_card" style="display: block">-->
    <!--  <div class="flex_space">-->
    <!--    <div>-->
    <!--      <p class="title">The next reward for an upcoming mission</p>-->
    <!--      <p class="desc">If your referred friend upgrades to VIP1, you will get 35% commission draw and one chance of lucky wheel draw!</p>-->
    <!--    </div>-->
    <!--    <img src="/public/site/img/index/reward.png" style="width: 78px;height: 86px;">-->
    <!--  </div>-->
    <!--  <p class="desc" style="margin-top: 0px">Reward amount <span class="title layui-font-18">₹</span> Click to enter the query</p>-->
    <!--  <div class="flex_space">-->
    <!--    <div class="layui-progress" lay-filter="demo-filter-progress" style="width: 100%;height: 10px;margin-top: 5px">-->
    <!--      <div class="layui-progress-bar" lay-percent="0 / 1" style="width:100%;height: 10px;background: linear-gradient( 90deg, #F8D96A 0%, #F2D323 100%);;"></div>-->
    <!--    </div>-->
    <!--    <div style="width: 120px;margin-left: 5px;color:#CBF7DC">-->
    <!--      people-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</a>-->
    <div class="layui-row layui-col-space15" style="margin-top: 15px;">
      <div class="layui-col-md6 layui-col-xs6">
        <a href="/user/recharge" class="menu_item flex_left">
          <img src="/public/site/img/index/recharge.png" style="width: 50px;height: 50px;margin-right: 10px">
          <div>
            <p class="menu_title">Recharge</p>
            <p class="menu_desc">৳ {{$totalDeposit}}</p>
          </div>
        </a>
      </div>
      <div class="layui-col-md6 layui-col-xs6">
        <a href="/withdraw" class="menu_item flex_left">
          <img src="/public/site/img/index/withdrawal.png" style="width: 50px;height: 50px;margin-right: 10px">
          <div>
            <p class="menu_title">Withdrawal</p>
            <p class="menu_desc">৳ {{$totalWithdraw}}</p>
          </div>
        </a>
      </div>
    </div>
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md6 layui-col-xs6">
        <a href="/my-team" class="menu_item flex_left">
          <img src="/public/site/img/index/team.png" style="width: 50px;height: 50px;margin-right: 10px">
          <div>
            <p class="menu_title">Team</p>
            <p class="menu_desc">Team size: {{$totalReferralCount}}</p>
          </div>
        </a>
      </div>
      <div class="layui-col-md6 layui-col-xs6">
        <a href="/my/vip" class="menu_item flex_left">
          <img src="/6815043.png" style="width: 50px;height: 50px;margin-right: 10px">
          <div>
            <p class="menu_title"> Orders</p>
            <p class="menu_desc">My  Orders</p>
          </div>
        </a>
      </div>
    </div>
    <a href="lottery" style="margin-top: 15px;display:block">
      <img src="/public/site/img/index/banner_bg.jpg" style="width: 100%;height: auto;border-radius:8px;box-shadow: 0px 2px 10px 0px rgba(42, 65, 92, 0.5);">
    </a>

  </div>
  <div class="index_main" style="margin-bottom: 80px">
    <div class="common_card" style="padding: 10px;">
      <div class="title" style="padding-left: 0px; color:#000;">Sign in to receive rewards</div>
      <div class="desc">Daily check-in can receive ৳ 10</div>
      <div class="go_btn flex_space" onclick="window.location.href='/checkin'" id="sign_in" style="width: 120px">
        <p>Sign in now</p>
      </div>



    </div>
    
    <?php
            use \App\Models\PackageCategory;
            use \App\Models\Package;
            $menu = PackageCategory::get()->toArray();
            $packageOne = Package::where('Status', '!=','inactive')->where('tab','vip')->get();
            $packagetwo = Package::where('Status', '!=','inactive')->where('tab', 'fixed')->get();
            $packagethree = Package::where('Status', '!=','inactive')->where('tab', 'event')->get();
        ?>  
        
  <div class="" style="margin-top: 40px">
    <div class="product_type_1 product_list">
         @if($packageOne->count() > 0)
                @foreach($packageOne as $key=>$element)
                    <?php
                        $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first();
                        $ddIncome = $element->commission_with_avg_amount != 0 ? $element->commission_with_avg_amount / $element->validity : 0;
                    ?>
                            
          <a href="#" class="product_card position">
            <div style="padding: 10px">
              <!--<div class="product_title_card">-->
              <!--  <div class="flex_space">-->
              <!--    <div>-->
              <!--      <img src="/public/site/img/vip/lv0.png" class="lv"> {{$element->name}}-->
              <!--    </div>-->
                 
              <!--  </div>-->
    
              <!--</div>-->
              <div class="product_content position">
                <div class="product_title flex_left">
                  <div class="product_image">
                    <img src="{{asset($element->photo)}}">
                  </div>
    
                  <div class="product_info">
                    <div class="product_item flex_space">
                      <p class="label">Name</p>
                      <p class="value ">
                        <!--<span class="unit">₹</span>-->
                        <span class="position">{{ $element->name }}</span>
                      </p>
    
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Each Price</p>
                      <p class="value position" style="font-weight: 700">
                        <!--<span class="unit">₹</span>-->
                        <span class="price">{{price($element->price)}}</span>
                      </p>
    
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Revenue</p>
                      <p class="value position">
                         {{ $element->validity }} Days
                      </p>
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Daily Earnings</p>
                      <p class="value">
                        <span class="position">
                          <!--<span class="unit">₹</span>-->
                          {{price($element->daily_limit)}} </span>
                      </p>
    
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Total Revenue</p>
                      <p class="value">
                        <span class="position">
                          <!--<span class="unit">₹</span>-->
                           {{ $element->daily_limit * $element->validity }} </span>
                      </p>
                    </div>
                    
                  </div>
                  
                </div>
                
                      @if($myVip)
                      <div class="buy">Current</div>
                      @else
                      <div class="buy" onclick="window.location.href = '/purchase/confirmation/{{ $element->id }}'">Buy</div>
                      @endif
    
    
              </div>
            </div>
          </a>
      
      @endforeach
      
      @else
       <div class='none_data  hide'>
        <img class="none_image" src="/public/site/img/order/none_order.png">
        <p class="none_text">
          No items available for invest
        </p>
      </div>
      @endif
         
     
    </div>
    
    <div class="product_type_2 product_list hide">
         @if($packagetwo->count() > 0)
                @foreach($packagetwo as $key=>$element1)
                    <?php
                        $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element1->id)->where('status', 'active')->first();
                        $ddIncome = $element1->commission_with_avg_amount != 0 ? $element1->commission_with_avg_amount / $element1->validity : 0;
                    ?>
       <a href="#" class="product_card position">
            <div style="padding: 10px">
              <div class="product_title_card">
                <div class="flex_space">
                  <div>
                    <img src="/public/site/img/vip/lv0.png" class="lv"> {{$element1->name}}
                  </div>
                  @if($myVip)
                  <div class="buy">Current</div>
                  @else
                  <div class="buy" onclick="window.location.href = '/purchase/confirmation/{{ $element1->id }}'">Buy</div>
                  @endif
                </div>
    
              </div>
              <div class="product_content position">
                <div class="product_title flex_left">
                  <div class="product_image">
                    <img src="{{asset($element1->photo)}}">
                  </div>
    
                  <div class="product_info">
                    <div class="product_item flex_space">
                      <p class="label">Each Price</p>
                      <p class="value position" style="font-weight: 700">
                        <!--<span class="unit">₹</span>-->
                        <span class="price">{{price($element1->price)}}</span>
                      </p>
    
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Revenue</p>
                      <p class="value position">
                         {{ $element1->validity }} Days
                      </p>
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Daily Earnings</p>
                      <p class="value">
                        <span class="position">
                          <!--<span class="unit">₹</span>-->
                          {{price($element1->daily_limit)}} </span>
                      </p>
    
                    </div>
                    <div class="product_item flex_space">
                      <p class="label">Total Revenue</p>
                      <p class="value">
                        <span class="position">
                          <!--<span class="unit">₹</span>-->
                           {{ $element1->daily_limit * $element1->validity }} </span>
                      </p>
                    </div>
    
                  </div>
                </div>
    
              </div>
            </div>
          </a>
     
      @endforeach
      
      @else
       <div class='none_data  hide'>
        <img class="none_image" src="/public/site/img/order/none_order.png">
        <p class="none_text">
          No items available for invest
        </p>
      </div>
      @endif
    </div>
    
    <div class="product_type_3 product_list hide">
     
      <div class='none_data  hide'>
        <img class="none_image" src="/public/site/img/order/none_order.png">
        <p class="none_text">
          No items available for invest
        </p>
      </div>
    </div>

    <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>https://optimallearning4.com/?invitation_code=D4FAC</textarea>
  </div>



    <div class="reward_card" style="display: none;">
      <div class="title" style="font-weight:700; color:#000;">
        <p>Cumulative task rewards</p>
      </div>
      <div style=" background: #FFFFFF;padding: 15px;border-radius: 15px;">
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 2</div>
              <div class="value position"><span class="unit">৳ </span>200.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 2</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 70</div>
              <div class="value position"><span class="unit">৳ </span>3500.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 70</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 200</div>
              <div class="value position"><span class="unit">৳ </span>15000.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 200</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 500</div>
              <div class="value position"><span class="unit">৳ </span>50000.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 500</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 1000</div>
              <div class="value position"><span class="unit">৳ </span>150000.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 1000</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="reward_card" style="display: none;">
      <div class="title" style="font-weight:700; color:#000;">
        <p>Daily invite rewards</p>
      </div>
      <div style=" background: #FFFFFF;padding: 15px;border-radius: 15px;">
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 1</div>
              <div class="value position"><span class="unit">₹</span>10.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 1</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 5</div>
              <div class="value position"><span class="unit">₹</span>100.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 5</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 20</div>
              <div class="value position"><span class="unit">₹</span>500.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 20</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 50</div>
              <div class="value position"><span class="unit">₹</span>2000.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 50</div>
            </div>
          </div>
        </div>
        <div class="content flex_left">
          <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
            <img src="/public/site/img/tasks/reward_icon.png" style="width: 34px;height: 34px;">
          </div>

          <div style="width: 100%">
            <div class="flex_space" style="margin-bottom: 10px;">
              <div class="label">Inviting activation of 100</div>
              <div class="value position"><span class="unit">₹</span>5000.00</div>
            </div>
            <div class="flex_space">
              <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%" style="height: 10px;background: linear-gradient( 102deg, #24A196 0%, #27C85D 100%);"></div>
              </div>
              <div class="value"><span style="color: #359B5A">0</span> / 100</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <textarea id="notice_content" style="display: none"></textarea>

  <a href="/service" id="service">
    <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">
  </a>


  <div class="footer_menu">

    <div class="content">
      <a href="/" class="item active">
        <img src="/public/site/img/footer/home_active.png" />
        <p>Home</p>
      </a>
      <a href="/vip" class="item ">
        <img src="/public/site/img/footer/invest.png" />
        <p>Invest</p>
      </a>
      <!--<a href="/blog" class="item ">-->
      <!--  <img src="/public/site/img/footer/mboard.png" />-->
      <!--  <p>Blog</p>-->
      <!--</a>-->
      <a href="/my-team" class="item ">
        <img src="/public/site/img/footer/notice.png" />
        <p>Team</p>
      </a>


      <a href="/mine" class="item ">
        <img src="/public/site/img/footer/account.png" />
        <p>Account</p>
      </a>
    </div>
  </div>
<style>
  .slider-wrapper {
    width: 100%;
    max-width: 600px;
    overflow: hidden;
    border-radius: 8px;
    margin: 20px auto;
    position: relative;
  }

  .slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: calc(4 * 100%); /* 4 images */
  }
</style>

<script>
  const slider = document.querySelector('.slider');
  const slides = document.querySelectorAll('.slider img');
  const totalSlides = slides.length;
  let currentIndex = 0;

  function nextSlide() {
    currentIndex++;
    slider.style.transition = 'transform 0.5s ease-in-out';
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;

    // যখন ডুপ্লিকেট শেষ ছবিতে পৌঁছাবে তখন স্মুথলি প্রথম স্লাইডে চলে যাবে
    if (currentIndex === totalSlides - 1) {
      setTimeout(() => {
        slider.style.transition = 'none';
        currentIndex = 0;
        slider.style.transform = `translateX(0)`;
      }, 500); // transition duration এর সমান সময় দিতে হবে
    }
  }

  setInterval(nextSlide, 3000);
</script>
  <script src="/public/site/layui/layui.js"></script>
   @include('alert-message')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
    
        $('#fund_btn').click(function(){
            $('#vip').addClass('hidden');
            $('#fund').removeClass('hidden');
            $('#vip_btn').removeClass('active');
            $(this).addClass('active');
        });
        
        $('#vip_btn').click(function(){
            $('#fund').addClass('hidden');
            $('#vip').removeClass('hidden');
            $('#fund_btn').removeClass('active');
            $(this).addClass('active');
        });
    </script>
    
  <script>
    layui.use(function () {
      var $ = layui.jquery;
      var layer = layui.layer;
      var l = "En"

      $('.nav').click(function () {
        var type = $(this).attr('data-type')
        var image_value = $(this).attr('data-image')
        console.log(image_value)
        if (image_value == 'fixed') {
          $('.nav_fixed').attr('src', '/public/site/img/product/fixed_active.png')
          $('.nav_welfare').attr('src', '/public/site/img/product/welfare.png')
          $('.nav_activity').attr('src', '/public/site/img/product/activity.png')
        }
        if (image_value == 'welfare') {
          $('.nav_fixed').attr('src', '/public/site/img/product/fixed.png')
          $('.nav_welfare').attr('src', '/public/site/img/product/welfare_active.png')
          $('.nav_activity').attr('src', '/public/site/img/product/activity.png')
        }
        if (image_value == 'activity') {
          $('.nav_fixed').attr('src', '/public/site/img/product/fixed.png')
          $('.nav_welfare').attr('src', '/public/site/img/product/welfare.png')
          $('.nav_activity').attr('src', '/public/site/img/product/activity_active.png')
        }
        $('.nav').removeClass('nav_active');
        $(this).addClass('nav_active')
        $('.product_list').removeClass('hide')
        $('.product_list').removeClass('show')
        $('.product_list').addClass('hide')
        $('.product_type_' + type).removeClass('hide').addClass('show')

      })



      var Telegram_channel = '#';


      var content = '<div class="dialog">' +
        '<div class="dialog_contents">' +
        '<div class="logo"><img src="/public/site/img/index/telegram.png" style=""></div>' +
        '<div class="title" style="margin:15px 0;text-align: center;font-weight: 700;font-size: 20px;">Telegeram</div>' +
        '<div class="text" style="text-align: center;font-weight:400;font-size: 14px;color: #818393;line-height: 24px;">' +
        'Follow our official telegram channel for the latest news and discounts.' +
        '</div>' +
        '</div>' +
        '<div class="btn_group">' +
        '<a href="https://t.me/Agriland_farms_bd" class="confirm telegram_confirm" style="width: 100%">Follow Now</a>' +
        '</div>' +
        '</div>'

      var service_index = layer.open({
        type: 1,
        area: ['90%', 'auto'], // 宽高
        title: false, // 不显示标题栏
        closeBtn: true,
        shadeClose: true, // 点击遮罩关闭层
        content: content
      });

      $(document).on('click', '.telegram_confirm', function () {
        layer.close(service_index)
      })


      var elem = $('.message');
      var is_show = 1;
      setInterval(function () {
        if (is_show == 1) {
          $('.message').hide();
          is_show = 0;
        } else {
          $('.message').show();
          is_show = 1;
        }

      }, 1500);


      $(document).on('click', '#sign_in', function () {
        $.post('/doSignIn', {}, function (res) {
          var data = res.result;
          if (res.status == 1) {
            layer.msg(res.msg, {
              time: 3000
            }, function () {
              window.location.reload();
            });
          } else {
            layer.msg(res.msg);
          }
        })
      })
      $(document).on('click', '#sign_rules', function () {
        layer.open({
          type: 1,
          area: ['90%', 'auto'], // 宽高
          title: false, // 不显示标题栏
          closeBtn: true,
          shadeClose: true, // 点击遮罩关闭层
          content: $("#sign_rules_dialog")
        });
      })

    });
  </script>
</body>

</html>
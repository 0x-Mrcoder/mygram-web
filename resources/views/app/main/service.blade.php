

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Help Center</title>
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    .help_card {
      margin: 20px;
      padding: 15px 20px;
      background: #FFFFFF;
      border-radius: 8px 8px 8px 8px;
      border: none;
    }

    .help_card .logo {
      padding-right: 10px;
    }

    .help_card .logo img {
      width: 60px;
      height: 60px;
    }

    .help_card .title {
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #333333;
      line-height: 22px;
    }

    .help_card .describe {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #666666;
      line-height: 22px;
    }
  </style>
</head>

<body>

  <body class="common_body">
    <div class="common_header common_header_order" style="height: 150px">
      <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        Help Center
      </a>
    </div>
    <div style="position: relative;top: -80px;">
      <!--<div class="help_card" style="margin-top: 30px;">-->
      <!--  <div href='{{ setting('telegram_group') }}' class="flex_left service">-->
      <!--    <div class="logo">-->
      <!--      <img src="/public/site/img/user/service.png" />-->
      <!--    </div>-->
      <!--    <div>-->
      <!--      <p class="title">Online service</p>-->
      <!--      <p class="describe">Working hours: 08:00:00-17:30:00</p>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->
      <div class="help_card">
        <a href='{{ setting('telegram_channel') }}' class="flex_left">
          <div class="logo">
            <img src="/public/site/img/user/telegram.png" />
          </div>
          <div>
            <p class="title"> Customers Support</p>
            <p class="describe">Follow our official telegram channel for the latest news and discounts.</p>
          </div>
        </a>
      </div>
       <div class="help_card">
        <a href='{{ setting('telegram_group') }}' class="flex_left">
          <div class="logo">
            <img src="/public/site/img/user/telegram.png" />
          </div>
          <div>
            <p class="title">Telegram </p>
            <p class="describe">Follow our official telegram channel for the latest news and discounts.</p>
          </div>
        </a>
      </div>
      <!--<div class="help_card">-->
      <!--  <a href='{{ setting('telegram_channel') }}' class="flex_left">-->
      <!--    <div class="logo">-->
      <!--      <img src="/public/site/img/help/recharge.png" />-->
      <!--    </div>-->
      <!--    <div>-->
      <!--      <p class="title">Your deposit has not been received yet?</p>-->
      <!--      <p class="describe">-->
      <!--        After successfully charging your account, if the balance has not been entered into your account, please provide it here and customer service personnel will assist you in handling it!</p>-->
      <!--    </div>-->
        <!--</a>-->
      </div>
    </div>



    <!--	底部内容-开始	  -->
    <a href="/service" id="service">
      <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">
    </a>
    <!--	底部内容-结束	  -->
    <!-- body 末尾处引入 layui -->
    <script src="/public/site/layui/layui.js"></script>


  </body>

</html>
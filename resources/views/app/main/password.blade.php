

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Update Trade Password</title>
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    .layui-panel-window {
      background: #ffffff !important;
      border-top: none
    }

    .login_btn {
      background: linear-gradient(102deg, #27C85D 0%, #24A196 100%);
      box-shadow: 0px 4px 10px 0px rgba(36, 165, 144, 0.3);
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #FFFFFF;
      margin-top: 10px;
    }

    .layui-form-item {
      border-radius: 8px;
      border: 1px solid #CFD0D9;
      margin-bottom: 20px;
      height: 50px;
      background: #FFFFFf;

    }

    .layui-form-label {
      width: 80px;
      padding-top: 14px;
      border: none;
      background: none;
      border-right: 1px solid #CFD0D9;
      height: 30px;
      font-weight: 400;
      font-size: 18px;
      color: #2A415C;

    }

    .layui-input-block {
      margin-left: 80px;
      height: 50px;
      line-height: 50px;
    }

    .layui-input-wrap {
      border-radius: 8px;
    }

    .layui-input-wrap .layui-input,
    .layui-input-affix {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #2A415C !important;
    }

    .layui-input-wrap .layui-input,
    .layui-input-affix {
      height: 50px !important;
      line-height: 50px !important;
    }

    .label {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #888888;
      line-height: 18px;
      margin-bottom: 5px;
    }

    .common_card .common_card_content {
      background: #ffffff;
      border-radius: 16px 16px 16px 16px;
      padding: 0px;
    }

    .common_explain {
      border-left: 4px solid #FC9137;
      padding-left: 10px;
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #268649;
      line-height: 21px;
    }

    .common_content {
      margin-top: 15px;
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #6F6F6F;
      line-height: 22px;
    }

    .common_content p {
      margin-bottom: 15px;
    }
  </style>
</head>

<body class="common_body">
  <div id="content_html">
    <div class="common_header common_header_order" style="height: 150px">
      <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        Update Password
      </a>
    </div>
    <div class="position" style="margin: 15px;top: -80px">
      <div class="common_card">
        <div class="common_card_content">
          <form class="layui-form"  action="{{route('user.change.password')}}" method="post">
              @csrf
            <div class="demo-login-container">
              <div class="label">Old Password</div>
              <div class="layui-form-item">
                <div class="layui-input-wrap">
                  <input type="password" name="current_password" value="" lay-verify="required" placeholder="Please enter password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
                </div>
              </div>
              <div class="label">New Password</div>
              <div class="layui-form-item">
                <div class="layui-input-wrap">
                  <input type="password" name="new_password" value="" lay-verify="required" placeholder="Please enter new password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
                </div>
              </div>
              
              <div class="label">Confirm Password</div>
              <div class="layui-form-item">
                <div class="layui-input-wrap">
                  <input type="password" name="confirm_password" value="" lay-verify="required" placeholder="Please enter confirm password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
                </div>
              </div>

              <div class="layui-form-item" style="border: none;background: none">
                <button type="submit" class="layui-btn layui-btn-danger layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit lay-filter="password"> Update Password</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <a href="/service" id="service">
    <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">
  </a>

  <script src="/public/site/layui/layui.js"></script>
  <script src="/public/site/js/trade_password.js"></script>
 @include('alert-message')
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
        function do_login_password() {
            var old_password = $("input[name='current_password']").val();
            var new_password = $("input[name='new_password']").val();
            var confirm_password = $("input[name='confirm_password']").val();

            if (!old_password)
                return message("পুরানো পাসওয়ার্ড লিখুন");

            if (!new_password)
                return message("নতুন পাসওয়ার্ড লিখুন");

            if (!confirm_password)
                return message("পাসওয়ার্ড নিশ্চিত করুন");

            if (confirm_password != new_password)
                return message("পাসওয়ার্ডটি অসামঞ্জস্যপূর্ণ");

            document.querySelector('form').submit();
        }
    </script>

</body>

</html>

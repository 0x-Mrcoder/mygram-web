<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Setting Info</title>
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    .layui-panel-window {
      background: #FFFFFF !important;
      border-top: none
    }

    .layui-form-item {
      background: none;
      border-radius: 8px;
      border: 1px solid #CFD0D9;
      height: 50px;
      line-height: 50px;
    }

    .layui-input {
      background: none;
      color: #333333;
      font-weight: 400;
      border: none;
      height: 50px;
      line-height: 50px;
    }

    .login_btn {
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #FFFFFF;
      height: 44px;
      line-height: 44px;
    }
  </style>
</head>

<body class="common_body">
  <div class="common_header common_header_order" style=" ">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
      Setting Info
    </a>
  </div>
  <div style="position:relative;top: -80px;margin: 15px">
    <div style="background: #FFFFFF;border-radius: 16px;">
      <div class="layui-panel-window layui-font-16" style="border-radius: 8px;">
        <form class="layui-form" lay-filter="saveBankCardInfoForm">
          <input name="avatar" id="avatar" type="hidden" value="/public/uploads/user/avatar.png">
          <div class="demo-login-container">
            <div class="user-header" style="margin-top: 10px;display: flex;justify-content: flex-start">
              <div>
                <img src="/public/uploads/user/avatar.png" style="width: 60px;height: 60px" class="layui-circle" id="upload_avatar">
              </div>
              <div style="padding-left: 10px;color: #818393">
                <h1 class="layui-font-16" style="color: #0751A0;margin-bottom: 10px;">Click to change picture</h1>
                <p>It is recommended to upload 1:1 images larger than 100px</p>
              </div>
              <div style="clear: both"></div>
            </div>

            <div style="margin-top: 20px;margin-bottom: 7px;color: #818393;font-size: 18px;">NickName</div>
            <div class="layui-form-item" style="">
              <input type="text" name="nickname" value="rakib" lay-verify="required" placeholder="nickname" lay-reqtext="nickname" autocomplete="off" class="layui-input">
            </div>
            <div style="margin-top: 20px;margin-bottom: 7px;color: #818393;font-size: 18px;">E-mail</div>
            <div class="layui-form-item">
              <input type="text" name="email" value="" lay-verify="required" placeholder="email" lay-reqtext="email" autocomplete="off" class="layui-input">
            </div>

            <div class="layui-form-item" style="border: none">
              <button class="layui-btn  layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit lay-filter="saveInfo">
                Save Info </button>
            </div>

          </div>
        </form>
      </div>
    </div>


  </div>
  <!--	底部内容-开始	  -->
  <a href="/help" id="service">
    <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">
  </a>
  <!--	底部内容-结束	  -->
  <!-- body 末尾处引入 layui -->
  <script src="/public/site/layui/layui.js"></script>


  <script>
    layui.use(function () {
      var $ = layui.jquery;
      var layer = layui.layer;
      var form = layui.form;
      var upload = layui.upload;
      var element = layui.element;
      //常规使用 - 普通图片上传
      var uploadInst = upload.render({
        elem: '#upload_avatar',
        url: '/uploadPicture' // 实际使用时改成您自己的上传接口即可。
          ,
        acceptMime: 'image/*',
        accept: 'jpg|png|gif|jpeg',
        data: {
          'directory': 'avatar'
        },
        done: function (res) {
          layer.msg(res.msg);
          //如果上传失败
          if (res.status = 1) {
            $('#avatar').val(res.result.path);
            $('#upload_avatar').attr('src', res.result.show_path);
          }

        },
        error: function () {

        }
      });
      // 提交事件
      form.on('submit(saveInfo)', function (data) {
        var data = data.field; // 获取表单字段值
        $.post('/info', data, function (res) {
          layer.msg(res.msg);
          if (res.status == 1) {
            window.location.href = '/my'
          }
        })
        return false; // 阻止默认 form 跳转
      });

    });
  </script>
</body>

</html>
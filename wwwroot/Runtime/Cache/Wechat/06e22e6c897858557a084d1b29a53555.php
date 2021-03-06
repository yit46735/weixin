<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->

  <!-- Bootstrap -->
  <link href="/Public/Wechat/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Public/Wechat/css/style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .main{margin-bottom: 60px;}
    .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
  </style>


  <title>微信物业管理系统</title>

</head>
<body>
<div class="main">
  <!-- 头部 -->
  <div class="container-fluid">
    <div id="top-alert" class="fixed alert alert-error bg-danger" style="display: none;margin-top: 10%;">
      <button class="close fixed" style="margin-top: 4px;">&times;</button>
      <div class="alert-content">这是内容</div>
    </div>
  </div>


  <!--导航部分-->
  <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid text-center">
      <div class="col-xs-3">
        <p class="navbar-text"><a href="/Index/index.html" class="navbar-link">首</a></p>
      </div><div class="col-xs-3">
      <p class="navbar-text"><a href="/Service/listIndex.html" class="navbar-link">服务</a></p>
    </div><div class="col-xs-3">
      <p class="navbar-text"><a href="/Find/all.html" class="navbar-link">发现</a></p>
    </div><div class="col-xs-3">
      <p class="navbar-text"><a href="/Center/index.html" class="navbar-link">我的</a></p>
    </div>	</div>
  </nav>
  <!--导航结束-->

  <!-- /头部 -->

  <!-- 主体 -->


  <div class="container">

    <form class="form-signin login-form" action="/wechat.php?s=/Wechat/User/register.html" method="post">
      <h2 class="form-signin-heading">注册</h2>
      <p class="control-group">

        <div class="controls">
          <input type="text" id="inputEmail" class="form-control" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
        </div>
      </p>
      <p class="control-group">

        <div class="controls">
          <input type="password" id="inputPassword"  class="form-control" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
        </div>
      </p>
      <p class="control-group">

        <div class="controls">
          <input type="password" id="inputPassword" class="form-control" placeholder="请再次输入密码" recheck="password" errormsg="您两次输入的密码不一致" nullmsg="请填确认密码" datatype="*" name="repassword">
        </div>
      </p>
      <p class="control-group">

        <div class="controls">
          <input type="text" id="inputEmail" class="form-control" placeholder="请输入电子邮件"  ajaxurl="/member/checkUserEmailUnique.html" errormsg="请填写正确格式的邮箱" nullmsg="请填写邮箱" datatype="e" value="" name="email">
        </div>
      </p>
      <p class="control-group">

        <div class="controls">
          <input type="text" id="inputPassword" class="form-control" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
        </div>
      </p>
      <p class="control-group">
        <label class="control-label"></label>
        <div class="controls">
          <img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('verify');?>" style="cursor:pointer;">
        </div>
        <div class="controls Validform_checktip text-warning"></div>
      </p>
      <p class="control-group">
        <div class="controls">
          <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
        </div>
      </p>
    </form>
  </div>
  <!-- /container -->


  <!-- /主体 -->

  <!-- 底部 -->

  <!-- 底部
  ================================================== -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="/Public/Wechat/jquery-1.11.2.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="/Public/Wechat/bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    (function(){
      var ThinkPHP = window.Think = {
        "ROOT"   : "", //当前网站地址
        "APP"    : "", //当前项目地址
        "PUBLIC" : "/Public", //项目公共目录地址
        "DEEP"   : "/", //PATHINFO分割符
        "MODEL"  : ["2", "", "html"],
        "VAR"    : ["m", "c", "a"]
      }
    })();
  </script>

  <script type="text/javascript">
    $(document)
            .ajaxStart(function () {
              $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function () {
              $("button:submit").removeClass("log-in").attr("disabled", false);
            });


    $("form").submit(function () {
      var self = $(this);
      $.post(self.attr("action"), self.serialize(), success, "json");
      return false;

      function success(data) {
        if (data.status) {
          window.location.href = data.url;
        } else {
          self.find(".Validform_checktip").text(data.info);
          //刷新验证码
          $(".reloadverify").click();
        }
      }
    });

    $(function () {
      var verifyimg = $(".verifyimg").attr("src");
      $(".reloadverify").click(function () {
        if (verifyimg.indexOf('?') > 0) {
          $(".verifyimg").attr("src", verifyimg + '&random=' + Math.random());
        } else {
          $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
        }
      });
    });
  </script>
  <!-- 用于加载js代码 -->
  <!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
  <div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->

  </div>

  <!-- /底部 -->
</div>
</body>
</html>
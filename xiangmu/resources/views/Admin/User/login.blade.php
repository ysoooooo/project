<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link href="/homes/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/homes/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/homes/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/homes/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<link href="/uploads/6.ico" rel="icon">
<title>后台登录 SuperUsedMarket</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header" style="background:url('/web/houtai.jpg')"></div>
<div class="loginWraper">
<div id="loginform" class="loginBox">
  <!--  提示 -->
<!--后台操作提示信息 开始  -->
    @if(session('success'))
        <div class="alert  alert-info" align="center">
                {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" align="center">
                {{session('error')}}
        </div>
    @endif
<!--后台操作提示信息 结束 -->
    <form class="form form-horizontal" action="/Admin/User/login" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input required="required" name="username" type="text" placeholder="用户名" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input required="required" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
       <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input type="text" name="captcha" class="form-control" style="width: 100px;height:30px"  required='required'>
         <img src="/code" onclick="this.src=this.src+'?a=1'" alt="验证码" title="刷新图片" width="100" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">

        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
           {{ csrf_field() }}
        </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
         
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 超级二手市场 by H-ui.admin v3.0</div>
<script type="text/javascript" src="/homes/lib/jquery/1.9.1/jquery.min.js"></script> 
<!-- <script type="text/javascript" src="/homes/static/h-ui/js/H-ui.min.js"></script> -->
<script src='{{asset("/admins/bower_components/jquery/dist/jquery.min.js")}}'></script>

<!-- Bootstrap Core JavaScript -->
<script src='{{asset("/admins/bower_components/bootstrap/dist/js/bootstrap.min.js")}}'></script>

<!-- Metis Menu Plugin JavaScript -->
<script src='{{asset("/admins/bower_components/metisMenu/dist/metisMenu.min.js")}}'></script>
<!-- Morris Charts JavaScript -->

<!-- Custom Theme JavaScript -->
<script src='{{asset("/admins/dist/js/sb-admin-2.js")}}'></script>
    <!-- 提示信息定时关闭 开始 -->
        <script>
            $(function(){
               setTimeout(function(){
                 $('.alert-info').hide();
                 $('.alert-danger').hide();
               },2000)
            })
        </script>
    <!-- 提示信息定时关闭 结束 -->

</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:/phpStudy/WWW/hands/template/admin\account/login.html";i:1529567136;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>堡庆科技商户平台登录</title>
    <link rel="stylesheet" type="text/css" href="/static/index/css/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/page.css" />
    <script type="text/javascript" src="/static/layui-2.2.5/css/layui.css"></script>
    <script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/index/js/public.js"></script>
    <script type="text/javascript" src="/static/layui-2.2.5/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/login.js"></script>
</head>
<body>

<!-- 登录页面头部 -->
<div class="logHead">
    <img src="/static/index/img/logo.png" />
</div>
<!-- 登录页面头部结束 -->

<!-- 登录body -->
<div class="logDiv">
    <img class="logBanner" src="/static/index/img/login.jpg" style="height: 700px;"/>
    <div class="logGet">
        <!-- 头部提示信息 -->
        <div class="logD logDtip">
            <p class="p1">堡庆科技商户系统</p>
        </div>
        <!-- 输入框 -->
        <div class="lgD">
            <img class="img1" src="/static/index/img/logName.png" />
            <input type="text" placeholder="输入商户帐号" name="account" id="account"/>
        </div>
        <div class="lgD">
            <img class="img1" src="/static/index/img/logPwd.png" />
            <input type="password" placeholder="输入用户密码"  name="password" id="password"/>
        </div>
        <div class="logC">
            <button id="login_btn">登 录</button>
        </div>
    </div>
</div>
<!-- 登录body  end -->

<!-- 登录页面底部 -->
<div class="logFoot">
    <p class="p1">版权所有：广州堡庆科技有限公司</p>
    <p class="p2">广州堡庆科技有限公司 登记序号：粤ICP备17156563号-1</p>
</div>
<!-- 登录页面底部end -->

</body>
</html>
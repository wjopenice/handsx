<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"E:/phpStudy/WWW/hands/template/mobile\index/login.html";i:1529647743;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529636536;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1529636385;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/css/common/login.css">

    <div class="login-bg pr">
        <div class="login-content">
            <!-- logo -->
            <div class="logo-icon">
                <img src="/static/mobile/image/login/logo.png" alt="">
            </div>
            <!--  表单   -->
            <form action="" class="formBox">
                <div class="formBoxWrap account pr" id="account">
                    <i></i>
                    <input type="text" placeholder="Username" maxlength="20">
                </div>
                <div class="formBoxWrap pwd pr" id="pwd">
                    <i></i>
                    <input type="password" placeholder="Password" maxlength="20"></div>
                <a href="javascript:;" class="btnLogin" id="btnLogin">Login</a>
            </form>
        </div>
    </div>
<script src="/static/mobile/js/common/zepto.min.js"></script>
<script src="/static/mobile/js/common/sm.js"></script>
<script src="/static/mobile/js/common/public.js"></script>
</body>
</html>
<script src="/static/mobile/js/login/index.js"></script>



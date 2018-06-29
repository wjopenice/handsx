<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"E:/phpStudy/WWW/hands/template/mobile\login/login.html";i:1529660554;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">
    <link rel="stylesheet" href="/static/mobile/css/common/login.css">
</head>
<body class="mHome">
    <div class="login-bg pr">
        <div class="login-content">
            <!-- logo -->
            <div class="logo-icon">
                <img src="/static/mobile/image/login/logo.png" alt="">
            </div>
            <!--  表单   -->
            <form action="/mobile" method="post" class="formBox">
                <div class="formBoxWrap account pr" id="account">
                    <i></i>
                    <input type="text" name="account" placeholder="Username" required pattern="\w{5,12}" maxlength="20">
                </div>
                <div class="formBoxWrap pwd pr" id="pwd">
                    <i></i>
                    <input type="password" placeholder="Password" name="password"  required pattern="\w{6,12}"></div>
                <input type="submit" class="btnLogin" id="btnLogin" name="btnLogin" value="Login" style="border: 0; width: 100%;">
            </form>
        </div>
    </div>
    <script src="/static/mobile/js/common/zepto.min.js"></script>
    <script src="/static/mobile/js/common/sm.js"></script>
    <script src="/static/mobile/js/common/public.js"></script>
    <script src="/static/mobile/js/login/index.js"></script>
</body>
</html>



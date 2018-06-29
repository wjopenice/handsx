<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"E:\phpStudy\WWW\hands\thinkphp\tpl\dispatch_jump.tpl";i:1529894322;}*/ ?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>跳转提示</title>
</head>
<body>
<div class="modal-pop" style="top:0;left:0;">
    <div class="pop" style="position:fixed;top:0;left:0;z-index:9999;width:100%;height:100%;background: #000;opacity: 0.4;"></div>
    <div class="innerPop" style="position:absolute;top:0;left:0;bottom:0;right:0;margin:auto;width: 70%;height:20rem;background:#FFF;z-index: 9999;border-radius: 2rem;clear: both;">
        <p style="float: left;width:100%;text-align: center;height: 3rem;line-height: 5rem;font-size: 3rem;"><?php echo(strip_tags($msg));?>!</p>
        <a id="linkName" href="<?php echo($url);?>" style="display: block;float:left;width:100%;height:3rem;text-align: center;line-height:3rem;font-size: 2.5rem;">点击立即跳转</a>
        <p id="time"style="float:right;width:100%;height:7rem;margin:0;padding:0;line-height:7rem;text-align: center;font-size: 2.8rem;color: #0000cc;"><?php echo($wait);?></p>
    </div>
</div>
<script type="text/javascript">
    (function () {
        var wait = document.getElementById('time'),
            href = document.getElementById('linkName').href;
        var interval = setInterval(function () {
            var time = --wait.innerHTML;
            if (time > 0) {
                location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();
</script>
</body>
</html>

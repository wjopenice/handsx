<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"E:/phpStudy/WWW/hands/template/mobile\buss/rechargedetail.html";i:1529976245;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1529655377;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1529658881;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商户管理-充值详情</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/css/buss/rechargeDetail.css">
    <div class="page-group">
        <div class="page">
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel" id="slideBtn"></a>
                <h1 class="title"><img class="logo" src="/static/mobile/image/common/logo.png" alt=""></h1>
            </header>
            <div class="content">
                <!-- 面包屑 -->
                <div class="crumbs"><a href="javascript:void(0);">商户管理&nbsp;>&nbsp;</a><a href="javascript:void(0);">商户详情&nbsp;>&nbsp;</a><a href="javascript:void(0);" onClick="javascript :history.back(-1);" external>充值详情 ✕</a></div>
                <!-- 今日充值 -->
                <div class="orderTodayWrap cf">
                    <p class="indexTit fl">今日充值额</p>
                    <div class="indexCon fl cf">
                        <div class="subBlock fl"><p class="blockName">PC</p><p class="blockNum ofh"><?php echo !empty($data['recharge']['pc'])?$data['recharge']['pc']: '0.00'; ?></p></div>
                        <div class="subBlock fl"><p class="blockName">H5支付宝</p><p class="blockNum ofh"><?php echo !empty($data['recharge']['h5alipay'])?$data['recharge']['h5alipay']: '0.00'; ?></p></div>
                        <div class="subBlock fl"><p class="blockName">H5微信</p><p class="blockNum ofh"><?php echo !empty($data['recharge']['h5wecatpay'])?$data['recharge']['h5wecatpay']: '0.00'; ?></p></div>
                    </div>
                </div>
                <!-- PC充值 -->
                <div class="crumbs set-bar"><a href="javascript:void(0);">PC充值</a></div>
                <div class="recharge-box">
                    <div class="recharge-top cf"><p class="fl ofh">充值额</p><p class="fl ofh">结算额</p><p class="fl ofh">未结算额</p><p class="fl ofh">提现额</p><p class="fl ofh">未提现额</p></div>
                    <div class="recharge-bottom cf"><p class="fl ofh"><?php echo !empty($data['recharge']['pc'])?$data['recharge']['pc']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['already']['pc'])?$data['sett']['already']['pc']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['not']['pc'])?$data['sett']['not']['pc']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['already']['pc'])?$data['with']['already']['pc']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['not']['pc'])?$data['with']['not']['pc']: '0.00'; ?></p></div>
                </div>
                <!-- H5支付宝充值 -->
                <div class="crumbs set-bar"><a href="javascript:void(0);">H5支付宝充值</a></div>
                <div class="recharge-box">
                    <div class="recharge-top cf"><p class="fl ofh">充值额</p><p class="fl ofh">结算额</p><p class="fl ofh">未结算额</p><p class="fl ofh">提现额</p><p class="fl ofh">未提现额</p></div>
                    <div class="recharge-bottom cf"><p class="fl ofh"><?php echo !empty($data['recharge']['h5alipay'])?$data['recharge']['h5alipay']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['already']['h5_alipay'])?$data['sett']['already']['h5_alipay']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['not']['h5_alipay'])?$data['sett']['not']['h5_alipay']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['already']['h5_alipay'])?$data['with']['already']['h5_alipay']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['not']['h5_alipay'])?$data['with']['not']['h5_alipay']: '0.00'; ?></p></div>
                </div>
                <!-- H5微信充值 -->
                <div class="crumbs set-bar"><a href="javascript:void(0);">H5微信充值</a></div>
                <div class="recharge-box">
                    <div class="recharge-top cf"><p class="fl ofh">充值额</p><p class="fl ofh">结算额</p><p class="fl ofh">未结算额</p><p class="fl ofh">提现额</p><p class="fl ofh">未提现额</p></div>
                    <div class="recharge-bottom cf"><p class="fl ofh"><?php echo !empty($data['recharge']['h5wecatpay'])?$data['recharge']['h5wecatpay']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['already']['h5_wetch'])?$data['sett']['already']['h5_wetch']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['sett']['not']['h5_wetch'])?$data['sett']['not']['h5_wetch']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['already']['h5_wetch'])?$data['with']['already']['h5_wetch']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['with']['not']['h5_wetch'])?$data['with']['not']['h5_wetch']: '0.00'; ?></p></div>
                </div>
                <!-- 总充值 -->
                <div class="crumbs set-bar"><a href="javascript:void(0);">总充值</a></div>
                <div class="recharge-box">
                    <div class="recharge-top cf"><p class="fl ofh">充值额</p><p class="fl ofh">结算额</p><p class="fl ofh">未结算额</p><p class="fl ofh">提现额</p><p class="fl ofh">未提现额</p></div>
                    <div class="recharge-bottom cf"><p class="fl ofh"><?php echo !empty($data['paytotal'])?$data['paytotal']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['all_rech_money'])?$data['all_rech_money']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['not_rech_money'])?$data['not_rech_money']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['all_with_money'])?$data['all_with_money']: '0.00'; ?></p><p class="fl ofh"><?php echo !empty($data['not_with_money']['not_money'])?$data['not_with_money']['not_money']: '0.00'; ?></p></div>
                </div>
                <a class="return-btn" href="javascript:void(0);" onClick="javascript :history.back(-1);">返回</a>
            </div>
        </div>
    </div>
<div class="panel panel-left panel-reveal">
    <div class="content-block">
        <div class="headBoxWrap">
            <img src="/static/mobile/Image/common/headImg.png" class="headImg" alt="">
            <p class="headName ofh"><?php echo $account['account']; ?></p>
            <p class="headLine"></p>
        </div>
        <div class="slideBarWrap cf">
            <div class="subSlideBox">
                <a class="subSlide slide1 cf slideHoverBg" href="/mobile/index" external><i class="slideIcon fl"></i><span>首&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide2 cf fl" href="/mobile/buss" external><i class="slideIcon fl"></i><span>商户管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide3 cf" href="/mobile/gear" external><i class="slideIcon fl"></i><span>档位管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide4 cf" href="/mobile/Interfaces" external><i class="slideIcon fl"></i><span>接口管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide5 cf" href="/mobile/recharges" external><i class="slideIcon fl"></i><span>充值管理</span></a>
                <div class="innerSlideBoxWrap fl">
                    <a class="subInnerSlide" href="#" external><span class="innerSlideName">充值列表</span></a>
                    <a class="subInnerSlide" href="#" external><span class="innerSlideName">充值列表</span></a>
                    <a class="subInnerSlide" href="#" external><span class="innerSlideName">充值列表</span></a>
                </div>
            </div>
        </div>
        <a class="fr exitBtn" href="/mobile/logout">退出</a></div>
</div>
<script src="/static/mobile/js/common/zepto.min.js"></script>
<script src="/static/mobile/js/common/sm.js"></script>
<script src="/static/mobile/js/common/public.js"></script>
</body>
</html>
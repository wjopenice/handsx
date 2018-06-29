<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"E:/phpStudy/WWW/hands/template/mobile\index/index.html";i:1529655396;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1530062767;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530164178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>首页</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/css/index/index.css">

<div class="page-group">
    <div class="page">
        <header class="bar bar-nav">
            <a class="icon icon-me pull-left open-panel" id="slideBtn"></a>
            <h1 class="title"><img class="logo" src="/static/mobile/image/common/logo.png" alt=""></h1>
        </header>
        <div class="content">
            <div class="navConWrap cf">
                <div class="subNav fl topBar1"><i class="navIcon"></i><p class="navNum ofh"><?php echo !empty($data['all_data'])?$data['all_data']: '0.00'; ?></p><p class="navName">平台总充值额</p></div>
                <div class="subNav fl topBar2"><i class="navIcon"></i><p class="navNum ofh"><?php echo !empty($data['all_with'])?$data['all_with']: '0.00'; ?></p><p class="navName">平台总提现额</p></div>
                <div class="subNav fl topBar3"><i class="navIcon"></i><p class="navNum ofh"><?php echo !empty($data['all_sett'])?$data['all_sett']: '0.00'; ?></p><p class="navName">平台结算额</p></div>
                <div class="subNav fl topBar4"><i class="navIcon"></i><p class="navNum ofh"><?php echo $data['all_pro_counts']; ?></p><p class="navName">商户数</p></div>
            </div>
            <div class="orderTodayWrap cf">
                <p class="indexTit fl">今日订单</p>
                <div class="indexCon fl cf">
                    <div class="subBlock fl"><p class="blockName">交易笔数</p><p class="blockNum ofh"><?php echo !empty($data['today_orders'])?$data['today_orders']: 0; ?></p></div>
                    <div class="subBlock fl"><p class="blockName">成功笔数</p><p class="blockNum ofh"><?php echo !empty($data['today_success_orders'])?$data['today_success_orders']: 0; ?></p></div>
                    <div class="subBlock fl"><p class="blockName">成交金额</p><p class="blockNum ofh col-red">￥<span><?php echo !empty($data['today_success_money'])?$data['today_success_money']: '0.00'; ?></span></p></div>
                </div>
            </div>
            <div class="cashTodayWrap cf">
                <p class="indexTit fl">今日提现</p>
                <div class="indexCon fl cf">
                    <div class="subBlock fl"><p class="blockName">交易笔数</p><p class="blockNum ofh"><?php echo !empty($data['today_with_strip'])?$data['today_with_strip']: 0; ?></p></div>
                    <div class="subBlock fl"><p class="blockName">成功笔数</p><p class="blockNum ofh"><?php echo !empty($data['today_with_strip'])?$data['today_with_strip']: 0; ?></p></div>
                    <div class="subBlock fl"><p class="blockName">成交金额</p><p class="blockNum ofh col-red">￥<span><?php echo !empty($data['today_with_money'])?$data['today_with_money']: '0.00'; ?></span></p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-left panel-reveal">
    <div class="content-block">
        <div class="headBoxWrap">
            <img src="/static/mobile/image/common/headImg.png" class="headImg" alt="">
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
                <a class="subSlide slide5 cf" external><i class="slideIcon fl"></i><span>充值管理</span><i class="upNext"></i></a>
                <div class="innerSlideBoxWrap fl hide">
                    <?php for($i=1;$i<=$totalPage;$i++):?>
                    <a class="subInnerSlide" href="/mobile/recharges?page=<?php echo $i; ?>&limit=<?php echo $showList; ?>" external><span class="innerSlideName">充值列表数据第<?php echo $i; ?>页</span></a>
                    <?php endfor;?>
                </div>
            </div>
        </div>
        <div class="subSlideBox subSlideExit cf"><a class="subSlide slide6 cf" href="/mobile/logout" external><i class="slideIcon fl"></i><span>退出登录</span></a></div></div>
</div>
<script src="/static/mobile/js/common/zepto.min.js"></script>
<script src="/static/mobile/js/common/sm.js"></script>
<script src="/static/mobile/js/common/public.js"></script>
</body>
</html>



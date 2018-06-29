<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"E:/phpStudy/WWW/hands/template/mobile\recharges/search.html";i:1530079374;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1530062767;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530065742;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>充值查询</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/js/common/dist/mescroll.min.css">
<link rel="stylesheet" href="/static/mobile/css/common/list.css">
    <div class="page-group">
        <div class="page">
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel" id="slideBtn"></a>
                <h1 class="title"><img class="logo" src="/static/mobile/image/common/logo.png" alt=""></h1>
            </header>
            <div class="contentBox mescroll" id="mescroll">
                <!-- 搜索框 -->
                <form action="/mobile/recharges/search" method="post">
                    <div class="search-bar cf search-box">
                        <div class="bar bar-header-secondary fl search-bar-box bar-header-box">
                            <div class="searchbar">
                                <a class="searchbar-cancel">取消</a>
                                <div class="search-input">
                                    <label class="icon icon-search" for="search"></label>
                                    <input type="search" id='search' name="search" placeholder='输入完整的商户号查询...'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- 列表 -->
                <div class="list-block">
                    <div class="list-container data-list" id="dataList">
                        <?php foreach($deposit as $key=>$value): ?>
                        <ul>
                            <li>
                                <a href="/mobile/recharges/detail?id=<?php echo $value['id']; ?>" external>
                                    <div class="item-content item-link">
                                        <div class="item-media"><i class="icon icon-f7"></i></div>
                                        <div class="item-inner item-border item-order">
                                            <div class="item-title item-num"><?php echo $value['promote_account']; ?></div>
                                            <div class="item-after item-order-num"><?php echo $value['pay_order_number']; ?></div>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="item-media"><i class="icon icon-f7"></i></div>
                                        <div class="item-inner">
                                            <div class="item-title item-time"><?php echo $value['create_time']; ?></div>
                                            <?php $class = ($value['pay_status'] == '支付成功') ? "item-green":"item-red"?>
                                            <div class="item-after item-files <?php echo $class; ?>"><?php echo $value['pay_status']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <?php endforeach; ?>
                    </div>
                    <div class="mescroll-upwarp mescroll-hardware" style="visibility: visible;"><p class="upwarp-nodata">-- 只返回最新20条数据，查看更多请访问PC端 --</p></div>
                </div>
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



<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"E:/phpStudy/WWW/hands/template/mobile\interfaces/detail.html";i:1530005603;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1529655377;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530000345;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>接口详情</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/css/common/detail.css">
    <div class="page-group">
        <div class="page">
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel" id="slideBtn"></a>
                <h1 class="title"><img class="logo" src="/static/mobile/image/common/logo.png" alt=""></h1>
            </header>
            <div class="content">
                <!-- 面包屑 -->
                <div class="crumbs"><a href="javascript:void(0);">接口列表&nbsp;>&nbsp;</a><a href="javascript:void(0);" onClick="javascript :history.back(-1);" external>接口详情 ✕</a></div>
                <form action="/mobile/interfaces/detail?id=<?php echo $data['id']; ?>" method="post">
                    <div class="list-block">
                        <!-- 商户列表 -->
                        <ul>
                            <li class="item-content item-link">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">接口名称</div>
                                    <div class="item-after"><input class="item-order" type="text" name="pay_title" value="<?php echo $data['pay_title']; ?>"></div>
                                </div>
                            </li>
                            <li class="item-content item-link">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">接口商户号</div>
                                    <div class="item-after"><input class="item-order" type="text" name="pay_number" value="<?php echo $data['pay_number']; ?>"></div>
                                </div>
                            </li>
                            <li class="item-content item-link">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">接口APPID</div>
                                    <div class="item-after"><input class="item-order" type="text" name="pay_appid" value="<?php echo $data['pay_appid']; ?>"></div>
                                </div>
                            </li>
                            <li class="item-content item-link">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">接口CUSID</div>
                                    <div class="item-after"><input class="item-order" type="text" name="pay_cusid" value="<?php echo $data['pay_cusid']; ?>"></div>
                                </div>
                            </li>
                            <li class="item-content item-link">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">接口APPKEY</div>
                                    <div class="item-after"><input class="item-order" type="text" name="pay_appkey" value="<?php echo $data['pay_appkey']; ?>"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 接入方 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">接入方</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">接入方</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择接入方" id="picker" name="pay_type" value="<?php echo $data['pay_type']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 支付宝 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">支付宝</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">支付宝</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择支付宝状态" id="picker1" name="alipay_status" value="<?php echo $data['alipay_status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 支付宝H5 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">支付宝H5</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">支付宝H5</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择支付宝H5状态" id="picker2" name="h5_alipay_status" value="<?php echo $data['h5_alipay_status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 微信 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">微信</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">微信</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择微信状态" id="picker3" name="wetch_status" value="<?php echo $data['wetch_status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 微信H5 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">微信H5</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">微信H5</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择微信H5状态" id="picker4" name="h5_wetch_status" value="<?php echo $data['h5_wetch_status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 状态设置 -->
                    <div class="crumbs set-bar"><a href="javascript:void(0);">状态设置</a></div>
                    <div class="list-block">
                        <ul>
                            <!-- Text inputs -->
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">状态设置</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="请选择状态设置" id="picker5" name="status" value="<?php echo $data['status']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- 保存返回按钮 -->
                    <input type="submit" class="sure-btn" value="保存" style="border: 0;">
                </form>
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
                <a class="subSlide slide5 cf" external><i class="slideIcon fl"></i><span>充值管理</span><i class="upNext"></i></a>
                <div class="innerSlideBoxWrap fl hide">
                    <a class="subInnerSlide" href="/mobile/recharges" external><span class="innerSlideName">充值列表</span></a>
                    <a class="subInnerSlide" href="/mobile/recharges" external><span class="innerSlideName">充值列表</span></a>
                    <a class="subInnerSlide" href="/mobile/recharges" external><span class="innerSlideName">充值列表</span></a>
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
<script src="/static/mobile/js/interface/detail.js"></script>

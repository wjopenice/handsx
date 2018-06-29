<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"E:/phpStudy/WWW/hands/template/mobile\buss/add.html";i:1529983745;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1530062767;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530065742;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加商户</title>
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
            <div class="crumbs"><a href="javascript:void(0);">商户管理&nbsp;>&nbsp;</a><a href="javascript:void(0);" onClick="javascript :history.back(-1);" external> 添加 ✕</a></div>
            <form action="/mobile/buss/add" method="post">
            <div class="list-block">
                <!-- 商户列表 -->
                <ul>
                    <li class="item-content">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">商户号</div>
                            <div class="item-after"><input type="text" class="item-order"  name="account" value="<?php echo $account_key; ?>"></div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">商品名称</div>
                            <div class="item-after"><input type="text" class="item-order" name="nickname" value="" placeholder="请填写商户名称"></div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">手机号</div>
                            <div class="item-after"><input type="text" class="item-order" name="mobile_phone" maxlength="11" value=""  placeholder="请输入手机号"></div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">Emial</div>
                            <div class="item-after"><input type="text" class="item-order" name="email" value=""  class="item-order" placeholder="请输入邮箱"></div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">登陆密码</div>
                            <div class="item-after"><input type="text" class="item-order" name="hands_pass" value="" placeholder="请输入登陆密码"></div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">结算方式</div>
                            <div class="item-after"><input type="text" class="item-order" name="comm_type" value="T1" placeholder="请输入结算方式"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- 档位设置 -->
            <div class="crumbs set-bar"><a href="javascript:void(0);">商户等级</a></div>
            <div class="list-block">
                <ul>
                    <!-- Text inputs -->
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">商户等级</div>
                                <div class="item-input">
                                    <input type="text" name="level_id" class="item-order" placeholder="请选择商户等级" id="picker" readonly="">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- 推荐商户号 -->
            <div class="crumbs set-bar"><a href="javascript:void(0);">推荐商户号</a></div>
            <div class="list-block">
                <ul>
                    <!-- Text inputs -->
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">推荐商户号</div>
                                <div class="item-input">
                                    <input type="text" class="item-order" placeholder="请选择推荐商户号" id="picker1" name="referee_id" value="" readonly="">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- 添加返回按钮 -->
            <input class="sure-btn" type="submit" value="添加" style="border: 0;" />
            <a class="return-btn" href="javascript:void(0);" onClick="javascript :history.back(-1);">返回</a>
            </form>
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
<script>
    $(function(){
        $("#picker").picker({
            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择商户等级</h1></header>',
            cols: [
                {
                    textAlign: 'center',
                    values: eval("["+"<?=$level?>"+"]")
                }
            ]
        });
        $("#picker1").picker({
            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择推荐商户号</h1></header>',
            cols: [
                {
                    textAlign: 'center',
                    values: eval("["+"<?=$account_data?>"+"]")
                }
            ]
        });
    });
</script>

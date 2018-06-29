<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"E:/phpStudy/WWW/hands/template/mobile\buss/detail.html";i:1530080343;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1530062767;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530164178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>商户详情</title>
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
            <form action="/mobile/buss/edit" method="post">
                <input type="hidden" name="id" value="<?php echo $data['promote']['id']; ?>">
                <div class="content">
                <!-- 面包屑 -->
                <div class="crumbs" style="margin-top: 3rem;"><a href="javascript:void(0);">商户管理&nbsp;>&nbsp;</a><a href="/mobile/buss" external>商户详情 ✕</a></div>

                <div class="list-block">
                    <!-- 商户列表 -->
                    <ul>
                        <li class="item-content">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">商户号</div>
                                <div class="item-after"><input type="text" name="account" value="<?php echo $data['promote']['account']; ?>"></div>
                            </div>
                        </li>
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">商品名称</div>
                                <div class="item-after"><input type="text" name="nickname" value="<?php echo $data['promote']['nickname']; ?>"></div>
                            </div>
                        </li>
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">手机号</div>
                                <div class="item-after"><input type="text" name="mobile_phone" value="<?php echo $data['promote']['mobile_phone']; ?>"></div>
                            </div>
                        </li>
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">Email</div>
                                <div class="item-after"><input type="text" class="item-order" name="email" value="<?php echo $data['promote']['email']; ?>"></div>
                            </div>
                        </li>
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">充值金额</div>
                                <div class="item-after"><a href="/mobile/buss/rechargedetail&id=<?php echo $data['promote']['id']; ?>" external>详情</a></div>
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
                                        <input type="text" placeholder="请选择状态设置" id="picker" readonly="" name="status" value="<?php if($data['promote']['status']=1){echo "正常";}else{echo "禁用";} ?>">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- 档位设置 -->
                <div class="crumbs set-bar"><a href="javascript:void(0);">档位设置</a></div>
                <div class="list-block">
                    <ul>
                        <!-- Text inputs -->
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">档位设置</div>
                                    <div class="item-input" id="inputpicker1">
                                        <input type="text" placeholder="请选择档位设置" id="picker1" name="level_id" readonly value="<?php echo $data['promote']['level']; ?>">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- 保存返回按钮 -->
                <input class="sure-btn" type="submit" name="btn" value="保存" style="border: 0;">
                <a class="return-btn" href="/mobile/buss" external>返回</a>
            </div>
            </form>
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
<script>
    $(function(){
        $("#picker").picker({
            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择状态设置</h1></header>',
            cols: [
                {
                    textAlign: 'center',
                    values: ['正常', '禁用']
                }
            ]
        });
        $("#picker1").picker({
            toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择档位设置</h1></header>',
            cols: [
                {
                    textAlign: 'center',
                    values: eval("["+"<?=$data['level']?>"+"]")
                }
            ]
        });

    });
</script>
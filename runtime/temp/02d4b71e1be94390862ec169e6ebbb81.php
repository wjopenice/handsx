<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"E:/phpStudy/WWW/hands/template/admin\index/index.html";i:1529567136;s:55:"E:/phpStudy/WWW/hands/template/admin\common/header.html";i:1529635016;s:53:"E:/phpStudy/WWW/hands/template/admin\common/memu.html";i:1529567136;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>堡庆科技商户系统</title>
    <link rel="stylesheet" type="text/css" href="/static/index/css/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui-2.2.5/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/css.css" />

    <script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/index/js/public.js"></script>
    <script type="text/javascript" src="/static/layui-2.2.5/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/admin.js"></script>
    <script type="text/javascript" src="/static/js/admin/login.js"></script>

</head>

<body>
<!-- 头部 -->
<div class="head">
    <div class="headL">
        <img class="headLogo" src="/static/index/img/headLogo.png" />
    </div>
    <div class="headR">
        <p class="p1">
            欢迎，
            <?php echo $account['account']; ?>
        </p>
        <p class="p2">
            <a href="/adminupass.html" class="resetPWD">重置密码</a>&nbsp;&nbsp;<a
                href="javascript:void(0);" class="goOut">退出</a>
        </p>
    </div>
    <!-- onclick="{if(confirm(&quot;确定退出吗&quot;)){return true;}return false;}" -->
</div>

<div class="closeOut">
    <div class="coDiv">
        <p class="p1">
            <span>X</span>
        </p>
        <p class="p2">确定退出当前用户？</p>
        <P class="p3">
            <a class="ok yes" href="#">确定</a><a class="ok no" href="#">取消</a>
        </p>
    </div>
</div>



</body>
</html>

<body id="bg">
<!-- 左边节点 -->
<div class="container">

    <div class="leftsidebar_box">
        <a href="/admin.html" style="display: block;"><div class="line">
            <img src="/static/index/img/coin01.png" />&nbsp;&nbsp;首页
        </div></a>
        <!-- <dl class="system_log">
        <dt><img class="icon1" src="/static/index/img/coin01.png" /><img class="icon2"src="/static/index/img/coin02.png" />
            首页<img class="icon3" src="/static/index/img/coin19.png" /><img class="icon4" src="/static/index/img/coin20.png" /></dt>
    </dl> -->
        <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$val): ?>
        <dl class="system_log">
            <dt>
                <img class="icon1" src="/static/index/img/<?php echo $val['faicon']; ?>" />
                <img class="icon2" src="/static/index/img/<?php echo $val['faicon2']; ?>" /> <?php echo $val['title']; ?>
                <img class="icon3" src="/static/index/img/coin19.png" />
                <img class="icon4" src="/static/index/img/coin20.png" />
            </dt>
            <?php if($val['children'] != null): if(is_array($val['children']) || $val['children'] instanceof \think\Collection || $val['children'] instanceof \think\Paginator): if( count($val['children'])==0 ) : echo "" ;else: foreach($val['children'] as $key=>$v): ?>
            <dd>
                <img class="coin11" src="/static/index/img/coin111.png" />
                <img class="coin22" src="/static/index/img/coin222.png" />
                <a class="cks" href="<?php echo $v['url']; ?>"><?php echo $v['title']; ?></a>
                <img class="icon5" src="/static/index/img/coin21.png" />
            </dd>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </dl>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

</div>
</body>
</html>


<link rel="stylesheet" href="../../../static/admin/css/common.css">
<link rel="stylesheet" href="../../../static/admin/css/index.css">
<script type="text/javascript" src="/static/js/admin/defoult.js"></script>

<body style="background: #F1F2F7;">
<div id="pageAll" style="width: 90%;">
    <div class="page">
        <!-- main页面样式 -->
        <div class="rowBox flex">
            <div class="subRow flexbox">
                <h1 class="rowNum"><?php echo !empty($data['all_data'])?$data['all_data']: '0.00'; ?></h1>
                <p class="rowCon">平台总充值额</p>
            </div>
            <div class="subRow flexbox">
                <h1 class="rowNum"><?php echo !empty($data['all_with'])?$data['all_with']: '0.00'; ?></h1>
                <p class="rowCon">平台总提现额</p>
            </div>
            <div class="subRow flexbox">
                <h1 class="rowNum"><?php echo !empty($data['all_sett'])?$data['all_sett']: '0.00'; ?></h1>
                <p class="rowCon">平台结算额</p>
            </div>
            <div class="subRow flexbox">
                <h1 class="rowNum"><?php echo $data['all_pro_counts']; ?></h1>
                <p class="rowCon">商户数</p>
            </div>

        </div>
        <div class="mainCenterBox cf">
            <div class="leftBox fl cf">
                <div class="websiteBox fl">
                    <div class="mainTit">平台基本信息</div>
                    <div class="mainCon cf">
                        <div class="subWebSiteInfo fl"><strong>当前充值订单总数：</strong><span><?php echo !empty($data['all_orders'])?$data['all_orders']: 0; ?></span><span> 单</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前充值订单总数（成功）：</strong><span><?php echo !empty($data['all_success_orders'])?$data['all_success_orders']: 0; ?></span><span> 单</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前充值订单总数（失败）：</strong><span><?php echo !empty($data['all_fail_orders'])?$data['all_fail_orders']: 0; ?></span><span> 单</span></div>

                        <div class="subWebSiteInfo fl"><strong>当前充值订单总额：</strong><span><?php echo !empty($data['all_orders_money'])?$data['all_orders_money']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前充值订单总额（成功）：</strong><span><?php echo !empty($data['all_success_money'])?$data['all_success_money']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前充值订单总额（失败）：</strong><span><?php echo !empty($data['all_fail_money'])?$data['all_fail_money']: '0.00'; ?></span><span> 元</span></div>

                        <div class="subWebSiteInfo fl"><strong>今日充值订单总数：</strong><span><?php echo !empty($data['today_orders'])?$data['today_orders']: 0; ?></span><span> 单</span></div>
                        <div class="subWebSiteInfo fl"><strong>今日充值订单总数（成功）：</strong><span><?php echo !empty($data['today_success_orders'])?$data['today_success_orders']: 0; ?></span><span> 单</span></div>
                        <div class="subWebSiteInfo fl"><strong>今日充值订单总数（失败）：</strong><span><?php echo !empty($data['today_fail_orders'])?$data['today_fail_orders']: 0; ?></span><span> 单</span></div>

                        <div class="subWebSiteInfo fl"><strong>今日充值订单总额：</strong><span><?php echo !empty($data['today_orders_money'])?$data['today_orders_money']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>今日充值订单总额（成功）：</strong><span><?php echo !empty($data['today_success_money'])?$data['today_success_money']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>今日充值订单总额（失败）：</strong><span><?php echo !empty($data['today_fail_money'])?$data['today_fail_money']: '0.00'; ?></span><span> 元</span></div>

                        <div class="subWebSiteInfo fl"><strong>当前提现记录数：</strong><span><?php echo !empty($data['with_strip'])?$data['with_strip']: 0; ?></span><span> 条</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前已提现总额：</strong><span><?php echo !empty($data['with_money'])?$data['with_money']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>当前可提现总额：</strong><span><?php echo !empty($data['with_not'])?$data['with_not']: '0.00'; ?></span><span> 元</span></div>

                        <div class="subWebSiteInfo fl"><strong>今日提现记录数：</strong><span><?php echo !empty($data['today_with_strip'])?$data['today_with_strip']: 0; ?></span><span> 条</span></div>
                        <div class="subWebSiteInfo fl"><strong>今日提现总额：</strong><span><?php echo !empty($data['today_with_money'])?$data['today_with_money']: '0.00'; ?></span><span> 元</span></div>

                        <div class="subWebSiteInfo fl"><strong>已结算总额：</strong><span><?php echo !empty($data['all_sett'])?$data['all_sett']: '0.00'; ?></span><span> 元</span></div>
                        <div class="subWebSiteInfo fl"><strong>未结算总额：</strong><span><?php echo !empty($data['not_sett'])?$data['not_sett']: '0.00'; ?></span><span> 元</span></div>
                    </div>
                </div>
                <div class="newestInfoBox fl">
                    <div class="mainTit">最新通告</div>
                    <div class="mainCon cf" id="newestInfoContent">
                        <ul>
                            <?php if($notice != null): if(is_array($notice) || $notice instanceof \think\Collection || $notice instanceof \think\Paginator): if( count($notice)==0 ) : echo "" ;else: foreach($notice as $key=>$val): ?>
                            <li class="subNewestInfo" data-id="<?php echo $val['id']; ?>"><?php echo $val['title']; ?></li>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="rightBox fl cf">
                <?php if($account['grade'] == 1): ?>
                <div class="quickOperation fl">
                    <div class="mainTit">快捷操作</div>
                    <div class="mainCon">
                        <div class="operationLine cf">
                            <?php if(is_array($quick) || $quick instanceof \think\Collection || $quick instanceof \think\Paginator): if( count($quick)==0 ) : echo "" ;else: foreach($quick as $key=>$val): ?>
                            <a class="operateLink fl cf" href="<?php echo $val['url']; ?>"><p class="fl"><?php echo $val['title']; ?></p></a>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="loginRecord fl">
                    <div class="mainTit">管理员登录记录</div>
                    <div class="mainCon">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <?php if($logs != null): if(is_array($logs) || $logs instanceof \think\Collection || $logs instanceof \think\Paginator): if( count($logs)==0 ) : echo "" ;else: foreach($logs as $key=>$val): ?>
                            <tr>
                                <td><?php echo $val['account']; ?></td>
                                <td><?php echo $val['time']; ?></td>
                                <td><?php echo $val['login_ip']; ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
                <!--<div class="heightHartsBox fl"></div>-->
            </div>
        </div>
        <!-- main页面样式end -->
    </div>
</div>
<script src="../../../static/admin/js/jquery.js"></script>
</body>

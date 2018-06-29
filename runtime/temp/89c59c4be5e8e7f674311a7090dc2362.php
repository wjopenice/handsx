<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"E:/phpStudy/WWW/hands/template/admin\administration/with.html";i:1529567136;s:55:"E:/phpStudy/WWW/hands/template/admin\common/header.html";i:1529635016;s:53:"E:/phpStudy/WWW/hands/template/admin\common/memu.html";i:1529567136;}*/ ?>
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


<script type="text/javascript" src="/static/js/admin/with.js"></script>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div >
            <img src="/static/index/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                href="#">提现管理</a>&nbsp;-</span>&nbsp;提现记录
        </div>
    </div>

    <div id="content" style="width: 100%;">
        <blockquote class="layui-elem-quote" style="height: 50px;">
            <span class="layui-badge layui-bg-green">当前已提现总金额：<?php echo $all_with; ?></span>
            <span class="layui-badge layui-bg-cyan">今日提现金额：<?php echo $with; ?></span>
            <span class="layui-badge layui-bg-blue">佣金总额：<?php echo $commission; ?></span>
            <span class="layui-badge layui-bg-orange">提现中金额：<?php echo $is_with; ?></span>
            <form class="layui-form" style="float:right;width:100%">
                <!--<div class="layui-input-inline" style="margin:0;">-->
                <!--<div class="layui-input-inline">-->
                <!--<input type="text" name="exchange" placeholder="请输入商户号" autocomplete="off" class="layui-input">-->
                <!--</div>-->
                <!--</div>-->
                <div class="layui-input-inline">
                    <input class="layui-input" name="start_time" placeholder="开始日" id="start_time">
                </div>
                <div class="layui-input-inline">
                    <input class="layui-input" name="first_time" placeholder="截止日" id="first_time">
                </div>
                <div class="layui-input-inline" style="margin:0;">
                    <div class="layui-input-inline">
                        <input type="text" name="account" placeholder="请输入商户号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-input-inline" style="margin:0;">
                    <div class="layui-input-inline">
                        <input type="text" name="nickname" placeholder="请输入商户名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-input-inline" style="margin:0;">
                    <div class="layui-input-inline">
                        <div class="layui-input-block" style="margin-left:0">
                            <select name="status" lay-filter="aihao">
                                <option value="" selected>请选择提现状态</option>
                                <option value="0">待审核</option>
                                <option value="1">审核不通过</option>
                                <option value="2">审核通过</option>
                                <option value="3">打款中</option>
                                <option value="4">提现完成</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-input-inline" style="margin:0;">
                    <div class="layui-form-mid layui-word-aux" style="padding:0 !important;float:right;">
                        <button lay-filter="search" class="layui-btn" lay-submit><i class="fa fa-search" aria-hidden="true"></i> 查询</button>
                        <button lay-filter="export" class="layui-btn" lay-submit><i class="fa fa-search" aria-hidden="true"></i> 导出</button>
                    </div>
                </div>
            </form>
        </blockquote>

        <table id="with" lay-filter="with"></table>
        <!-- balance 表格 显示 end-->

        <script type="text/html" id="withDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit">审核</a>
        </script>
    </div>
    <!-- balance页面样式end -->
</div>

</body>
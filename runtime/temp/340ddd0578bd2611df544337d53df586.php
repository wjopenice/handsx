<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"E:/phpStudy/WWW/hands/template/admin\stall/add.html";i:1529567136;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/static/index/css/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui-2.2.5/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/css.css" />

    <script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/index/js/public.js"></script>
    <script type="text/javascript" src="/static/layui-2.2.5/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/admin.js"></script>
    <script type="text/javascript" src="/static/js/admin/stall.js"></script>
</head>
<body>

<div style="margin-top: 20px;">
    <div>
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">档位名称</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="level" value="" lay-verify="required" placeholder="档位名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提现费率（PC）</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="revenue"  value="" lay-verify="required" placeholder="提现费率（PC）" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提现费率（H5微信）</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="h5_wetch_revenue"  value="" lay-verify="required" placeholder="提现费率" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提现费率（H5支付宝）</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="h5_alipay_revenue"  value="" lay-verify="required" placeholder="提现费率" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">佣金提现费率</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="comm_revenue"  value="" placeholder="0.000" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">佣金提现周期</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="with_cycle"  value="" placeholder="0" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">档位标识</label>
                <div class="layui-input-inline" style="width: 30%">
                    <input type="text" name="ident"  value="" lay-verify="required" placeholder="档位标识" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="addStall">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
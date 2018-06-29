<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:/phpStudy/WWW/hands/template/admin\administration/edit.html";i:1529567136;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加商户</title>
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
    <script type="text/javascript" src="/static/js/index/index.js"></script>
    <script type="text/javascript" src="/static/js/index/promote.js"></script>
</head>
<body>

<div style="margin-top: 20px;">
    <div>
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">商户号</label>
                <div class="layui-input-inline">
                    <input type="text" name="account" value="<?php echo $pro_data['account']; ?>" disabled lay-verify="required" placeholder="商户号" autocomplete="off" class="layui-input">
                    <input type="hidden" name="id" value="<?php echo $pro_data['id']; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商户名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="nickname"  value="<?php echo $pro_data['nickname']; ?>" lay-verify="required" placeholder="商户名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号码</label>
                <div class="layui-input-inline">
                    <input type="text" name="mobile_phone"  value="<?php echo $pro_data['mobile_phone']; ?>" lay-verify="required" placeholder="手机号码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">Email</label>
                <div class="layui-input-inline">
                    <input type="text" name="email"  value="<?php echo $pro_data['email']; ?>" placeholder="Email" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">档位</label>
                <div class="layui-input-block" style="width: 40%;">
                    <select name="level_id" lay-filter="aihao">
                        <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$val): ?>
                        <option value="<?php echo $val['id']; ?>" <?php if($pro_data['level_id'] == $val['id']): ?> selected <?php endif; ?>><?php echo $val['level']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">结算方式</label>
                <div class="layui-input-inline">
                    <input type="text" name="comm_type"  value="<?php echo $pro_data['comm_type']; ?>" placeholder="结算方式" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="editPro">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
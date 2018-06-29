/**
 * Created by adminn on 2018/3/20.
 */


"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //密码重置
    form.on('submit(save_pass)',function(data){
        if(data.field.new_pass != data.field.auth_pass){
            layer.msg('两次密码输入不一致',{icon:2,time:2000});
            return false;
        }
        $.ajax({
            type:'post',
            url:'/adminupass.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        window.location.href = "/admin/login.html";
                    });
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            }
        })
        return false;

    })
});



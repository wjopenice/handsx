/**
 * Created by adminn on 2018/3/23.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //密码重置
    form.on('submit(setPass)',function(data){
        $.ajax({
            type:'post',
            url:'/index/withdraw/setpass.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
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

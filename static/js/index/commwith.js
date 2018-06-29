/**
 * Created by adminn on 2018/4/24.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //提现
    form.on('submit(commWith)',function(data){
        $.ajax({
            type:'post',
            url:'/index/recommend/commWith.html',
            data:data.field,
            dataType:'json',
            success:function(reslut){
                if(reslut.code == 1){
                    layer.msg(reslut.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                    });
                }
                if(reslut.code == 0){
                    layer.msg(reslut.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    })
});



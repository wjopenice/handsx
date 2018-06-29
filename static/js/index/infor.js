/**
 * Created by adminn on 2018/3/23.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //密码重置
    form.on('submit(generate)',function(data){
        $.ajax({
            type:'post',
            url:'/index/merchant/getkey.html',
            data:{},
            dataType:'json',
            success:function(result){
                document.getElementById('key').value = result.key;
                $("#generate").attr("style","display:none;");
            }
        })
        return false;

    })
});


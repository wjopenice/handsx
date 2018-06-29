/**
 * Created by adminn on 2018/4/27.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    $(".subNewestInfo").on('click',function(){
        var id = $(this).attr('data-id');
        layer.open({
            type: 2,
            area: ['900px', '550px'],
            fixed: false, //不固定
            maxmin: true,
            title:'公告详情',
            content: '/index/index/notData.html?id='+id,
        });
    })

});
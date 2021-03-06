/**
 * Created by adminn on 2018/5/24.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;


    table.render({
        elem:'#fiels'
        ,height: 'full'
        ,even:true
        ,url: '/admin/fiels/getFiels.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'name', title: '文件名', width:300,align:'center'}
            ,{field: 'url', title: '文件路径', width:300, sort: true,align:'center'}
            ,{field: 'ctime', title: '生成时间', width: 200, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#barFiels'}
        ]]
    })



    //监听工具条
    table.on('tool(fiels)', function(obj){
        var data = obj.data;
        var tr = obj.tr;
        if(obj.event === 'down'){
            //layer.msg('ID：'+ data.id + ' 的查看操作');
            //向服务端发送删除指令
            admin.ajax.post('/admin/fiels/selectFiels.html',{'id': data.id}, function(result){
                if(result.code == 1){
                    window.location.href = result.url;
                }
                if(result.code == 0){
                    layer.msg('文件不存在',{icon:0,time:3000});
                }
            });
            return false;
        }
    });

});

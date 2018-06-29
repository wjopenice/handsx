/**
 * Created by adminn on 2018/6/6.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;


    table.render({
        elem:'#black'
        ,height: 'full'
        ,even:true
        ,url: '/admin/black/getBlackIp.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'ip', title: 'IP地址', width:300,align:'center'}
            ,{field: 'status', title: '冻结状态', width:300,align:'center'}
            ,{field: 'create_time', title: '时间', width: 200, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#barBlack'}
        ]]
    })

    //IP过滤
    form.on('submit(filter)',function (data) {
        $.ajax({
            type:"post",
            url:'/admin/black/filter.html',
            data:{},
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                    })
                }
                if(result.code == 0){
                    layer.msg(result.msg);
                }
            }
        })
        return false;
    })

    //打开IP添加页
    form.on('submit(addFilter)', function (data) {
        layer.open({
            type: 2,
            area: ['400px', '200px'],
            fixed: false, //不固定
            maxmin: true,
            title:'添加黑名单',
            content: '/admin/black/add.html',
        });
    })

    //IP添加
    form.on('submit(addIp)',function (data) {
        $.ajax({
            type:"post",
            url:'/admin/black/add.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                    })
                }
                if(result.code == 0){
                    layer.msg(result.msg);
                }
            }
        })
        return false;
    })

    //监听工具条
    table.on('tool(black)', function(obj){
        var data = obj.data;
        var tr = obj.tr;
        if(obj.event === 'select'){
            layer.open({
                type: 2,
                area: ['800px', '550px'],
                fixed: false, //不固定
                maxmin: true,
                title:'IP充值详情',
                content: '/admin/black/select.html?id='+data.id,
            });
            return false;
        }else if(obj.event === 'del'){
            layer.confirm('确认删除', function(index){
                obj.del();
                layer.close(index);
                //向服务端发送删除指令
                admin.ajax.post('/admin/black/del.html',{'id': data.id}, function(result){
                    if(result.code == 1){
                        layer.msg(result.msg,{icon:1,time:2000},function(){
                            window.location.reload();
                        });
                    }
                    if(result.code == 0){
                        layer.msg(result.msg,{icon:2,time:2000});
                    }
                });
                return false;
            });
        }
    });

});


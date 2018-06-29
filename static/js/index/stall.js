/**
 * Created by adminn on 2018/3/21.
 */


"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    laydate.render({
        elem: '#first_time'
        ,type: 'datetime'
    });

    laydate.render({
        elem: '#start_time'
        ,type: 'datetime'
    });

    //查询
    form.on('submit(search)',function(data){
        console.log(data);
        table.reload('stall', {
            url: '/index/administration/getWith.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#stall'
        ,height: 'full'
        ,even:true
        ,url: '/index/stall/getStall.html' //数据接口
        ,page: true //开启分页
        ,limit:10
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'level', title: '档位', width:180,align:'center'}
            ,{field: 'revenue', title: '提现手续费（PC）', width:250, sort: true,align:'center'}
            ,{field: 'h5_revenue', title: '提现手续费（H5）', width:250, sort: true,align:'center'}
            ,{field: 'comm_revenue', title: '佣金提现费率', width:250, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#stallDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(stall)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);
                admin.ajax.post('/index/stall/delStall.html',{'id': data.id}, function(result){
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
        } else if(obj.event === 'edit'){
            layer.open({
                type: 2,
                area: ['550px', '400px'],
                fixed: false, //不固定
                maxmin: true,
                title:'档位设置',
                content: '/index/stall/editStall.html?id='+data.id,
            });
        }
    });

    //打开新增档位页
    form.on('submit(add)', function (data) {
        layer.open({
            type: 2,
            area: ['550px', '400px'],
            fixed: false, //不固定
            maxmin: true,
            title:'新增档位',
            content: '/index/stall/add.html',
        });
    })

    //设置档位
    form.on('submit(editStall)',function (data) {
        $.ajax({
            type:"post",
            url:'/index/stall/editStall.html',
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

    //添加档位
    form.on('submit(addStall)',function (data) {
        $.ajax({
            type:"post",
            url:'/index/stall/add.html',
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


});

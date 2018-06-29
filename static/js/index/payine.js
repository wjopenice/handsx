/**
 * Created by adminn on 2018/3/28.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    table.render({
        elem:'#payine'
        ,height: 'full'
        ,even:true
        ,url: '/index/pay/getIne.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'pay_title', title: '接口名称', width:180,align:'center'}
            ,{field: 'pay_number', title: '接口商户号', width:250, sort: true,align:'center'}
            ,{field: 'pay_appid', title: '接口APPID', width:180, sort: true,align:'center'}
            ,{field: 'pay_cusid', title: '接口CUSID', width:200, sort: true,align:'center'}
            ,{field: 'pay_appkey', title: '接口APPKEY', width:150,align:'center'}
            ,{field: 'wetch_status', title: '微信', width:150,align:'center',templet: '#wetchStatus'}
            ,{field: 'alipay_status', title: '支付宝', width:150,align:'center',templet: '#alipayStatus'}
            ,{field: 'status', title: '状态', width: 150,align:'center',templet: '#payIneTpl',}
            ,{title: '操作', width: 200, align:'center',toolbar: '#ineDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(payine)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('是否删除此商户接口', function(index){
                obj.del();//删除对应行（tr）的DOM结构
                layer.close(index);
                //向服务端发送删除指令
                admin.ajax.post('/index/pay/del.html',{'id': data.id}, function(result){
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
                area: ['600px', '500px'],
                fixed: false, //不固定
                maxmin: true,
                title:'商户编辑',
                content:'/index/pay/edit.html?id='+data.id,
            });
            return false;
        }
    });

    //添加弹框
    form.on('submit(add)',function (obj){
        layer.open({
            type: 2,
            area: ['450px', '450px'],
            fixed: false, //不固定
            maxmin: true,
            title:'新增商户接口',
            content: '/index/pay/add.html',
        });
        return false;
    })

    //添加数据
    form.on('submit(addIne)', function(obj){
        $.ajax({
            type:'post',
            url:'/index/pay/add.html',
            data:obj.field,
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
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    })

    //修改数据
    form.on('submit(editIne)', function(obj){
        $.ajax({
            type:'post',
            url:'/index/pay/edit.html',
            data:obj.field,
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
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    })

    //监听接口状态操作
    form.on('switch(status)', function(obj){
        var id = $(this).attr("data-id");
        var status = $(this).val();
        $.ajax({
            type:"get",
            url:'/index/pay/upStatus.html',
            data:{id:id},
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    document.getElementById('status').value=result.status;
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000},function () {
                        window.location.reload();
                    });
                }
            }
        })
        return false;
    });

    //监听接口状态操作
    form.on('switch(wetch_status)', function(obj){
        var id = $(this).attr("data-id");
        var status = $(this).val();
        $.ajax({
            type:"get",
            url:'/index/pay/upWetchStatus.html',
            data:{id:id},
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    document.getElementById('wetch_status').value=result.status;
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000},function () {
                        window.location.reload();
                    });
                }
            }
        })
        return false;
    });

    //监听接口状态操作
    form.on('switch(alipay_status)', function(obj){
        var id = $(this).attr("data-id");
        var status = $(this).val();
        $.ajax({
            type:"get",
            url:'/index/pay/upAlipayStatus.html',
            data:{id:id},
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    document.getElementById('alipay_status').value=result.status;
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000},function () {
                        window.location.reload();
                    });
                }
            }
        })
        return false;
    });

});


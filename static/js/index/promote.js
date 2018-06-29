/**
 * Created by adminn on 2018/3/19.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;


    //查询
    form.on('submit(search)',function(data){
        console.log(data);
        table.reload('promote', {
            url: '/index/administration/getPromote.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#promote'
        ,height: 'full'
        ,even:true
        ,url: '/index/administration/getPromote.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '商户号', width:180,align:'center'}
            ,{field: 'nickname', title: '商户名称', width:180,align:'center'}
            ,{field: 'mobile_phone', title: '手机号', width:150, sort: true,align:'center'}
            ,{field: 'referee_id', title: '推荐人', width:150, sort: true,align:'center'}
            ,{field: 'email', title: 'Email', width:200, sort: true,align:'center'}
            ,{field: 'money', title: '当前金额', width: 100,align:'center'}
            ,{field: 'total_money', title: '总金额', width: 100,align:'center'}
            ,{field: 'level_title', title: '档位', width: 80,align:'center'}
            ,{field: 'create_time', title: '创建时间', width: 200, sort: true,align:'center'}
            ,{field: 'status', title: '状态', width: 100,align:'center',templet: '#switchTpl',}
            ,{title: '操作', width: 150, align:'center',toolbar: '#pro'}
        ]]
    })

    //监听工具条
    table.on('tool(promote)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'details'){
            layer.open({
                type: 2,
                area: ['600px', '500px'],
                fixed: false, //不固定
                maxmin: true,
                title:'商户详情',
                content:'/index/administration/details.html?id='+data.id,
            });
            return false;
        } else if(obj.event === 'edit'){
            layer.open({
                type: 2,
                area: ['600px', '500px'],
                fixed: false, //不固定
                maxmin: true,
                title:'商户编辑',
                content:'/index/administration/edit.html?id='+data.id,
            });
            return false;
        }
    });


    //监听账号状态操作
    form.on('switch(status)', function(obj){
        var id = $(this).attr("data-id");
        var status = $(this).val();
        $.ajax({
            type:"get",
            url:'/index/administration/upStatus.html',
            data:{id:id},
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    document.getElementById('status').value=result.status;
                }
            }
        })
        return false;
    });

    //弹出添加商户框
    form.on('submit(addpro)',function(data){
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            fixed: false, //不固定
            maxmin: true,
            content:'/index/administration/addPro.html'
        });
        return false;
    })
   
    //添加商户数据提交
    form.on('submit(add_pro)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/index/administration/addPro.html',
            data:obj.field,
            dataType:'json',
            success:function(reslut){
                if(reslut.code == 1){
                    layer.msg(reslut.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                        window.location.reload();
                    });
                }
                if(reslut.error == 0){
                    layer.msg(reslut.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    })

    //编辑商户数据提交
    form.on('submit(editPro)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/index/administration/edit.html',
            data:obj.field,
            dataType:'json',
            success:function(reslut){
                if(reslut.code == 1){
                    layer.msg(reslut.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                        window.location.reload();
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


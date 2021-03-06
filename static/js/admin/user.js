/**
 * Created by adminn on 2018/4/23.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;


    table.render({
        elem:'#user'
        ,height: 'full'
        ,even:true
        ,url: '/admin/user/getUser.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '账号', width:180,align:'center'}
            ,{field: 'grade', title: '角色名称', width:150,align:'center'}
            ,{field: 'status', title: '状态', width:150,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#userDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(userDemo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                admin.ajax.post('/admin/user/del.html',{'id': data.id}, function(result){
                    if(result.code == 1){
                        obj.del();
                        layer.close(index);
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
                area: ['500px', '300px'],
                fixed: false, //不固定
                maxmin: true,
                title:'信息修改',
                content:'/admin/user/edit.html?id='+data.id
            });
            return false;
        }
    });

    //弹出添加框
    form.on('submit(addUser)',function(data){
        layer.open({
            type: 2,
            area: ['600px', '300px'],
            fixed: false, //不固定
            maxmin: true,
            title:'角色添加',
            content:'/admin/user/add.html'
        });
        return false;
    })

    //添加数据提交
    form.on('submit(add)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/admin/user/add.html',
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

    //添加数据提交
    form.on('submit(edit)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/admin/user/edit.html',
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

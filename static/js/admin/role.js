/**
 * Created by adminn on 2018/4/4.
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
        //console.log(data);
        table.reload('arech', {
            url: '/admin/role/getJuris.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#role'
        ,height: 'full'
        ,even:true
        ,url: '/admin/role/getRole.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'role_name', title: '角色名称', width:180,align:'center'}
            ,{field: 'status', title: '角色状态', width:150,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#roleDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(roleDemo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);

            });
        } else if(obj.event === 'edit'){
            layer.open({
                type: 2,
                area: ['500px', '300px'],
                fixed: false, //不固定
                maxmin: true,
                title:'角色修改',
                content:'/admin/role/edit.html?id='+data.id
            });
            return false;
        } else if(obj.event === 'distr'){
            layer.open({
                type: 2,
                area: ['800px', '600px'],
                fixed: false, //不固定
                maxmin: true,
                title:'权限分配',
                content:'/admin/role/roleDistr.html?id='+data.id
            });
            return false;
        }
    });

    //弹出添加框
    form.on('submit(addRole)',function(data){
        layer.open({
            type: 2,
            area: ['600px', '300px'],
            fixed: false, //不固定
            maxmin: true,
            title:'角色添加',
            content:'/admin/role/add.html'
        });
        return false;
    })

    //添加数据提交
    form.on('submit(add)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/admin/role/add.html',
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
            url:'/admin/role/edit.html',
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

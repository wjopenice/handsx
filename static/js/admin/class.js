/**
 * Created by adminn on 2018/4/2.
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
            url: '/admin/jurisdiction/getType.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#jurisClass'
        ,height: 'full'
        ,even:true
        ,url: '/admin/jurisdiction/getType.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'title', title: '权限名称', width:180,align:'center'}
            ,{field: 'faicon', title: '图标', width:180,align:'center'}
            ,{field: 'faicon2', title: '图标2', width:180,align:'center'}
            ,{field: 'hide', title: '是否隐藏', width:250, align:'center'}
            ,{field: 'status', title: '状态', width:150, align:'center'}
            ,{field: 'solf', title: '排序', width:150, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#classDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(classDemo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){

                //向服务端发送删除指令
                admin.ajax.post('/admin/jurisdiction/del.html',{'id': data.id}, function(result){
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
                area: ['700px', '500px'],
                fixed: false, //不固定
                maxmin: true,
                title:'权限分类修改',
                content:'/admin/jurisdiction/editClass.html?id='+data.id
            });
            return false;
        }
    });

    //弹出添加框
    form.on('submit(addClass)',function(data){
        layer.open({
            type: 2,
            area: ['800px', '600px'],
            fixed: false, //不固定
            maxmin: true,
            title:'分类添加',
            content:'/admin/jurisdiction/addclass.html'
        });
        return false;
    })

    //添加数据提交
    form.on('submit(add)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/admin/jurisdiction/addclass.html',
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

    //权限分类添加提交
    form.on('submit(editClass)', function(obj){
        //console.log(obj);
        $.ajax({
            type:'post',
            url:'/admin/jurisdiction/editClass.html',
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

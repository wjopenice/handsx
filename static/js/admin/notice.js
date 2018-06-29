/**
 * Created by adminn on 2018/4/25.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

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
        elem:'#notice'
        ,height: 'full'
        ,even:true
        ,url: '/admin/notice/getNotice.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'title', title: '标题', width:180,align:'center'}
            ,{field: 'content', title: '内容', width:150,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#noticeDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(noticeDemo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                //向服务端发送删除指令
                admin.ajax.post('/admin/notice/del.html',{'id': data.id}, function(result){
                    if(result.code == 1){
                        obj.del();
                        layer.close(index);
                        // layer.msg(result.msg,{icon:1,time:2000},function(){
                        //     window.location.reload();
                        // });
                    }
                    if(result.code == 0){
                        layer.msg(result.msg,{icon:2,time:2000});
                    }
                });
                return false;

            });
        } else if(obj.event === 'edit'){
            window.location.href='/admin/notice/edit.html?id='+data.id;
            return false;
        }
    });

    // //添加数据提交
    // form.on('submit(add)', function(obj){
    //     //console.log(obj);
    //     var title=$("#title").val();
    //     var content= layedit.getText(index);
    //
    //     $.ajax({
    //         type:'post',
    //         url:'/admin/notice/add.html',
    //         data:{title:title,content:content},
    //         dataType:'json',
    //         success:function(reslut){
    //             if(reslut.code == 1){
    //                 layer.msg(reslut.msg,{icon:1,time:2000},function(){
    //                     window.location.href='/notice.html';
    //                 });
    //             }
    //             if(reslut.code == 0){
    //                 layer.msg(reslut.msg,{icon:2,time:2000});
    //             }
    //         }
    //     })
    //     return false;
    // })

    // //数据提交
    // form.on('submit(edit)', function(obj){
    //     //console.log(obj);
    //     $.ajax({
    //         type:'post',
    //         url:'/admin/notice/edit.html',
    //         data:obj.field,
    //         dataType:'json',
    //         success:function(reslut){
    //             if(reslut.code == 1){
    //                 layer.msg(reslut.msg,{icon:1,time:2000},function(){
    //                     window.location.href='/notice.html';
    //                 });
    //             }
    //             if(reslut.code == 0){
    //                 layer.msg(reslut.msg,{icon:2,time:2000});
    //             }
    //         }
    //     })
    //     return false;
    // })

});


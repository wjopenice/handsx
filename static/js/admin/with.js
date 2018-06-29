/**
 * Created by adminn on 2018/3/20.
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
        table.reload('with', {
            url: '/admin/administration/getWith.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#with'
        ,height: 'full'
        ,even:true
        ,url: '/admin/administration/getWith.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '商户号', width:150,align:'center'}
            ,{field: 'nickname', title: '商户名称', width:150, sort: true,align:'center'}
            ,{field: 'money', title: '提现金额', width:150, sort: true,align:'center'}
            ,{field: 'rate', title: '提现费率', width:100, sort: true,align:'center'}
            ,{field: 'actual_money', title: '实际到账金额', width:150, sort: true,align:'center'}
            ,{field: 'bank_id', title: '提现银行', width:150,align:'center'}
            ,{field: 'status', title: '提现状态', width: 177,align:'center'}
            ,{field: 'auth_way', title: '来源', width: 80,align:'center'}
            ,{field: 'type', title: '提现模式', width: 80,align:'center'}
            ,{field: 'ctime', title: '发起时间', width: 180,align:'center'}
            ,{field: 'audit_time', title: '审核时间', width: 180, sort: true,align:'center'}
            ,{title: '操作', width: 100, align:'center',toolbar: '#withDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(with)', function(obj){
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
                area: ['900px', '550px'],
                fixed: false, //不固定
                maxmin: true,
                title:'提现审核',
                content: '/admin/examine/withAuth.html?id='+data.id,
            });
        }
    });

    //数据导出事件监听
    form.on('submit(export)', function (data) {
        layer.confirm('确认导出数据？', {
            btn  : ['提交', '取消'], //按钮
            shade: false //不显示遮罩
        }, function (index) {

            window.location.href = '/admin/examine/downData.html';
            //layer.load();
            layer.close(index);
            layer.load(1, {shade: [0.8, '#393D49'], time: 2000});
            return false;
        });
        return false;
    })

    //提现审核
    form.on('submit(withAuth)',function (data) {
        $.ajax({
            type:"post",
            url:'/admin/examine/withAuth.html',
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

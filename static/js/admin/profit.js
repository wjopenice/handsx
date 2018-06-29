/**
 * Created by adminn on 2018/4/24.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    // 时间控件
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
        table.reload('test', {
            url: '/admin/profit/getData.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#test'
        ,height: 'full'
        ,even:true
        ,url: '/admin/profit/getData.html' //数据接口
        ,page: true //开启分页
        ,limit: 15
        // ,width: 1370
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '商户号', width:150,align:'center'}
            ,{field: 'money', title: '佣金提现额', width:150, sort: true,align:'center'}
            ,{field: 'actual_money', title: '实际到帐金额', width:200, sort: true,align:'center'}
            ,{field: 'rate', title: '佣金费率', width:150,align:'center'}
            ,{field: 'bank_id', title: '提现银行', width: 150,align:'center'}
            ,{field: 'status', title: '提现状态', width: 150,align:'center'}
            ,{field: 'ctime', title: '申请时间', width: 200,align:'center'}
            ,{field: 'audit_time', title: '审核时间', width: 200,align:'center'}
            ,{title: '操作', width:80, fixed: 'right', align:'center', toolbar: '#profitDemo'}

        ]]
    })

    //监听工具条
    table.on('tool(profit)', function(obj){
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
                content: '/admin/examine/profitAuth.html?id='+data.id,
            });
        }
    });

    //提现审核
    form.on('submit(withAuth)',function (data) {
        $.ajax({
            type:"post",
            url:'/admin/examine/profitAuth.html',
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

    //数据导出事件监听
    form.on('submit(export)', function (data) {
        layer.confirm('确认导出数据？', {
            btn  : ['提交', '取消'], //按钮
            shade: false //不显示遮罩
        }, function (index) {

            window.location.href = '/admin/profit/downData.html';
            //layer.load();
            layer.close(index);
            layer.load(1, {shade: [0.8, '#393D49'], time: 2000});
            return false;
        });
        return false;
    })
});

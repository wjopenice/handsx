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
        table.reload('arech', {
            url: '/index/administration/getRech.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#arech'
        ,height: 'full'
        ,even:true
        ,url: '/index/administration/getRech.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'promote_account', title: '商户号', width:180,align:'center'}
            ,{field: 'order_number', title: '订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_order_number', title: '支付订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_amount', title: '充值金额', width:150, sort: true,align:'center'}
            ,{field: 'pay_status', title: '充值状态', width:150,align:'center'}
            ,{field: 'pay_way', title: '支付方式', width: 100,align:'center'}
            ,{field: 'pay_type', title: '第三方', width: 100,align:'center'}
            ,{field: 'status', title: '结算状态', width: 100, sort: true, align:'center'}
            ,{field: 'create_time', title: '支付时间', width: 200, sort: true,align:'center'}
            //,{title: '操作', width: 200, align:'center',toolbar: '#pro'}
        ]]
    })

    //监听工具条
    table.on('tool(promote)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            layer.alert('编辑行：<br>'+ JSON.stringify(data))
        }
    });

    //数据导出事件监听
    form.on('submit(export)', function (data) {
        layer.confirm('确认导出数据？', {
            btn  : ['提交', '取消'], //按钮
            shade: false //不显示遮罩
        }, function (index) {
            $.ajax({
                type:"get",
                url:'/index/administration/selectData.html',
                data:data.field,
                dataType:'json',
                success:function(result){
                    if(result.code == 1){
                        window.location.href = '/index/administration/downData.html';
                        //layer.load();
                        layer.close(index);
                        layer.load(1, {shade: [0.8, '#393D49'], time: 3000});
                    }
                    if(result.code == 0){
                        layer.msg(result.msg);
                    }
                }
            })
            return false;
        });
        return false;
    })



});
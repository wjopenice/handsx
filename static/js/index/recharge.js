/**
 * Created by adminn on 2018/3/15.
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

        table.reload('test', {
            url: '/index/recharge/getRecharge.html',
            where: data.field
        });
        $.ajax({
            type:"get",
            url:'/index/recharge/getCount.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    var ele=window.document .getElementById ("all_pay");
                    $(ele).show();
                    ele.innerHTML = '查询统计额：'+result.all_pay;
                }
                if(result.code == 0){
                    layer.msg(result.msg);
                }
            }
        })
        return false;
    });

    table.render({
        elem:'#test'
        ,height: 'full'
        ,even:true
        ,url: '/index/recharge/getRecharge.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'promote_account', title: '商户号', width:180,align:'center'}
            ,{field: 'order_number', title: '订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_order_number', title: '支付订单号', width:280, sort: true,align:'center'}
            ,{field: 'pay_amount', title: '充值金额', width:150, sort: true,align:'center'}
            ,{field: 'commission', title: '手续费', width:100,align:'center'}
            ,{field: 'comm_money', title: '结算金额', width:100,align:'center'}
            ,{field: 'pay_status', title: '充值状态', width:150,align:'center',templet: '#statusTpl'}
            ,{field: 'pay_way', title: '支付方式', width: 150,align:'center'}
            ,{field: 'status', title: '结算状态', width: 150,align:'center'}
            ,{field: 'create_time', title: '支付时间', width: 200, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#barDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(test)', function(obj){
        var data = obj.data;
        if(obj.event === 'inquiry'){
            //layer.msg('ID：'+ data.id + ' 的查看操作');
            //向服务端发送删除指令
            admin.ajax.post('/index/api/select.html',{'id': data.id,'type':1}, function(result){
                var resultData = result.data;

                //console.log(tr.html());
                //console.log(result);
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000});
                }
                if(result.code == 1){
                    layer.alert(result.msg);

                    obj.update({
                        order_number:resultData.order_number,
                        pay_status:resultData.pay_status
                    });

                }
                if(result.code == 2){
                    layer.alert(result.msg);
                }
            });
            return false;
        }
    });

    //数据导出事件监听
    form.on('submit(export)', function (data) {
        layer.confirm('确认导出数据？', {
            btn  : ['提交', '取消'], //按钮
            shade: false //不显示遮罩
        }, function (index) {

            window.location.href = '/index/recharge/downData.html?start_time='+data.field.start_time+'&first_time='+data.field.first_time+'&order_number='+data.field.order_number+'&pay_order_number='+data.field.pay_order_number+'&pay_way='+data.field.pay_way+'&pay_status='+data.field.pay_status;
            //layer.load();
            layer.close(index);
            layer.load(1, {shade: [0.8, '#393D49'], time: 3000});
        });
        return false;
    })
});

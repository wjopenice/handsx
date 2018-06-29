/**
 * Created by adminn on 2018/4/23.
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
            url: '/index/recommend/getDownstream.html',
            where: data.field
        });
        $.ajax({
            type:"get",
            url:'/index/recommend/getAll.html',
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
        ,url: '/index/recommend/getDownstream.html' //数据接口
        ,page: true //开启分页
        ,limit: 30
        // ,width: 1370
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'promote_account', title: '商户号', width:180,align:'center'}
            ,{field: 'order_number', title: '订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_order_number', title: '支付订单号', width:280, sort: true,align:'center'}
            ,{field: 'pay_amount', title: '充值金额', width:150, sort: true,align:'center'}
            ,{field: 'pay_status', title: '充值状态', width:150,align:'center'}
            ,{field: 'pay_way', title: '支付方式', width: 177,align:'center'}
            ,{field: 'comm_with_status', title: '是否已提现', width: 150,align:'center'}
            ,{field: 'create_time', title: '支付时间', width: 200, sort: true,align:'center'}
        ]]
    })

    //弹出佣金提现框
    form.on('submit(commWith)',function(data){
        $.ajax({
            type:'post',
            url:'/index/withdraw/isPass.html',
            data:{},
            dataType:'json',
            success:function(data){
                if(data.code == 1){
                    layer.open({
                        type: 2,
                        area: ['40%', '55%'],
                        skin: 'layui-layer-rim', //加上边框
                        fixed: false, //不固定
                        maxmin: true,
                        title:'佣金提现',
                        content: '/index/recommend/commWith.html'
                    });
                    return false;
                }
                if(data.code == 0){
                    layer.msg('还没有设置提现密码',{icon:2,time:2000},function(){
                        layer.open({
                            type: 2,
                            area: ['30%', '40%'],
                            skin: 'layui-layer-rim', //加上边框
                            fixed: false, //不固定
                            maxmin: true,
                            title:'提现密码设置',
                            content: 'index/withdraw/setpass.html'
                        });
                        return false;
                    });
                    return false;
                }
            }
        })
        return false;
    })
});


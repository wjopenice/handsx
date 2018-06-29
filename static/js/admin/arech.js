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
        //console.log(data);
        table.reload('arech', {
            url: '/admin/administration/getRech.html',
            where: data.field
        });
        $.ajax({
            type:"get",
            url:'/admin/administration/getCount.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    var ele=window.document .getElementById ("all_pay");
                    $(ele).show();
                    ele.innerHTML = '查询统计额：'+result.all_pay;
                }
                if(result.code == 2){
                    var ele=window.document .getElementById ("all_pay");
                    var ele1=window.document .getElementById ("time_pay");
                    $(ele).show();
                    $(ele1).show();
                    ele.innerHTML = '查询统计额：'+result.all_pay;
                    ele1.innerHTML = '截止昨日查询统计额：'+result.time_pay;
                }
                if(result.code == 0){
                    layer.msg(result.msg);
                }
            }
        })
        return false;
    });

    table.render({
        elem:'#arech'
        ,height: 'full'
        ,even:true
        ,url: '/admin/administration/getRech.html' //数据接口
        ,page: true //开启分页
        ,limit:30
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'promote_account', title: '商户号', width:150,align:'center'}
            ,{field: 'order_number', title: '订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_order_number', title: '支付订单号', width:250, sort: true,align:'center'}
            ,{field: 'pay_amount', title: '充值金额', width:130, sort: true,align:'center'}
            ,{field: 'pay_status', title: '充值状态', width:100,align:'center',templet: '#statusTpl'}
            ,{field: 'commission', title: '手续费', width:100,align:'center'}
            ,{field: 'comm_money', title: '结算金额', width:100,align:'center'}
            ,{field: 'pay_way', title: '支付方式', width: 100,align:'center'}
            ,{field: 'pay_type', title: '第三方', width: 90,align:'center'}
            ,{field: 'pay_source', title: '来源主体', width: 90,align:'center'}
            ,{field: 'status', title: '结算状态', width: 100, sort: true, align:'center'}
            ,{field: 'create_time', title: '支付时间', width: 200, sort: true,align:'center'}
            ,{title: '操作', width: 160, align:'center',toolbar: '#barDemo'}
        ]]
    })



    //监听工具条
    table.on('tool(arech)', function(obj){
        var data = obj.data;
        var tr = obj.tr;
        if(obj.event === 'inquiry'){
            //layer.msg('ID：'+ data.id + ' 的查看操作');
            //向服务端发送删除指令
            admin.ajax.post('/admin/api/select.html',{'id': data.id,'type':0}, function(result){

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
        layer.confirm('确认生成充值记录文件？', {
            btn  : ['确定', '取消'], //按钮
            shade: false //不显示遮罩
        }, function (index) {
            layer.load(1, {shade: [0.8, '#393D49'], time: 3000});
            admin.ajax.post('/admin/administration/downNewData.html',{}, function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:3000});
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:3000});
                }
                //layer.load();
                layer.close(index);

            })

        });
        return false;
    })
});
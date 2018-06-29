/**
 * Created by adminn on 2018/4/24.
 */
"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    // 时间控件
    laydate.render({
        elem: '#start'
    });
    // 时间控件
    laydate.render({
        elem: '#end'
    });

    //查询
    form.on('submit(search)',function(data){
        table.reload('test', {
            url: '/index/profit/getData.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#test'
        ,height: 'full'
        ,even:true
        ,url: '/index/profit/getData.html' //数据接口
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
            ,{title: '操作', width:80, fixed: 'right', align:'center', toolbar: '#barDemo'}

        ]]
    })

    //监听工具条
    table.on('tool(demo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            // layer.msg('ID：'+ data.id + ' 的查看操作');
            layer.open({
                type: 2,
                area: ['60%', '70%'],
                skin: 'layui-layer-rim', //加上边框
                fixed: false, //不固定
                maxmin: true,
                title:'提现详情',
                content: 'profitdetail&id='+data.id
            });
            return false;


        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);
            });
        } else if(obj.event === 'edit'){

        }
    });
});

/**
 * Created by adminn on 2018/3/15.
 */
/**
 * Created by Administrator on 2017/12/28.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //查询
    form.on('submit(search)',function(data){
        table.reload('test', {
            url: '/index/recommend/getlist.html',
            where: data.field
        });
        return false;
    });

    table.render({
        elem:'#test'
        ,height: 'full'
        ,even:true
        ,url: '/index/recommend/getList.html' //数据接口
        ,page: true //开启分页
        ,limit: 15
        // ,width: 1370
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '商户号', width:150,align:'center'}
            ,{field: 'nickname', title: '商户名', width:250, sort: true,align:'center'}
            ,{field: 'mobile_phone', title: '手机号', width:200, sort: true,align:'center'}
            ,{field: 'all_rec_data', title: '总充值金额', width: 150,align:'center'}
            ,{field: 'today_rec_data', title: '当日充值金额', width: 150,align:'center'}
            ,{field: 'create_time', title: '创建时间', width: 200,align:'center'}
        ]]
    })
});

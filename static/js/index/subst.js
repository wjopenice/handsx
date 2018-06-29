/**
 * Created by adminn on 2018/6/11.
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
            url: '/index/Substitute/subWithData.html',
            where: data.field
        });
        return false;
    });

    // 结算
    $(document).on('click','#accounts',function(){
        var url =  '/index/Substitute/allAccount.html';
        $.ajax({
            url : url,
            type : 'post',
            success : function (res){
                if(res.code !== 0){
                    layer.msg(res.msg, {time: 2000});
                }else if(res.code ===0){
                    layer.msg(res.msg, {type:1, time: 2000}, function(){
                        parent.location.reload();
                    });
                }
            }
        })
    })




    // 申请提现
    $(document).on('click','#applyFor',function(){

        $.ajax({
            type:'post',
            url:'/index/withdraw/isPass.html',
            data:{},
            dataType:'json',
            success:function(data){
                if(data.code == 1){
                    layer.open({
                        type: 2,
                        area: ['40%', '60%'],
                        skin: 'layui-layer-rim', //加上边框
                        fixed: false, //不固定
                        maxmin: true,
                        title:'申请提现',
                        content: 'index/Substitute/applyFor'
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

    // H5支付宝申请提现
    $(document).on('click','#applyAlipay',function(){

        $.ajax({
            type:'post',
            url:'/index/withdraw/isPass.html',
            data:{},
            dataType:'json',
            success:function(data){
                if(data.code == 1){
                    layer.open({
                        type: 2,
                        area: ['40%', '60%'],
                        skin: 'layui-layer-rim', //加上边框
                        fixed: false, //不固定
                        maxmin: true,
                        title:'申请提现',
                        content: 'index/Substitute/applyFor?type='+'alipay'
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

    // H5微信申请提现
    $(document).on('click','#applyWetch',function(){

        $.ajax({
            type:'post',
            url:'/index/withdraw/isPass.html',
            data:{},
            dataType:'json',
            success:function(data){
                if(data.code == 1){
                    layer.open({
                        type: 2,
                        area: ['40%', '60%'],
                        skin: 'layui-layer-rim', //加上边框
                        fixed: false, //不固定
                        maxmin: true,
                        title:'申请提现',
                        content: 'index/Substitute/applyFor?type='+'wetch'
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
    table.render({
        elem:'#test'
        ,height: 'full'
        ,even:true
        ,url: '/index/Substitute/subWithData.html' //数据接口
        ,page: true //开启分页
        ,limit: 15
        ,width: 1673
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'account', title: '商户号', width:150,align:'center'}
            ,{field: 'money', title: '提现金额', width:150, sort: true,align:'center'}
            ,{field: 'revenue', title: '提现手续费率', width:150, sort: true,align:'center'}
            ,{field: 'actual_money', title: '实际到账金额', width:150, sort: true,align:'center'}
            ,{field: 'ctime', title: '申请提现时间', width:200, sort: true,align:'center'}
            ,{field: 'status', title: '提现状态', width:150,align:'center'}
            ,{field: 'bank_title', title: '银行名称', width: 150,align:'center'}
            ,{field: 'bank_number', title: '银行卡号', width: 200,align:'center'}
            ,{field: 'auth_way', title: '类型', width: 200,align:'center'}
            ,{field: 'audit_time', title: '审核时间', width: 200, sort: true,align:'center'}
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
                content: 'withdrawdetail&id='+data.id
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

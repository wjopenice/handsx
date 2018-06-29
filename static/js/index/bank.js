/**
 * Created by adminn on 2018/3/15.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    //添加银行卡
    form.on('submit(add_bank)',function(data){
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['820px', '540px'], //宽高
            content:  $('#add_bank')
        });
        return false;
    })
    //查询
    form.on('submit(search)',function(data){

        table.reload('bank', {
            url: '/index/merchant/getBank.html',
            where: data.field
        });
        return false;
    });

    //数据渲染
    table.render({
        elem:'#bank'
        ,height: 'full'
        ,even:true
        ,url: '/index/merchant/getBank.html' //数据接口
        ,page: true //开启分页
        ,limit:10
        ,cols: [[ //表头
            {field: 'key', title: '序号', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'bank_name', title: '银行卡名称', width:180,align:'center'}
            ,{field: 'bank_number', title: '银行卡号', width:250, sort: true,align:'center'}
            ,{field: 'bank_user', title: '持卡人姓名', width:250, sort: true,align:'center'}
            ,{field: 'bank_city', title: '开户城市', width:150,align:'center'}
            ,{field: 'sub_branch', title: '开户支行', width: 177,align:'center'}
            ,{field: 'bank_phone', title: '银行预留手机', width: 150,align:'center'}
            ,{field: 'ctime', title: '添加时间', width: 200, sort: true,align:'center'}
            ,{title: '操作', width: 200, align:'center',toolbar: '#barDemo'}
        ]]
    })

    //监听工具条
    table.on('tool(bank)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            layer.msg('ID：'+ data.id + ' 的查看操作');
        } else if(obj.event === 'del'){
            layer.confirm('是否删除此银行卡', function(index){
                obj.del();//删除对应行（tr）的DOM结构
                layer.close(index);
                //向服务端发送删除指令
                admin.ajax.post('/index/merchant/delBank.html',{'id': data.id}, function(result){
                    if(result.code == 1){
                        layer.msg(result.msg,{icon:1,time:2000},function(){
                            window.location.reload();
                        });
                    }
                    if(result.code == 0){
                        layer.msg(result.msg,{icon:2,time:2000});
                    }
                });
                return false;
            });
        } else if(obj.event === 'edit'){
            //layer.alert('编辑行：<br>'+ JSON.stringify(data))
            layer.open({
                type: 2,
                area: ['900px', '550px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/index/merchant/editBank.html?id='+data.id,
            });
        }
    });

    //监听三级联动
    form.on('select(ld-select)', function (elem) {
        var id = elem.value;
        //console.log(id);
        admin.ajax.post('/index/merchant/getArea.html', {'id': id}, function (result) {
            if (result.code === 0) {
                layer.msg(result.msg, {icon: result.code, time: 2000}, function () {
                    var secondary = $('#city');
                    //清空原有的option
                    secondary.remove();
                    var option = '<option value="0">镇/区</option>';
                    secondary.html(option);
                    //console.log(secondary);
                    form.render('select');
                });
            }
            if (result.code === 1) {
                var secondary = $('#city');
                var secondary1 = $('#district');
                //清空原有的option
                secondary.html('');
                secondary1.html('');
                var option = '<option value="0">市/县</option>';
                var option1 = '<option value="0">镇/区</option>';secondary1.html(option1);
                $.each(result.data, function (k, v) {
                    option += '<option value="' + v.area_id + '">' + v.area_name + '</option>';
                });
                //console.log(option);
                secondary.html(option);
                form.render('select');
            }
        });
    });

    //监听指定开关
    form.on('select(city-select)', function (elem) {
        var id = elem.value;
        //console.log(id);
        admin.ajax.post('/index/merchant/getArea.html', {'id': id}, function (result) {
            if (result.code === 0) {
                layer.msg(result.msg, {icon: result.code, time: 2000}, function () {
                    var secondary = $('#district');
                    //清空原有的option
                    secondary.remove();
                    var option = '<option value="0">镇/区</option>';
                    secondary.html(option);
                    //console.log(secondary);
                    form.render('select');
                });
            }
            if (result.code === 1) {
                var secondary = $('#district');
                //清空原有的option
                secondary.html('');
                var option = '<option value="0">镇/区</option>';
                $.each(result.data, function (k, v) {
                    option += '<option value="' + v.area_id + '">' + v.area_name + '</option>';
                });
                //console.log(option);
                secondary.html(option);
                form.render('select');
            }
        });
    });

    //添加银行卡，提交事件监听
    form.on('submit(addDemo)',function(data){
        if(data.field.province  == '0' || data.field.province == '-1' || data.field.city == '0' || data.field.district == '0'){
            layer.msg('请选择正确的地区');
            return false;
        }
        var myreg =  /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(!myreg.test(data.field.bank_phone)){
            layer.msg('请输入有效的手机号码');
            return false;
        }
        $.ajax({
            type:'post',
            url:'addbank.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        window.location.reload();
                    });
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    })

    //银行卡信息修改
    form.on('submit(editBank)',function(data){
        if(data.field.province  == '0' || data.field.province == '-1' || data.field.city == '0' || data.field.district == '0'){
            layer.msg('请选择正确的地区');
            return false;
        }
        var myreg =  /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(!myreg.test(data.field.bank_phone)){
            layer.msg('请输入有效的手机号码');
            return false;
        }
        $.ajax({
            type:'post',
            url:'editbank.html',
            data:data.field,
            dataType:'json',
            success:function(result){
                if(result.code == 1){
                    layer.msg(result.msg,{icon:1,time:2000},function(){
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        parent.location.reload();
                    });
                }
                if(result.code == 0){
                    layer.msg(result.msg,{icon:2,time:2000});
                }
            }
        })
        return false;

    })
});


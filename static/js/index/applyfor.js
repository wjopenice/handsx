/**
 * Created by adminn on 2018/3/15.
 */
/**
 * Created by Administrator on 2017/12/28.
 */

"use strict";
layui.use(['layer', 'jquery', 'table', 'form', 'upload', 'laydate', 'element'], function () {
    var $ = layui.jquery, layer = layui.layer, table = layui.table, form = layui.form, laydate = layui.laydate, element = layui.element, upload = layui.upload;

    // 到账金额
    // $(document).on('blur','.money',function(){
    //     var money = $('.money').val() - $('.money').val()*($('.revenue').val());
    //     var html = '';
    //     html += '<div class="layui-form-item revenue_money">';
    //     html += '<label class="layui-form-label">到账金额：</label>';
    //     html += '<div class="layui-input-block">';
    //     html += '<input type="text" style="width:90%;border:0" name="actual_money" value="'+money+'" disabled class="layui-input">';
    //     html += '</div></div>';
    //     $('.money').parent().parent().after(html);
    // })

    $(document).on('keyup','.money',function(){
        var money = $(this).val();
        var diff = money - money * ($('.revenue').val());
        if(money){
            $(".revenue_money").show();
            $(".revenue_money").find("input").val(diff);
        }else{
            $(".revenue_money").hide();
        }
    });


    // 删除到账金额
    // $(document).on('focus','.money',function(){
    //     $('.revenue_money').remove();
    // })

    // select 样式
    $('.layui-form-select').css('width','90%')

    // 申请
    $(document).on('click','.sub-applyFor',function(){
        //console.log($('input[name="pay_pass"]').val());return;
        $("#sub-applyFor").hide();
        var url = $('#url').val();
        var data = $('#form').serialize();
        $.ajax({
            url : url,
            data : data,
            type : 'post',
            success : function (res){
                if(res.code !== 0){
                    $("#sub-applyFor").show();
                    layer.msg(res.msg, {time: 2000});
                }else if(res.code ===0){
                    layer.msg(res.msg, {type:1, time: 2000}, function(){
                        parent.location.reload();
                    });
                }
            }
        })
    })
});

/**
 * Created by ZB on 2018/6/19.
 */
$(function(){
    $("#picker").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择接入方</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values:  ['通联', '环迅','千玺','爱加密','点缀','兴业','聚森','快接']
            }
        ]
    });
    $("#picker1").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择支付宝状态</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['启用', '禁止']
            }
        ]
    });
    $("#picker2").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择支付宝H5状态</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['启用', '禁止']
            }
        ]
    });
    $("#picker3").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择微信状态</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['启用', '禁止']
            }
        ]
    });
    $("#picker4").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择微信H5状态</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['启用', '禁止']
            }
        ]
    });
    $("#picker5").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择状态设置</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['启用', '禁止']
            }
        ]
    });
});
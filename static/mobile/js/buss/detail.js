/**
 * Created by ZB on 2018/6/14.
 */
$(function(){
    $("#picker").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择状态设置</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['正常', '禁止']
            }
        ]
    });
    $("#picker1").picker({
        toolbarTemplate: '<header class="bar bar-nav"><button class="button button-link pull-right close-picker">确定</button><h1 class="title">请选择档位设置</h1></header>',
        cols: [
            {
                textAlign: 'center',
                values: ['一档', '二档', '三档', '四档', '五档', '六档', '七档', '八档', '九档']
            }
        ]
    });
});
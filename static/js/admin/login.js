/**
 * Created by adminn on 2018/3/15.
 */
layui.use(['form', 'layedit', 'laydate'], function(){
    var layer = layui.layer;
    $("body").keydown(function(event) {
        if (event.keyCode == "13") {//keyCode=13是回车键

            login();
        }
    });
    $("#login_btn").on('click',function(){
        login();
    })

    $(".goOut").on('click',function(){
        layer.open({
            content: '确认退出？'
            ,btn: ['退出', '取消']
            ,yes: function(index){
                window.location.href = '/admin/account/logout.html';
                layer.close(index);
            }
        });
    })


    function login(){
        var account = $("#account").val();
        var password = $("#password").val();
        if(!account){
            layer.msg('请输入商户号',{icon:2,time:2000});
            return false;
        }

        if(!password){
            layer.msg('请输入密码',{icon:2,time:2000});
            return false;
        }
        $.ajax({
            type:'post',
            url:'/admin/login.html',
            data:{account:account,password:password},
            dataType:'json',
            success:function(data){
                if(data.success == '1'){
                    layer.msg(data.msg,{icon:1,time:2000},function(){
                        window.location.href = '/admin.html';
                    });
                }
                if(data.error == '1'){
                    layer.msg(data.msg,{icon:2,time:2000});
                }
            }
        })
        return false;
    }
})



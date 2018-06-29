/**
 * Created by ZB on 2018/6/22.
 */
var errorMsg = "";
$(function() {

    //点击登录
    $("#btnLogin").on("click",function(){
        login();
    });

});

//验证账号
function verifyAccount(account){
    var account = $.trim(account);
    var accountReg = /^[a-zA-Z]+[0-9a-zA-Z_]{5,14}$/;
    var phoneReg = /^(13|14|15|17|18)[0-9]{9}$/;
    if(!account){
        errorMsg = "请输入您的账号";
        return false;
    }else if(!accountReg.test(account)&&!phoneReg.test(account)){
        errorMsg = "请填写正确的账号";
        return false;
    }
    else{
        errorMsg = "";
        return true;
    }
}

//验证注册密码
function verifyPwd(pwd){
    var pwd = $.trim(pwd);
    var pwdReg = /^\w{6,15}$/;
    if(!pwd){
        errorMsg = "请填写您的密码";
        return false;
    }else if(!pwdReg.test(pwd)){
        errorMsg = "请填写正确的密码";
        return false;
    }else{
        errorMsg = "";
        return true;
    }
}


//点击登录
// function login(){
//
//     var account = $.trim($("#account input").val());
//     var pwd = $.trim($("#pwd input").val());
//
//     $.post('/mobile',{account:account,password:pwd},function (msg) {
//         if(msg.success == '1'){
//             window.location.href = '/mobile/index';
//         }
//         if(msg.error == '1'){
//             $.toast(msg.msg);
//         }
//     },"json");
// }
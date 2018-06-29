<?php

//获取当前商户ID
function get_pro_id(){
    $promote = session('promote_auth');
    return $promote['id'];
}
/**
 * 获取服务器端IP地址
 * @return string
 */
function get_server_ip() {

    if (isset($_SERVER)) {

        if ($_SERVER['SERVER_ADDR']) {

            $server_ip = $_SERVER['SERVER_ADDR'];
        } else {

            $server_ip = $_SERVER['LOCAL_ADDR'];
        }
    } else {

        $server_ip = getenv('SERVER_ADDR');
    }

    return $server_ip;
}

//判断充值状态
function getPayStatus($status) {
    switch ($status) {
        case '0':
            return '待支付';
            break;
        case '1':
            return '支付成功';
            break;
        case '2':
            return '超时未支付';
            break;
        case '3':
            return '余额不足';
            break;
    }
}

//判断提现状态
function getWithStatus($status) {
    switch ($status) {
        case '0':
            return '待审核';
            break;
        case '1':
            return '审核不通过';
            break;
        case '2':
            return '审核通过';
            break;
        case '3':
            return '打款中';
            break;
        case '4':
            return '提现完成';
            break;
    }
}

//判断充值类型
function getPayType($source) {
    $type = '';
    switch ($source) {
        case '1':
            $type = '支付宝';
            break;
        case '2':
            $type = '微信';
            break;
        case '3':
            $type = '网银';
            break;
        case '4':
            $type = 'H5微信';
            break;
        case '5':
            $type = 'H5支付宝';
            break;
        case '6':
            $type = '手机QQ';
            break;
    }
    return $type;
}

//判断充值第三方名称
function getPayClass($type) {
    $t = '';
    switch ($type) {
        case '1':
            $t = '通联';
            break;
        case '2':
            $t = '环迅';
            break;
        case '3':
            $t = '千玺';
            break;
        case '4':
            $t = '爱加密';
            break;
        case '5':
            $t = '点缀';
            break;
        case '6':
            $t = '兴业';
            break;
        case '7':
            $t = '融宝';
            break;
        case '8':
            $t = '快接';
            break;
    }
    return $t;
}

//通过银行标识获取银行名称
function getBankName($key){
    $bank = Config('bank');
    $list = $bank['bank_list'];
    if(array_key_exists($key,$list)){
        return $list[$key];
    }else{
        return '';
    }

}

//通过bank_id获取银行名称
function getIdBankName($bank_id){
    $bank_name = db('binding_bank')->where("bank_id",$bank_id)->value('bank_name');
    $bank = Config('bank');
    $list = $bank['bank_list'];
    if(array_key_exists($bank_name,$list)){
        return $list[$bank_name];
    }else{
        return '';
    }
}

//生成商户APPKEY
function generateKey(){
    $a = range(0,9);
    for($i=0;$i<8;$i++){
        $b[] = array_rand($a);
    } // www.yuju100.com
    return join("",$b);
}

//获取银行所属地区
function getBankRegion($str){
    $str_arr = explode(',',$str);
    $new_str = '';
    foreach($str_arr as $value){
        $new_str .= db('areas')->where("area_id=".$value)->value('area_name') . ",";
    }
    return substr($new_str,0,-1);
}

//获取推荐人
function getRef($id){
    if($id){
        $re_account = db('promote')->where("id=".$id)->value('account');
        return $re_account;
    }
}

//查询用户档位
function getLevel($id){
    if($id){
        $level_title = db('promote_level')->where("id=".$id)->value('level');
        return $level_title;
    }
}

//检测商户是否存
function checkPro($account,$nickname){
    if($account){
        $acc_find = db('promote')->where("account='".$account."'")->find();
    }
    if($nickname){
        $nick_find = db('promote')->where("nickname='".$nickname."'")->find();
    }
    if($acc_find){
        return [
            're'  => 0,
            'msg'=>'商户号已存在',
        ];
    }
    if($nick_find){
        return [
            're'  => 0,
            'msg'=>'商户名称已存在',
        ];
    }
    if(!$acc_find && !$nick_find){
        return [
            're'  => 1,
        ];
    }
}

function think_ucenter_md5($str, $key = 'ThinkUCenter'){
    return '' === $str ? '' : md5(sha1($str) . $key);
}

//添加商户操作记录
function rwLog($data){
    $re = db('promote_logs')->insert($data);
    return $re;
}

//获取用户各种数据
function getProData(){
    $data = [];
    $id = session('promote_auth')['id'];
    $where = "promote_id=".$id;
    // 获取今日开始时间戳和结束时间戳
    $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
    $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
    //用户总充值额
    //总充值金额
    $data['all_data'] = db('promote_deposit')->where($where.' and pay_status=1')->value('sum(pay_amount)');
    //用户总提现额
    $data['all_with'] = db('auth_withdraw')->where($where." and status=4")->value("sum(money)");
    //用户总结算额
    $data['all_sett'] = db('promote_deposit')->where($where." and pay_status=1 and status=1")->value("sum(pay_amount) pay_amount");

    //商户基本信息
    //总订单数（成功）
    $data['all_orders'] = db('promote_deposit')->where($where.' and pay_status=1')->count();
    //总订单总额（成功）
    $data['all_orders_money'] = db('promote_deposit')->where($where.' and pay_status=1')->value('sum(pay_amount)');

    //今日充值订单总数（成功）
    $data['today_orders'] = db('promote_deposit')->where($where.' and pay_status=1 and (create_time >= '.$beginToday.' and create_time <= '.$endToday.')')->count();

    //今日充值订单总额（成功）
    $data['today_orders_money'] = db('promote_deposit')->where($where.' and pay_status=1 and (create_time >= '.$beginToday.' and create_time <= '.$endToday.')')->value('sum(pay_amount)');

    //当前提现记录数
    $data['with_strip'] = db('auth_withdraw')->where($where." and status != 1")->count();

    //当前已提现总额
    $data['with_money'] = db('auth_withdraw')->where($where." and status = 4")->value("sum(money)");

    //当前可提现总额
    $with_not = db('promote')->field("(money + h5_wetch_money + h5_alipay_money + t0_money) as with_not")->where('id='.$id)->find();
    $data['with_not'] = $with_not['with_not'];

    //今日提现记录数
    $data['today_with_strip'] = db('auth_withdraw')->where($where.' and status != 1 and (ctime >= '.$beginToday.' and ctime <= '.$endToday.')')->count();

    //今日提现记录总额
    $data['today_with_money'] = db('auth_withdraw')->where($where.' and status != 1 and (ctime >= '.$beginToday.' and ctime <= '.$endToday.')')->value("sum(money)");

    //未结算总额
    $data['not_sett'] = db('promote_deposit')->where($where." and pay_status=1 and status=0")->value("sum(pay_amount) pay_amount");
    return $data;
}


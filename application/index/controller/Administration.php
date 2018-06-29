<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/3/19
 * Time: 15:14
 */
namespace app\index\controller;

use app\common\controller\Base;
use think\Config;
use lib\Excel;
class Administration extends Base{
    const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';
    //充值列表
    public function index(){
        //查询当前充值总金额
        $total_money = db('promote_deposit')->where("pay_status=1")->value('sum(pay_amount)');
        $this->assign('total_money',$total_money ? $total_money : '0.00');
        //查询当日充值额和提现额
        $now_time = strtotime(date("Y-m-d",time()) . " 00:00:00");
        //充值额
        $recharge = db('promote_deposit')->where("pay_status=1"." and create_time > ".$now_time)->value("sum(pay_amount)");
        $this->assign('recharge',$recharge ? $recharge : '0.00');

        // 结算总金额
        $map['pay_status'] = 1;
        $map['status'] = 1;
        $promote_deposit = db('promote_deposit')->field("sum(pay_amount) pay_amount")->where($map)->find();
        $promote_deposit = $promote_deposit['pay_amount'] ?? 0;
        $this->assign('pay_amount', $promote_deposit);

        // 未结算金额
        $map['pay_status'] = 1;
        $map['status'] = 0;
        $unpromote_deposit = db('promote_deposit')->field("sum(pay_amount) pay_amount")->where($map)->find();
        $unpromote_deposit = $unpromote_deposit['pay_amount'] ?? 0;
        $this->assign('unpay_amount', $unpromote_deposit);



        return $this->fetch();
    }

    //获取所有充值列表
    public function getRech(){
        if (!request()->isGet()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {

            $page  = input('get.page');
            $limit = input('get.limit');
            $sPage = ($page - 1) * $limit;
            //TODO::待加入条件查询
            $sta       = strtotime(input('get.start_time'));
            $end       = strtotime(input('get.first_time'));
            $order_number = input('get.order_number');
            $pay_order_number = input('get.pay_order_number');
            $account = input('get.account');
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $pay_type = input('get.pay_type');
            $where   = 1;

            if (!empty($sta) && !empty($end)) {
                $where .= ' and (pd.create_time > ' . $sta . ' and pd.create_time <' . $end . ")";
            }else{
                if(!empty($sta) && empty($end)){
                    $where .= ' and pd.create_time > ' . $sta;
                }
                if(empty($sta) && !empty($end)){
                    $where .= ' and pd.create_time <' . $end;
                }
            }
            if (!empty($order_number)) {
                $where .= " and pd.order_number='".$order_number."'";
            }
            if(!empty($account)){
                $where .= " and pd.promote_account='".$account."'";
            }
            if (!empty($pay_order_number)) {
                $where .= " and pd.pay_order_number='".$pay_order_number."'";
            }
            if(isset($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if($pay_way){
                $where .= " and pd.pay_way=" . $pay_way;
            }
            if(input('status') != null){
                $where .= " and pd.status=". input('status');
            }
            if($pay_type){
                $where .= " and pd.pay_type=" . $pay_type;
            }

            //---------------END--------------//
            $data  = db('promote_deposit')
                ->alias('pd')
                ->field('pd.*,p.account,p.id')
                ->join('promote p','p.id=pd.promote_id')
                ->where($where)
                ->order('pd.id desc')
                ->limit($sPage, $limit)
                ->select();
            $count = db('promote_deposit')
                ->alias('pd')
                ->field('pd.*,p.account,p.id')
                ->join('promote p','p.id=pd.promote_id')
                ->where($where)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['order_number'] =  $v['order_number'];
                    $v['pay_order_number'] = $v['pay_order_number'];
                    $v['promote_account'] = $v['promote_account'];
                    $v['pay_status'] = getPayStatus($v['pay_status']);
                    $v['pay_way'] = getPayType($v['pay_way']);
                    $v['pay_amount'] = number_format($v['pay_amount'],2);
                    $v['pay_ip'] = $v['pay_ip'];
                    $v['pay_type'] = getPayClass($v['pay_type']);
                    $v['create_time']    = $v['create_time'] ? date('Y-m-d H:i:s', $v['create_time']) : '';
                    $v['key']           = $k + 1;
                    $v['status'] = $this->getStatus($v['status']);
                }
                return [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => $count,
                    'data'  => $data
                ];
            } else {
                return [
                    'code' => 1,
                    'msg'  => '没有数据'
                ];
            }
        }
    }

    //查询是否有可导出的数据
    public function selectData(){
        if(!request()->isGet()){
            exit('非法操作');
        }else{
            $sta       = strtotime(input('get.start_time'));
            $end       = strtotime(input('get.first_time'));
            $order_number = input('get.order_number');
            $pay_order_number = input('get.pay_order_number');
            $account = input('get.account');
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $pay_type = input('get.pay_type');
            $where   = 1;

            if (!empty($sta) && !empty($end)) {
                $where .= ' and (pd.create_time > ' . $sta . ' and pd.create_time <' . $end . ")";
            }else{
                if(!empty($sta) && empty($end)){
                    $where .= ' and pd.create_time > ' . $sta;
                }
                if(empty($sta) && !empty($end)){
                    $where .= ' and pd.create_time <' . $end;
                }
            }
            if (!empty($order_number)) {
                $where .= " and pd.order_number='".$order_number."'";
            }
            if (!empty($pay_order_number)) {
                $where .= " and pd.pay_order_number='".$pay_order_number."'";
            }
            if(!empty($account)){
                $where .= " and pd.promote_account='".$account."'";
            }
            if(!empty($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
            }
            if(input('status') != null){
                $where .= " and pd.status=". input('status');
            }
            if($pay_type){
                $where .= " and pd.pay_type=" . $pay_type;
            }
            $data  = db('promote_deposit')
                ->alias('pd')
                ->field('pd.*,p.account,p.id')
                ->join('promote p','p.id=pd.promote_id')
                ->where($where)
                ->select();
            if($data){
                return [
                    'code' => 1,
                ];
            }else{
                return [
                    'code' => 0,
                    'msg'  => '没有数据'
                ];
            }
        }
    }


    //导出数据
    public function downData() {
        set_time_limit(0);
        if (!request()->isGet()) {
            exit('非法操作');
        } else {
            $sta       = strtotime(input('get.start_time'));
            $end       = strtotime(input('get.first_time'));
            $order_number = input('get.order_number');
            $pay_order_number = input('get.pay_order_number');
            $account = input('get.account');
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $pay_type = input('get.pay_type');
            $where   = 1;

            if (!empty($sta) && !empty($end)) {
                $where .= ' and (pd.create_time > ' . $sta . ' and pd.create_time <' . $end . ")";
            }else{
                if(!empty($sta) && empty($end)){
                    $where .= ' and pd.create_time > ' . $sta;
                }
                if(empty($sta) && !empty($end)){
                    $where .= ' and pd.create_time <' . $end;
                }
            }
            if (!empty($order_number)) {
                $where .= " and pd.order_number='".$order_number."'";
            }
            if (!empty($pay_order_number)) {
                $where .= " and pd.pay_order_number='".$pay_order_number."'";
            }
            if(!empty($account)){
                $where .= " and pd.promote_account='".$account."'";
            }
            if(!empty($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
            }
            if(input('status') != null){
                $where .= " and pd.status=". input('status');
            }
            if($pay_type){
                $where .= " and pd.pay_type=" . $pay_type;
            }

            $data  = db('promote_deposit')
                ->alias('pd')
                ->field('pd.*,p.account,p.id')
                ->join('promote p','p.id=pd.promote_id')
                ->where($where)
                ->order('pd.id desc')
                ->select();
            if (!empty($data)) {
                $list = [];
                foreach ($data as $kr => $or) {
                    $o = [
                        $or['account'],
                        $or['order_number'] ? $or['order_number'] : '',
                        $or['pay_order_number'],
                        $or['pay_amount'],
                        getPayStatus($or['pay_status']),
                        getPayType($or['pay_way']),
                        getPayClass($or['pay_type']),
                        $or['status'] ? '已结算' : '未结算',
                        date("Y-m-d H:i:s",$or['create_time']),
                    ];

                    if (!empty($o)) {
                        array_push($list, $o);
                    }
                }
            }
            $fileName = '充值记录' . date('Y-m-d H:i:s', time()) . '.xls';
            $fileHead = [
                '商户号',
                '平台订单号',
                '商户订单号',
                '充值金额',
                '充值状态',
                '支付方式',
                '第三方',
                '结算状态',
                '充值时间',
            ];
            $letter   = [
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I'
            ];
            (new Excel())->downExcel($fileName, $fileHead, $list, $letter, 'D');
        }
    }


    //所有商户列表
    public function promote(){
        return $this->fetch();
    }

    //获取所有商户数据
    public function getPromote(){
        if (!request()->isGet()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {

            $page  = input('get.page');
            $limit = input('get.limit');
            $sPage = ($page - 1) * $limit;
            //TODO::待加入条件查询
            $account = input('get.account');
            $nickname = input('get.nickname');
            $where = "identity=1";

            if($account){
                $where .= " and account='".$account."'";
            }
            if($nickname){
                $where .= " and nickname='".$nickname."'";
            }
            //---------------END--------------//
            $data  = db('promote')
                ->where($where)
                ->order('id desc')
                ->limit($sPage, $limit)
                ->select();
            $count = db('promote')
                ->where($where)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['id']           = $v['id'];
                    $v['account']      = $v['account'];
                    $v['nickname']     = $v['nickname'];
                    $v['mobile_phone'] = $v['mobile_phone'];
                    $v['email']        = $v['email'];
                    $v['referee_id']   = $v['referee_id'] ? getRef($v['referee_id']) : '';
                    $v['real_name']    = $v['real_name'];
                    $v['money']        = $v['money'] ? $v['money'] : '0.00';
                    $v['total_money']  = $v['total_money'] ? $v['total_money'] : '0.00';
                    $v['status']       = $v['status'];
                    $v['level_title']  = getLevel($v['level_id']);
                    $v['create_time']  = $v['create_time'] ? date('Y-m-d H:i:s', $v['create_time']) : '';
                    $v['key']          = $k + 1;
                }
                return [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => $count,
                    'data'  => $data
                ];
            } else {
                return [
                    'code' => 1,
                    'msg'  => '没有数据'
                ];
            }
        }
    }

    //编辑商户资料
    public function edit(){
        if(!request()->isPost()){
            $id = input('get.id');
            //查询所有档位
            $level = db('promote_level')->order('ident asc')->select();

            //查询用户资料
            $pro_data = db('promote')->where("id=".$id)->find();
            $this->assign('pro_data',$pro_data);
            $this->assign('level',$level);
            return $this->fetch();
        }else{
            $data = input('post.');
            if($data){
                $up_data = [
                    'nickname' => $data['nickname'],
                    'mobile_phone' => $data['mobile_phone'],
                    'email'    => $data['email'],
                    'level_id' => $data['level_id']
                ];

                $result = db('promote')->where("id=".$data['id'])->update($up_data);
                if($result){
                    return [
                        'code' => 1,
                        'msg'  => '编辑成功'
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg'  => '编辑失败'
                    ];
                }
            }
        }
    }

    //商户信息详情
    public function details(){

        return $this->fetch();
    }
    //修改商户账号状态
    public function upStatus(){
        $id  = input('get.id');
        $status = db('promote')->where("id=".$id)->value("status");
        if($status){
            $up_status = 0;
        }else{
            $up_status = 1;
        }
        db('promote')->where("id=".$id)->update(['status' => $up_status]);
        return [
            'code' => 1,
            'status' => $up_status
        ];
    }

    //分配用户
    public function addPro(){
        if(!request()->isPost()){
            //生成商户号
            $account = 'ZB'.time();

            //查询所有档位
            $level = db('promote_level')->order('ident asc')->select();

            // 商户列表
            $map['identity'] = 1;
            $account_data = db('promote')->field('id,account')->where($map)->select();

            $this->assign('account_data',$account_data);
            $this->assign('account',$account);
            $this->assign('level',$level);
            return $this->fetch();
        }else{
            $data = input('post.');

            $re = checkPro($data['account'], $data['nickname']);
            if($re['re'] == 0){
                return [
                    'code' => 1,
                    'msg' => $re['msg']
                ];
                exit;
            }else{
                $ins_data = [
                    'account'       => $data['account'],
                    'nickname'      => $data['nickname'],
                    'mobile_phone'  => $data['mobile_phone'],
                    'email'         => $data['email'],
                    'level_id'      => $data['level_id'],
                    'referee_id'      => $data['referee_id'],
                    'hands_pass'    => $this->think_ucenter_md5($data['hands_pass'], self::DATA_AUTH_KEY),
                    'identity'      => 1,
                    'create_time'   => time()
                ];
                $result = db('promote')->insertGetId($ins_data);
                if($result){
                    return [
                        'code' => 1,
                        'msg' => '分配成功'
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg' => '分配失败'
                    ];
                }
            }
        }

    }

    //密码加密
    public function think_ucenter_md5($str, $key = 'ThinkUCenter'){
        return '' === $str ? '' : md5(sha1($str) . $key);
    }



    //提现列表
    public function with(){
        //已提现总金额
        $all_with = db('auth_withdraw')->where("status=4")->value("sum(money)");
        $this->assign('all_with',$all_with ? $all_with : '0.00');
        //当日提现金额
        $now_time = strtotime(date("Y-m-d",time()) . " 00:00:00");
        $with = db('auth_withdraw')->where("status=4" . " and ctime > ".$now_time)->value("sum(money)");

        //佣金总额
        $commission_data = db('auth_withdraw')->where("status=4")->select();
        $commission = 0;
        foreach ($commission_data as $key=>$val){
            $commission += $val['money'] * $val['rate'];
        }
        //提现中金额
        $is_with = db('auth_withdraw')->where("status=0 or status=2 or status=3")->value("sum(money)");

        $this->assign('with',$with ? $with : '0.00');
        $this->assign('commission',$commission ? $commission : '0.00');
        $this->assign('is_with',$is_with ? $is_with : '0.00');
        return $this->fetch();
    }

    //获取提现页数据
    public function getWith(){
        if (!request()->isGet()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {

            $page  = input('get.page');
            $limit = input('get.limit');
            $sPage = ($page - 1) * $limit;
            //TODO::待加入条件查询
            $sta       = strtotime(input('get.start_time'));
            $end       = strtotime(input('get.first_time'));
            $account = input('get.account');
            $nickname = input('get.nickname');
            $status = input('get.status');
            $auth_way = input('get.auth_way');
            $where = 1;

            if (!empty($sta) && !empty($end)) {
                $where .= ' and (a.ctime > ' . $sta . ' and a.ctime <' . $end . ")";
            }else{
                if(!empty($sta) && empty($end)){
                    $where .= ' and a.ctime > ' . $sta;
                }
                if(empty($sta) && !empty($end)){
                    $where .= ' and a.ctime <' . $end;
                }
            }
            if($account){
                $where .= " and a.account='".$account."'";
            }
            if($nickname){
                $where .= " and a.nickname='".$nickname."'";
            }
            if($status != ''){
                $where .= " and a.status=".$status;
            }
            if($auth_way != ''){
                if($auth_way == 2){
                    $where .= " and a.auth_way=0";
                }else{
                    $where .= " and a.auth_way=".$auth_way;
                }

            }
            //---------------END--------------//
            $data  = db('auth_withdraw')
                ->alias('a')
                ->field('a.*,p.account,p.nickname')
                ->join('promote p','p.id=a.promote_id')
                ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
                ->where($where)
                ->order('a.id desc')
                ->limit($sPage, $limit)
                ->select();
            $count = db('auth_withdraw')
                ->alias('a')
                ->field('a.*,p.account,p.nickname')
                ->join('promote p','p.id=a.promote_id')
                ->where($where)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['id']           = $v['id'];
                    $v['account']      = $v['account'];
                    $v['nickname']     = $v['nickname'];
                    $v['money'] = $v['money'];
                    $v['revenue'] = $v['rate'];
                    $v['actual_money'] = $v['actual_money'];
                    $v['bank_id']    = getIdBankName($v['bank_id']);
                    $v['status']  = getWithStatus($v['status']);
                    $v['remark']       = $v['remark'];
                    $v['ctime']  = $v['ctime'] ? date('Y-m-d H:i:s', $v['ctime']) : '';
                    $v['audit_time']  = $v['audit_time'] ? date('Y-m-d H:i:s', $v['audit_time']) : '';
                    $v['auth_way']  = $v['auth_way'] ? 'H5' : 'PC';
                    $v['key']          = $k + 1;
                }
                return [
                    'code'  => 0,
                    'msg'   => '',
                    'count' => $count,
                    'data'  => $data
                ];
            } else {
                return [
                    'code' => 1,
                    'msg'  => '没有数据'
                ];
            }
        }
    }


    /**
     * getStatus [获取结算状态]
     *
     * author dear
     * @param $status
     * @return string
     */
    private function getStatus($status)
    {
        switch ($status){
            case 1:
                $res = '已结算';
                break;
            case 0:
                $res = '未结算';
                break;

        }
        return $res;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/6/11
 * Time: 17:35
 */
namespace app\index\controller;

use app\common\controller\Base;
use lib\Sms;
class Substitute extends Base{
    const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';
    public function index(){

        // 提现费率和可提现金额
        $map['p.id'] = session('promote_auth')['id'];
        $revenue = db('promote')
            ->alias('p')
            ->join('promote_level l', 'p.level_id = l.id', 'left')
            ->where($map)
            ->find();

        $id = session('promote_auth')['id'];
        //未结算金额
        $no_map['promote_id'] = $id;
        $no_map['pay_status'] = 1;// 支付成功
        $no_map['status'] = 0;// 未结算
        $no_map['pay_way'] = ['in','1,2'];
        $no_map['pay_type'] = ['eq',7];
        $no_money = [];
        $no_money['scan'] = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");
        $no_map['pay_way'] = ['in',5];
        $no_money['alipay'] = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");
        $no_map['pay_way'] = ['in',4];
        $no_money['wetch'] = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");

        //已结算金额
        $yes_map['promote_id'] = $id;
        $yes_map['pay_status'] = 1;// 支付成功
        $yes_map['status'] = 1;// 已结算
        $yes_map['pay_way'] = ['in','1,2'];
        $yes_map['pay_type'] = ['eq',7];
        $yes_money = [];
        //扫码已结算
        $yes_money['scan'] = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");
        //H5支付宝已结算
        $yes_map['pay_way'] = ['in',5];
        $yes_money['alipay'] = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");
        //H5微信已结算
        $yes_map['pay_way'] = ['in',4];
        $yes_money['wetch'] = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");


        //已提现
        $al_map['promote_id'] = $id;
        $al_map['status'] = 4;// 提现成功
        $al_map['auth_way'] = 0;
        $al_map['is_sub'] = 1;
        $al_with_money  = [];
        //扫码已提现
        $al_with_money['scan'] = db('auth_withdraw')->where($al_map)->value("sum(money)");
        //H5微信已提现
        $al_map['auth_way'] = 1;
        $al_with_money['h5_wetch'] = db('auth_withdraw')->where($al_map)->value("sum(money)");
        //H5支付宝已提现
        $al_map['auth_way'] = 2;
        $al_with_money['h5_alipay'] = db('auth_withdraw')->where($al_map)->value("sum(money)");


        $this->assign('revenue',$revenue);// 费率
        $this->assign('money',(float)$revenue['money']);// 可提现金额

        $this->assign('no_money',$no_money);// 未结算金额
        $this->assign('yes_money',$yes_money);// 已结算金额
        $this->assign('al_with_money',$al_with_money);// 已提现金额
        return $this->fetch();
    }

    //代付的充值记录
    public function subWithData()
    {
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
            $where   = 1;


            $map['w.promote_id'] = session('promote_auth')['id'];
            $map['w.is_sub'] = 1;


            $field = "p.account,w.id,w.money,w.rate,w.actual_money,w.ctime,w.status,w.audit_time,w.bank_id,w.auth_way,b.bank_name,b.bank_number";
            $data = db('auth_withdraw')
                ->alias('w')
                ->field($field)
                ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
                ->join('promote p', 'w.promote_id = p.id', 'left')
                ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
                ->order('w.id desc')
                ->where($map)
                ->limit($sPage, $limit)
                ->select();

            $count = db('auth_withdraw')
                ->alias('w')
                ->field($field)
                ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
                ->join('promote p', 'w.promote_id = p.id', 'left')
                ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
                ->where($map)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['key'] = $k + 1;
                    $v['revenue'] = (float)$v['rate'];
                    $v['bank_title']   = getIdBankName($v['bank_id']);
                    $v['ctime'] = $v['ctime'] ? date('Y-m-d H:i:s',$v['ctime']) : '';
                    $v['audit_time'] =$v['audit_time'] ? date('Y-m-d H:i:s',$v['audit_time']) : '';
                    $v['status'] = getWithStatus($v['status']);
                    $v['auth_way'] = $this->getAuthWay($v['auth_way']);
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

    //提现类型
    public function getAuthWay($auth_way){
        if($auth_way == 0){
            return '扫码';
        }
        if($auth_way == 1){
            return 'H5微信';
        }
        if($auth_way == 2){
            return 'H5支付宝';
        }
    }

    //代付扫码,H5支付宝,H5微信结算
    public function allAccount(){
        $id = session('promote_auth')['id'];
        $map['promote_id'] = $id;
        $map['pay_type'] = 7;
        $map['pay_status'] = 1;
        $map['status'] = 0;
        $data =  db('promote_deposit')->where($map)->select();

        if($data){
            \think\Db::startTrans();
            foreach($data as $key => $val){
                $p_id = $val['id'];
                $money = $val['pay_amount'];

                if($val['pay_way'] == 1 || $val['pay_way'] == 2){
                    $inc_money = 'sub_money';
                }
                if($val['pay_way'] == 4){
                    $inc_money = 'sub_h5_wetch';
                }
                if($val['pay_way'] == 5){
                    $inc_money = 'sub_h5_alipay';
                }

                // 商户表金额增加
                $pro_inc = db('promote')->where("id", $id)->setInc($inc_money,$money);

                // 充值表结算
                $p_map['id'] = $p_id;
                $p_updata['status'] = 1;
                $p_up = db('promote_deposit')->where($p_map)->update($p_updata);

                // 结算日志
                $logcotent = 'ID为： '.$id.' 的用户结算了一笔订单，结算金额为 '. $money;
                $log_data = [
                    'pid' => $id,
                    'contet' => $logcotent,
                    'money' => $money,
                    'ip' => $this->request->ip(),
                    'time' => time(),
                ];
                $log_ins = db('promote_accounts_log')->insert($log_data);
                if(!$pro_inc || !$p_up || !$log_ins){
                    return ['code' => 1, 'msg' => '结算失败，请稍后再试'];
                    \think\Db::rollback();
                }
            }
            \think\Db::commit();
            return ['code' => 0, 'msg' => '结算成功，现在可以提现啦'];
        }else{
            return ['code' => 1, 'msg' => '没有可以结算的订单'];
        }
    }

    /**
     * withdraw [提现申请]
     *
     * author dear
     */
    public function applyFor()
    {
        $type = input('get.type');
        // 当前账号资金数据
        $field = 'p.*,p_l.*';
        $account = session('promote_auth')['id'];
        $applyFor = db('promote')
            ->alias('p')
            ->field($field)
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where("p.id", $account)
            ->find();
        $applyFor['revenue'] =  (float)$applyFor['revenue'];

        // 收款银行卡数据
        $b_field = 'bank_id,bank_name,bank_number';
        $bank_card = db('binding_bank')->field($b_field)->where("promote_id=".$account." and status != 2")->select();
        foreach ($bank_card as $key => $value) {
            $bank_card[$key]['title'] = getBankName($value['bank_name']);
        }

        // 提现申请
        if($this->request->post()){
            $money = input('money');
            $bankid = input('bank_id');
            $pay_pass = input('pay_pass');
            $type = input('type');

            if(!$pay_pass){
                return ['code' => 1, 'msg' => '请输入提现密码!'];
            }

            if($pay_pass){
                $pro_pass = db('promote')->where("id",$account)->value('pay_pass');
                if($pro_pass != think_ucenter_md5($pay_pass,self::DATA_AUTH_KEY)){
                    return ['code' => 5, 'msg' => '提现密码错误!'];
                }
            }

            // 参数验证
            if(!$money || !$bankid){
                return ['code' => 1, 'msg' => '参数错误!'];
            }
            if(!preg_match("/^\d*$/",$money) || !preg_match("/^\d*$/",$bankid)){
                return ['code' => 2, 'msg' => '请输入整数!'];
            }
            if($type == ''){
                $setDec = 'sub_money';
                if($money > $applyFor['sub_money']){
                    return ['code' => 3, 'msg' => '余额不足!'];
                }
            }
            if($type == 'alipay'){
                $setDec = 'sub_h5_alipay';
                if($money > $applyFor['sub_h5_alipay']){
                    return ['code' => 3, 'msg' => '余额不足!'];
                }
            }
            if($type == 'wetch'){
                $setDec = 'sub_h5_wetch';
                if($money > $applyFor['sub_h5_wetch']){
                    return ['code' => 3, 'msg' => '余额不足!'];
                }
            }


            // 发起提现
            \think\Db::startTrans();
            // 余额扣款
            $promote_dec = db('promote')->where("id",$account)->setDec($setDec, $money);
            if($type == ''){
                $auth_way = 0;
                $revenue = $applyFor['revenue'];
            }
            if($type == 'wetch'){
                $auth_way = 1;
                $revenue = $applyFor['h5_wetch_revenue'];
            }
            if($type == 'alipay'){
                $auth_way = 2;
                $revenue = $applyFor['h5_alipay_revenue'];

            }
            // 添加提现申请记录
            $w_data = [
                'promote_id' => $account,
                'money' => $money,
                'ctime' => time(),
                'status' => 0,
                'type' => 2,
                'is_sub' => 1,
                'auth_way' => $auth_way,
                'bank_id' => $bankid,
                'rate' => $revenue,
                'actual_money' => $money - $money * $revenue
            ];
            $withdraw_ins = db('auth_withdraw')->where("promote_id", $account)->insert($w_data);

            // 提现log
            $bank_info = db('binding_bank')->field($b_field)->where("bank_id",$bankid)->find();
            $logcotent = '提现申请： ID为 '.$applyFor['id'].' 的用户发起了一笔'.$type.'提现申请，提现金额为 '. $money .'，手续费率为 ' . $applyFor['revenue'] . ' ， 实际到账金额为 '. $w_data['actual_money']  . ' ，收款账号为： '.$bank_info['bank_name']. ' '.$bank_info['bank_number'];
            $log_data = [
                'content' => $logcotent,
                'login_ip' => $this->request->ip(),
                'time' => time(),
                'pid' => $account,
            ];
            $log_ins = rwLog($log_data);

            if(!$promote_dec || !$withdraw_ins || !$log_ins){
                \think\Db::rollback();
                return ['code' => 4, 'msg' => '操作失败，请稍后再试!'];
            }
            \think\Db::commit();
            return ['code' => 0, 'msg' => '操作成功'];
        }

        $this->assign('bank_card', $bank_card);
        $this->assign('info', $applyFor);
        $this->assign('type', $type);
        return $this->fetch();
    }
}
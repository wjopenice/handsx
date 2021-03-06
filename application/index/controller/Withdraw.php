<?php
/**
 * Created by PhpStorm.
 * Author: Administrator
 * Date: 2018/3/16
 * Time: 11:59
 */

namespace app\index\controller;

class Withdraw extends \app\common\controller\Base
{
    const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';
    public function index()
    {
        
        // 提现费率和可提现金额
        $map['p.id'] = session('promote_auth')['id'];
        $revenue = db('promote')
            ->alias('p')
            ->field('revenue, money')
            ->join('promote_level l', 'p.level_id = l.id', 'left')
            ->where($map)
            ->find();
        $revenue = $revenue ? $revenue : 0;

        $id = session('promote_auth')['id'];

        //未结算金额
        $no_map['promote_id'] = $id;
        $no_map['pay_status'] = 1;// 支付成功
        $no_map['status'] = 0;// 未结算
        $no_map['pay_way'] = ['in','1,2,3'];
        $no_map['pay_type'] = ['neq',2];
        $no_money = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");

        //已结算金额
        $yes_map['promote_id'] = $id;
        $yes_map['pay_status'] = 1;// 支付成功
        $yes_map['status'] = 1;// 已结算
        $yes_map['pay_way'] = ['in','1,2,3'];
        $yes_map['pay_type'] = ['neq',2];
        $yes_money = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");

        //已提现
        $al_map['promote_id'] = $id;
        $al_map['status'] = 4;// 提现成功
        $al_map['auth_way'] = 0;
        $al_with_money = db('auth_withdraw')->where($al_map)->value("sum(money)");

        $this->assign('revenue',(float)$revenue['revenue']);// 费率
        $this->assign('money',(float)$revenue['money']);// 可提现金额

        $this->assign('no_money',$no_money ? : '0.00');// 未结算金额
        $this->assign('yes_money',$yes_money ? : '0.00');// 已结算金额
        $this->assign('al_with_money',$al_with_money ? : '0.00');// 已提现金额
        return $this->fetch();
    }

    //T0提现记录
    public function todaywith()
    {
        // 提现费率和可提现金额
        $map['p.id'] = session('promote_auth')['id'];
        $revenue = db('promote')
            ->alias('p')
            ->field('revenue, t0_money as money')
            ->join('promote_level l', 'p.level_id = l.id', 'left')
            ->where($map)
            ->find();
        $revenue = $revenue ? $revenue : 0;

        $id = session('promote_auth')['id'];

        //未结算金额
        $no_map['promote_id'] = $id;
        $no_map['pay_status'] = 1;// 支付成功
        $no_map['status'] = 0;// 未结算
        $no_map['pay_way'] = ['in','1,2,3'];
        $no_map['pay_type'] = ['eq',2];
        $no_money = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");

        //已结算金额
        $yes_map['promote_id'] = $id;
        $yes_map['pay_status'] = 1;// 支付成功
        $yes_map['status'] = 1;// 已结算
        $yes_map['pay_way'] = ['in','1,2,3'];
        $yes_map['pay_type'] = ['eq',2];
        $yes_money = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");

        //已提现
        $al_map['promote_id'] = $id;
        $al_map['status'] = 4;// 提现成功
        $al_map['auth_way'] = 0;
        $al_map['type'] = 2;
        $al_with_money = db('auth_withdraw')->where($al_map)->value("sum(money)");

        $this->assign('revenue',(float)$revenue['revenue']);// 费率
        $this->assign('money',(float)$revenue['money']);// 可提现金额

        $this->assign('no_money',$no_money ? : "0.00");// 未结算金额
        $this->assign('yes_money',$yes_money ? : "0.00");// 已结算金额
        $this->assign('al_with_money',$al_with_money ? : '0.00');// 已提现金额
        return $this->fetch();
    }

    //H5提现记录页
    public function h5_index(){
        // 提现费率和可提现金额
        $map['p.id'] = session('promote_auth')['id'];
        $revenue = db('promote')
            ->alias('p')
            ->field('h5_revenue revenue, h5_money money')
            ->join('promote_level l', 'p.level_id = l.id', 'left')
            ->where($map)
            ->find();
        $revenue = $revenue ? $revenue : 0;

        $id = session('promote_auth')['id'];

        //未结算金额
        $no_map['promote_id'] = $id;
        $no_map['pay_status'] = 1;// 支付成功
        $no_map['status'] = 0;// 未结算
        $no_map['pay_way'] = ['in','4,5,6'];
        $no_money = db('promote_deposit')->where($no_map)->value("sum(pay_amount) pay_amount");

        //已结算金额
        $yes_map['promote_id'] = $id;
        $yes_map['pay_status'] = 1;// 支付成功
        $yes_map['status'] = 1;// 已结算
        $yes_map['pay_way'] = ['in','4,5,6'];
        $yes_money = db('promote_deposit')->where($yes_map)->value("sum(pay_amount) pay_amount");

        //已提现
        $al_map['promote_id'] = $id;
        $al_map['status'] = 4;// 提现成功
        $al_map['auth_way'] = 1;
        $al_with_money = db('auth_withdraw')->where($al_map)->value("sum(money)");

        $this->assign('revenue',(float)$revenue['revenue'] ? : '0.00');// 费率
        $this->assign('money',(float)$revenue['money'] ? : '0.00');// 可提现金额

        $this->assign('no_money',$no_money ? : '0.00');// 未结算金额
        $this->assign('yes_money',$yes_money ? : '0.00');// 已结算金额
        $this->assign('al_with_money',$al_with_money ? : '0.00');// 已提现金额
        return $this->fetch();
    }

    /**
     * test [提现记录列表]
     *
     * author dear
     * @return array
     */
    public function test()
    {
        // 分页数据
        $page  = input('get.page');
        $limit = input('get.limit');
        $page = ($page - 1) * $limit;
        // 搜索数据
        $map = [];
        $start = input('start') ? strtotime(input('start')) : '';
        $end = input('end') ? strtotime(input('end'))+86399 : '';
        if($start && $end){
            $map['w.ctime'] = ['between time', [$start, $end]];
        }elseif($start){
            $map['w.ctime'] = ['>=', $start];
        }elseif($end){
            $map['w.ctime'] = ['<=', $end];
        }
        if(input('status') !== null){
            $map['w.status'] = input('status');
        }
        $map['w.promote_id'] = session('promote_auth')['id'];
        $map['w.auth_way'] = 0;
        $map['w.type'] = 1;

        $field = "p.account,w.id,w.money,p_l.revenue,w.actual_money,w.ctime,w.status,w.audit_time,w.bank_id,b.bank_name,b.bank_number";
        $withdraw = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.promote_id = p.id', 'left')
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where($map)
            ->limit($page, $limit)
            ->select();
        if(!$withdraw){
            return ['code' => 0, 'msg' => '没有数据'];
        }
        $count = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.bank_id = p.id', 'left')
            ->where($map)
            ->count();

        // 数据处理
        foreach($withdraw as $k => &$v){
            $v['key'] = $k + 1;
            $v['revenue'] = (float)$v['revenue'];
            $v['bank_title']   = getIdBankName($v['bank_id']);
            $v['ctime'] = $v['ctime'] ? date('Y-m-d H:i:s',$v['ctime']) : '';
            $v['audit_time'] =$v['audit_time'] ? date('Y-m-d H:i:s',$v['audit_time']) : '';
            $v['status'] = $this->status($v['status']);
        }
        return ['code' => 0, 'msg' => '', 'data' => $withdraw, 'count' => $count];
    }

    /**
     * test [提现记录列表]
     *
     * author dear
     * @return array
     */
    public function todayWithData()
    {

        // 分页数据
        $page  = input('get.page');
        $limit = input('get.limit');
        $page = ($page - 1) * $limit;
        // 搜索数据
        $map = [];
        $start = input('start') ? strtotime(input('start')) : '';
        $end = input('end') ? strtotime(input('end'))+86399 : '';
        if($start && $end){
            $map['w.ctime'] = ['between time', [$start, $end]];
        }elseif($start){
            $map['w.ctime'] = ['>=', $start];
        }elseif($end){
            $map['w.ctime'] = ['<=', $end];
        }
        if(input('status') !== null){
            $map['w.status'] = input('status');
        }
        $map['w.promote_id'] = session('promote_auth')['id'];
        $map['w.auth_way'] = 0;
        $map['w.type'] = 2;

        $field = "p.account,w.id,w.money,p_l.revenue,w.actual_money,w.ctime,w.status,w.audit_time,w.bank_id,b.bank_name,b.bank_number";
        $withdraw = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.promote_id = p.id', 'left')
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where($map)
            ->limit($page, $limit)
            ->select();
        if(!$withdraw){
            return ['code' => 0, 'msg' => '没有数据'];
        }
        $count = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.bank_id = p.id', 'left')
            ->where($map)
            ->count();

        // 数据处理
        foreach($withdraw as $k => &$v){
            $v['key'] = $k + 1;
            $v['revenue'] = (float)$v['revenue'];
            $v['bank_title']   = getIdBankName($v['bank_id']);
            $v['ctime'] = $v['ctime'] ? date('Y-m-d H:i:s',$v['ctime']) : '';
            $v['audit_time'] =$v['audit_time'] ? date('Y-m-d H:i:s',$v['audit_time']) : '';
            $v['status'] = $this->status($v['status']);
        }
        return ['code' => 0, 'msg' => '', 'data' => $withdraw, 'count' => $count];
    }

    /**
     * test [提现记录列表]
     *
     * author dear
     * @return array
     */
    public function h5_test()
    {
        // 分页数据
        $page  = input('get.page');
        $limit = input('get.limit');
        $page = ($page - 1) * $limit;
        // 搜索数据
        $map = [];
        $start = input('start') ? strtotime(input('start')) : '';
        $end = input('end') ? strtotime(input('end'))+86399 : '';
        if($start && $end){
            $map['w.ctime'] = ['between time', [$start, $end]];
        }elseif($start){
            $map['w.ctime'] = ['>=', $start];
        }elseif($end){
            $map['w.ctime'] = ['<=', $end];
        }
        if(input('status') !== null){
            $map['w.status'] = input('status');
        }
        $map['w.promote_id'] = session('promote_auth')['id'];
        $map['w.auth_way'] = 1;

        $field = "p.account,w.id,w.money,p_l.revenue,w.actual_money,w.ctime,w.status,w.audit_time,w.bank_id,b.bank_name,b.bank_number";
        $withdraw = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.promote_id = p.id', 'left')
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where($map)
            ->limit($page, $limit)
            ->select();
        if(!$withdraw){
            return ['code' => 0, 'msg' => '没有数据'];
        }
        $count = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.bank_id = p.id', 'left')
            ->where($map)
            ->count();

        // 数据处理
        foreach($withdraw as $k => &$v){
            $v['key'] = $k + 1;
            $v['revenue'] = (float)$v['revenue'];
            $v['bank_title']   = getIdBankName($v['bank_id']);
            $v['ctime'] = $v['ctime'] ? date('Y-m-d H:i:s',$v['ctime']) : '';
            $v['audit_time'] =$v['audit_time'] ? date('Y-m-d H:i:s',$v['audit_time']) : '';
            $v['status'] = $this->status($v['status']);
        }
        return ['code' => 0, 'msg' => '', 'data' => $withdraw, 'count' => $count];
    }

    /**
     * detail [提现管理详情]
     *
     * author dear
     * @return mixed
     */
    public function detail()
    {
        $map['w.id'] = input('id');
        $map['w.promote_id'] = session('promote_auth')['id'];
        $field = "p.account,p.nickname,w.id,w.money,p_l.revenue,w.ctime,w.status,w.audit_time,w.rate,w.actual_money,b.bank_name,b.sub_branch,b.bank_number,b.bank_user";
        $info = db('auth_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.promote_id = p.id', 'left')
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where($map)
            ->find();

        // 数据处理
        $info['status'] = $this->status($info['status']);
        $info['revenue'] = (float)$info['revenue'];
        $info['ctime'] = $info['ctime'] ? date('Y-m-d H:i:s',$info['ctime']) : '';
        $info['audit_time'] = $info['audit_time'] ? date('Y-m-d H:i:s',$info['audit_time']) : '';
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * accounts [结算]
     *
     * author dear
     * @return mixed
     */
    public function accounts()
    {
        $id = session('promote_auth')['id'];
        $begintime=strtotime(date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y'))));

        // 当前商户充值金额
        $p_field = 'id,pay_amount';
        $p_data = db('promote_deposit')
            ->field($p_field)
            ->where('promote_id',$id)
            ->where('pay_status',1)// 支付成功
            ->where('status',0)// 未结算
            ->where('pay_way','in','1,2,3')
            ->where('pay_type','neq',2)
            ->where('create_time','<=',$begintime)
            ->select();
        if(!$p_data){
            return ['code' => 1, 'msg' => '没有可以结算的订单'];
        }

        // 结算处理
        \think\Db::startTrans();
        foreach($p_data as $key => $val){
            $p_id = $val['id'];
            $money = $val['pay_amount'];

            // 商户表金额增加
            $pro_data['money'] = ['exp', 'money+'.$money];
            $pro_data['total_money'] = ['exp', 'total_money+'.$money];
            $pro_inc = db('promote')->where("id", $id)->update($pro_data);

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
    }

    /**
     * accounts [结算]
     *
     * author dear
     * @return mixed
     */
    public function todaySett()
    {
        $id = session('promote_auth')['id'];
        $begintime=strtotime(date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y'))));

        // 当前商户充值金额
        $p_field = 'id,pay_amount';
        $p_data = db('promote_deposit')
            ->field($p_field)
            ->where('promote_id',$id)
            ->where('pay_status',1)// 支付成功
            ->where('status',0)// 未结算
            ->where('pay_way','in','1,2,3')
            ->where('pay_type','eq',2)
            //->where('create_time','<=',$begintime)
            ->select();
        if(!$p_data){
            return ['code' => 1, 'msg' => '没有可以结算的订单'];
        }

        \think\Db::startTrans();
        $money = 0;
        foreach($p_data as $key => $val){
            $money += $val['pay_amount'];

            $p_map['id'] = $val['id'];
            $p_updata['status'] = 1;
            $p_up = db('promote_deposit')->where($p_map)->update($p_updata);
        }
        $pro_inc = db('promote')->where("id", $id)->setInc('t0_money',$money);
        $pro_inc = db('promote')->where("id", $id)->setInc('t0_total_money',$money);

        // 结算日志
        $logcotent = 'ID为： '.$id.' 的用户结算了一笔T0订单，结算金额为 '. $money;
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
        }else{
            \think\Db::commit();
            return ['code' => 0, 'msg' => '结算成功，现在可以提现啦'];
        }
    }

    /**
     * accounts [H5结算]
     *
     * author dear
     * @return mixed
     */
    public function haccounts()
    {
        $id = session('promote_auth')['id'];
        $begintime=strtotime(date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y'))));

        // 当前商户充值金额
        $p_field = 'id,pay_amount';
        $p_data = db('promote_deposit')
            ->field($p_field)
            ->where('promote_id',$id)
            ->where('pay_status',1)// 支付成功
            ->where('status',0)// 未结算
            ->where('pay_way','in','4,5,6')
            ->where('create_time','<=',$begintime)
            ->select();
        if(!$p_data){
            return ['code' => 1, 'msg' => '没有可以结算的订单'];
        }

        // 结算处理
        \think\Db::startTrans();
        foreach($p_data as $key => $val){
            $p_id = $val['id'];
            $money = $val['pay_amount'];

            // 商户表金额增加
            $pro_inc = db('promote')->where("id", $id)->setInc('h5_money',$money);
            $pro_inc = db('promote')->where("id", $id)->setInc('h5_total_money',$money);
//            $pro_data['h5_money'] = ['exp', 'h5_money+'.$money];
//            $pro_data['h5_total_money'] = ['exp', 'h5_total_money+'.$money];
//            $pro_inc = db('promote')->where("id", $id)->update($pro_data);

            // 充值表结算
            $p_map['id'] = $p_id;
            $p_updata['status'] = 1;
            $p_up = db('promote_deposit')->where($p_map)->update($p_updata);

            // 结算日志
            $logcotent = 'ID为： '.$id.' 的用户结算了一次H5订单，结算金额为 '. $money;
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
    }

    /**
     * withdraw [提现申请]
     *
     * author dear
     */
    public function applyFor()
    {
        // 当前账号资金数据
        $field = 'p.*,p_l.level,p_l.revenue';
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
            if($money > $applyFor['money']){
                return ['code' => 3, 'msg' => '余额不足!'];
            }

            // 发起提现
            \think\Db::startTrans();
            // 余额扣款
            $promote_dec = db('promote')->where("id",$account)->setDec('money', $money);

            // 添加提现申请记录
            $w_data = [
                'promote_id' => $account,
                'money' => $money,
                'ctime' => time(),
                'status' => 0,
                'bank_id' => $bankid,
                'rate' => $applyFor['revenue'],
                'actual_money' => $money - $money * $applyFor['revenue']
            ];
            $withdraw_ins = db('auth_withdraw')->where("promote_id", $account)->insert($w_data);

            // 提现log
            $bank_info = db('binding_bank')->field($b_field)->where("bank_id",$bankid)->find();
            $logcotent = '提现申请： ID为 '.$applyFor['id'].' 的用户发起了一笔提现申请，提现金额为 '. $money .'，手续费率为 ' . $applyFor['revenue'] . ' ， 实际到账金额为 '. $w_data['actual_money']  . ' ，收款账号为： '.$bank_info['bank_name']. ' '.$bank_info['bank_number'];
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
        return $this->fetch();
    }

    /**
     * withdraw [T0提现申请]
     *
     * author dear
     */
    public function applyTfor()
    {
        // 当前账号资金数据
        $field = 'p.*,p_l.level,p_l.revenue';
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
            if($money > $applyFor['t0_money']){
                return ['code' => 3, 'msg' => '余额不足!'];
            }

            // 发起提现
            \think\Db::startTrans();
            // 余额扣款
            $promote_dec = db('promote')->where("id",$account)->setDec('t0_money', $money);

            // 添加提现申请记录
            $w_data = [
                'promote_id' => $account,
                'money' => $money,
                'ctime' => time(),
                'status' => 0,
                'type' => 2,
                'bank_id' => $bankid,
                'rate' => $applyFor['revenue'],
                'actual_money' => $money - $money * $applyFor['revenue']
            ];
            $withdraw_ins = db('auth_withdraw')->where("promote_id", $account)->insert($w_data);

            // 提现log
            $bank_info = db('binding_bank')->field($b_field)->where("bank_id",$bankid)->find();
            $logcotent = '提现申请： ID为 '.$applyFor['id'].' 的用户发起了一笔提现申请，提现金额为 '. $money .'，手续费率为 ' . $applyFor['revenue'] . ' ， 实际到账金额为 '. $w_data['actual_money']  . ' ，收款账号为： '.$bank_info['bank_name']. ' '.$bank_info['bank_number'];
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
        return $this->fetch();
    }

    /**
     * withdraw [提现申请]
     *
     * author dear
     */
    public function applyHFor()
    {
        // 当前账号资金数据
        $field = 'p.*,p_l.level,p_l.h5_revenue revenue';
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
            if($money > $applyFor['h5_money']){
                return ['code' => 3, 'msg' => '余额不足!'];
            }

            // 发起提现
            \think\Db::startTrans();
            // 余额扣款
            $promote_dec = db('promote')->where("id",$account)->setDec('h5_money', $money);

            // 添加提现申请记录
            $w_data = [
                'promote_id' => $account,
                'money' => $money,
                'ctime' => time(),
                'status' => 0,
                'bank_id' => $bankid,
                'rate' => $applyFor['revenue'],
                'auth_way' => 1,
                'actual_money' => $money - $money * $applyFor['revenue']
            ];
            $withdraw_ins = db('auth_withdraw')->where("promote_id", $account)->insert($w_data);

            // 提现log
            $bank_info = db('binding_bank')->field($b_field)->where("bank_id",$bankid)->find();
            $logcotent = '提现申请： ID为 '.$applyFor['id'].' 的用户发起了一笔H5提现申请，提现金额为 '. $money .'，手续费率为 ' . $applyFor['revenue'] . ' ， 实际到账金额为 '. $w_data['actual_money']  . ' ，收款账号为： '.$bank_info['bank_name']. ' '.$bank_info['bank_number'];
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
        return $this->fetch();
    }

    /**
     * status [状态转换]
     *
     * author dear
     * @param $val
     * @return string
     */
    private function status($val)
    {
        switch ($val) {
            case 0;
                $res = '待审核';
                break;
            case 1;
                $res = '审核不通过';
                break;
            case 2;
                $res = '审核通过';
                break;
            case 3;
                $res = '打款中';
                break;
            case 4;
                $res = '提现完成';
                break;
        }
        return $res;
    }

    //查询用户是否设置提现密码
    public function isPass(){
        $id = session('promote_auth')['id'];
        $paypass = db('promote')->where("id=".$id)->value('pay_pass');
        if($paypass){
            return [
                'code' => 1,
            ];
        }else{
            return [
                'code' => 0,
            ];
        }
    }

    //设置提现密码
    public function setPass(){
        if(!request()->isPost()){
            return $this->fetch();
        }else{
            $id = session('promote_auth')['id'];
            $pass = input('post.pay_pass');
            $result = db('promote')->where("id=".$id)->update(['pay_pass' => think_ucenter_md5($pass,self::DATA_AUTH_KEY)]);
            if($result){
                return [
                    'code' => 1,
                    'msg'  => '密码设置成功'
                ];
            }else{
                return [
                    'code' => 0,
                    'msg'  => '密码设置失败'
                ];
            }
        }

    }

}

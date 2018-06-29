<?php
/**
 * Created by PhpStorm.
 * Author: Administrator
 * Date: 2018/3/21
 * Time: 18:59
 */

namespace app\index\controller;
use think\Db;

//从2018年06月15号开始，狼下边的小华，每日给狼的佣金充值额减去200000
class Recommend extends \app\common\controller\Base
{
    const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';
    public function index()
    {
        return $this->fetch();
    }

    /**
     * getList [列表页]
     *
     * author dear
     * @return array
     */
    public function getList()
    {
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        // 分页数据
        $page  = input('get.page');
        $limit = input('get.limit');
        $page = ($page - 1) * $limit;

        $field = 'id,account,nickname,mobile_phone,money,total_money,create_time';

        // 数据搜索
        $map = [];
        if(input('account')){
            $map['account'] = input('account');
        }
        if(input('nickname')){
            $map['nickname'] = input('nickname') ?? '';
        }
        if(input('mobile_phone')){
            $map['mobile_phone'] = input('mobile_phone') ?? '';
        }
        $map['referee_id'] = session('promote_auth')['id'];


        $data = db('promote')->field($field)->where($map)->limit($page, $limit)->select();
        $count = db('promote')->field($field)->where($map)->count();
        if(!$data){
            return ['code' => 0, 'msg' => '没有数据'];
        }
        // 数据处理
        foreach($data as $key=>&$val){
            $val['key'] = $key + 1;
            if($val['account'] == 'ZB1524719969'){
                $all_rec_data = $this->setYong($val['id']);
                $val['all_rec_data'] = $all_rec_data['all_money'];
                       
            }else{
                 $val['all_rec_data'] = db('promote_deposit')->where("pay_status=1 and promote_id=".$val['id']." and pay_way in (4,5)")->value("sum(pay_amount) all_pay_amount") ? : '0.00';
            }
           
            $val['today_rec_data'] = db('promote_deposit')->where("pay_status=1 and promote_id=".$val['id']." and pay_way in (4,5) and create_time >= ".$beginToday." and create_time <=".$endToday)->value("sum(pay_amount) all_pay_amount") ? : '0.00';
            $val['create_time'] = $val['create_time'] ? date('Y-m-d H:i:s', $val['create_time']) : null;
        }
        return ['code' => 0, 'msg' => '', 'data' => $data, 'count' => $count];
    }

    public function setYong($id){
        $today = date("Y-m-d",time()-86400) . " 23:59:59";
        $today = strtotime($today);
        $all_where = "pay_status=1 and promote_id = ".$id." and pay_way in (4,5)";
        $where = "pay_status=1 and comm_with_status=0 and promote_id = ".$id." and pay_way in (4,5)  and create_time <= ".$today;

        $all_rec_data = db('promote_deposit')->where($where)->value("sum(pay_amount)");
        $all_rec_money = db('promote_deposit')->where($all_where)->value("sum(pay_amount)");
        if($all_rec_data >= 1000000){
            $diff = 200000;
        }else{
            if($all_rec_data < 1000000 && $all_rec_data >= 500000){
                $diff = 100000;
            }else if($all_rec_data < 500000 && $all_rec_data >= 200000){
                $diff = 10000;
            }else{
                $diff = 0;
            }
            
        }
        $data['money'] = $all_rec_data - $diff;
        $data['all_money'] = $all_rec_money - $diff;
        return $data;
    }

    //下游充值记录
    public function downstream(){
        $id = session('promote_auth')['id'];
        //查询当前商户的佣金提现额
        $profit = db('promote')->where("id",$id)->value("profit_money");

        //查询当前商户的佣金提现费率
        $level_id = db('promote')->where("id",$id)->value("level_id");
        $comm_revenue = db("promote_level")->where("id",$level_id)->value('comm_revenue');

        //获取下游的充值总和
        //1，查询当前商户下所有下游的商户ID
        $where   = "referee_id = " . $id;

        $downUser = db('promote')->field('id,account')->where($where)->select();
        $str_id = '';
        $money = 0;
        $sure_all = 0;
        foreach ($downUser as $key=>$val) {
            $str_id .= $val['id'] . ",";
            $where = "pay_status=1 and promote_id = ".$val['id']." and pay_way in (4,5)";
            if($downUser[$key]['account'] == 'ZB1524719969'){
                $data = $this->setYong($val['id']);
                $downUser[$key]['money'] = $data['all_money'];
                $downUser[$key]['sure_all'] = $data['money'];
            }else{
                $downUser[$key]['money'] = db('promote_deposit')->where($where)->value("sum(pay_amount)");
                $downUser[$key]['sure_all'] = db('promote_deposit')->where($where." and comm_with_status=0")->value("sum(pay_amount)");
            }
            

            $money += $downUser[$key]['money'];
            $sure_all += $downUser[$key]['sure_all'];
        }
        $rec_all = $money;
        $sure_all =$sure_all;
        // echo $money;
        // var_dump($downUser);
        //exit;
        if($str_id != ''){
            $str_id = substr($str_id,0,-1);
            $where = "pay_status=1 and promote_id in (".$str_id.") and pay_way in (4,5)";

            //2，查询所有下游的充值订单数
            $rec_count = db('promote_deposit')->where($where)->count();
            //查询来自所有下游的可提现佣金的总额
            //$sure_all = db('promote_deposit')->where($where." and comm_with_status=0")->value("sum(pay_amount)");

            //查询来自所有下游的已提现佣金的总额
            $already_all = db('promote_deposit')->where($where." and comm_with_status=1")->value("sum(pay_amount)");

        }else{
            $rec_all = 0;
            $rec_count = 0;
            $sure_all = 0;
            $already_all = 0;
        }

        $this->assign('profit',$profit ? : '0.00');
        $this->assign('rec_all',$rec_all ? : '0.00');
        $this->assign('rec_count',$rec_count);
        $this->assign('sure_all',$sure_all ? : '0.00');
        $this->assign('already_all',$already_all ? : '0.00');
        $this->assign('comm_revenue',$comm_revenue);
        $this->assign('downUser',$downUser);
        return $this->fetch();
    }

    public function getAll(){
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
            $pid = input('get.pid');
//            $pay_status = input('get.pay_status');
//            $status  = input('get.status');
            //查询当前商户下的所有下游
            $where   = "referee_id = " . session('promote_auth')['id'];
            $downUser = db('promote')->field('id')->where($where)->select();
            $str_id = '';
            foreach ($downUser as $key=>$val) {
                $str_id .= $val['id'] . ",";
            }

            if($str_id != ''){
                $str_id = substr($str_id,0,-1);
                $str_where = "pd.pay_status=1 and pd.pay_way in (4,5)";
                if($pid){
                    $re_id = db('promote')->field('id,referee_id')->where("id='".$pid."'")->find();
                    if($re_id['referee_id'] == session('promote_auth')['id']){
                        $str_where .= " and pd.promote_id=".$re_id['id'];
                    }else{
                        return [
                            'code' => 1,
                            'msg'  => '没有数据'
                        ];
                    }
                }else{
                    $str_where .= " and pd.promote_id in (".$str_id.")";
                }

                if (!empty($sta) && !empty($end)) {
                    $str_where .= ' and (pd.create_time > ' . $sta . ' and pd.create_time <' . $end . ")";
                }else{
                    if(!empty($sta) && empty($end)){
                        $str_where .= ' and pd.create_time > ' . $sta;
                    }
                    if(empty($sta) && !empty($end)){
                        $str_where .= ' and pd.create_time <' . $end;
                    }
                }

                //---------------END--------------//
                $data  = db('promote_deposit')
                    ->alias('pd')
                    ->field('sum(pd.pay_amount) all_pay')
                    ->join('promote p','p.id=pd.promote_id')
                    ->where($str_where)
                    ->find();
                echo $str_where;
                if (!empty($data)) {
                    return [
                        'code'  => 1,
                        'all_pay'  => $data['all_pay'] ? $data['all_pay'] : '0.00'
                    ];
                } else {
                    return [
                        'code' => 0,
                        'msg'  => '没有数据'
                    ];
                }

            }else{
                return [
                    'code' => 1,
                    'msg'  => '没有数据'
                ];
            }

        }
    }

    //获取下游充值记录数据
    public function getDownstream(){
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
            $pid = input('get.pid');
//            $pay_status = input('get.pay_status');
//            $status  = input('get.status');
            //查询当前商户下的所有下游
            $where   = "referee_id = " . session('promote_auth')['id'];
            $downUser = db('promote')->field('id')->where($where)->select();
            $str_id = '';
            foreach ($downUser as $key=>$val) {
                $str_id .= $val['id'] . ",";
            }

            if($str_id != ''){
                $str_id = substr($str_id,0,-1);
                $str_where = "pd.pay_status=1  and pay_way in (4,5)";
                if($pid){
                    $re_id = db('promote')->field('id,referee_id')->where("id='".$pid."'")->find();
                    if($re_id['referee_id'] == session('promote_auth')['id']){
                        $str_where .= " and pd.promote_id=".$re_id['id'];
                    }else{
                        return [
                            'code' => 1,
                            'msg'  => '没有数据'
                        ];
                    }
                }else{
                    $str_where .= " and pd.promote_id in (".$str_id.")";
                }

                if (!empty($sta) && !empty($end)) {
                    $str_where .= ' and (pd.create_time > ' . $sta . ' and pd.create_time <' . $end . ")";
                }else{
                    if(!empty($sta) && empty($end)){
                        $str_where .= ' and pd.create_time > ' . $sta;
                    }
                    if(empty($sta) && !empty($end)){
                        $str_where .= ' and pd.create_time <' . $end;
                    }
                }

                //---------------END--------------//
                $data  = db('promote_deposit')
                    ->alias('pd')
                    ->field('pd.*,p.account,p.id')
                    ->join('promote p','p.id=pd.promote_id')
                    ->where($str_where)
                    ->order('pd.comm_with_status asc')
                    ->limit($sPage, $limit)
                    ->select();
                $count = db('promote_deposit')
                    ->alias('pd')
                    ->field('pd.*,p.account,p.id')
                    ->join('promote p','p.id=pd.promote_id')
                    ->where($str_where)
                    ->count();
                if (!empty($data)) {
                    foreach ($data as $k => &$v) {
                        $v['order_number']      = $v['order_number'];
                        $v['pay_order_number']  = $v['pay_order_number'];
                        $v['promote_account']   = $v['promote_account'];
                        $v['pay_amount']        = number_format($v['pay_amount'],2);
                        $v['pay_status']        = getPayStatus($v['pay_status']);
                        $v['pay_way']           = getPayType($v['pay_way']);
                        $v['pay_ip']            = $v['pay_ip'];
                        $v['comm_with_status']  = $v['comm_with_status'] ? '是' : '否';
                        $v['create_time']       = $v['create_time'] ? date('Y-m-d H:i:s', $v['create_time']) : '';
                        $v['key']               = $k + 1;
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
            }else{
                return [
                    'code' => 1,
                    'msg'  => '没有数据'
                ];
            }

        }
    }

    //商户可提现佣金
    public function commWith(){
        //查询下游是否有充值记录
        $id = session('promote_auth')['id'];
        $where   = "referee_id = " . $id;
        $downUser = db('promote')->field('id,account')->where($where)->select();
        $str_id = '';
        $money = 0;
        $rec_all= 0;
        $today = date("Y-m-d",time()-86400) . " 23:59:59";
        $today = strtotime($today);
        foreach ($downUser as $key=>$val) {
            $str_id .= $val['id'] . ",";
            $where = "pay_status=1 and comm_with_status=0 and promote_id = ".$val['id']." and pay_way in (4,5)  and create_time <= ".$today;
            if($downUser[$key]['account'] == 'ZB1524719969'){
                $data = $this->setYong($val['id']);
                $downUser[$key]['money'] = $data['all_money'];
                $downUser[$key]['sure_all'] = $data['money'];
            }else{
                $downUser[$key]['money'] = db('promote_deposit')->where($where)->value("sum(pay_amount)");
                $downUser[$key]['sure_all'] = db('promote_deposit')->where($where." and comm_with_status=0")->value("sum(pay_amount)");
            }
            

            $money += $downUser[$key]['money'];
            $rec_all += $downUser[$key]['sure_all'];
        }
        //获取当天的起始时间
        $today = date("Y-m-d",time()-86400) . " 23:59:59";
        $today = strtotime($today);
        if($str_id != ''){
            $str_id = substr($str_id,0,-1);
            $where = "pay_status=1 and comm_with_status=0 and promote_id in (".$str_id.")  and pay_way in (4,5) and create_time <= ".$today;
            //$rec_all = db('promote_deposit')->where($where)->value("sum(pay_amount)");
            //下游的商户充值明细
            $rec_all_data = db('promote_deposit')
                ->field("promote_id,sum(pay_amount) pay_amount,promote_account")
                ->where($where)
                ->group('promote_id')
                ->select();
            foreach ($rec_all_data as $key => $value) {
                if($rec_all_data[$key]['promote_account'] == 'ZB1524719969'){
                    $data = $this->setYong($value['promote_id']);
                    $rec_all_data[$key]['pay_amount'] = $data['money'];
                }
            }
        }else{
            $where = "pay_status=1 and comm_with_status=0 and pay_way in (4,5)";
            //$rec_all = 0;
            $rec_all_data = [];
        }

        if(!request()->isPost()){
            //查询当前商户的佣金提现费率
            $level_id = db('promote')->where("id",$id)->value("level_id");
            $comm_revenue = db("promote_level")->where("id",$level_id)->value('comm_revenue');
            $actual_with = $rec_all * $comm_revenue;

            // 收款银行卡数据
            $b_field = 'bank_id,bank_name,bank_number';
            $bank_card = db('binding_bank')->field($b_field)->where("promote_id=".$id." and status != 2")->select();
            foreach ($bank_card as $key => $value) {
                $bank_card[$key]['title'] = getBankName($value['bank_name']);
            }


            $this->assign('comm_revenue',$comm_revenue);
            $this->assign('rec_all_data',$rec_all_data);
            $this->assign('actual_with',sprintf("%.2f", $actual_with));
            $this->assign('rec_all',$rec_all ? : 0);
            $this->assign('bank_card', $bank_card);
            return $this->fetch();
        }else{
            $is_with = $this->is_with();
            if($is_with['code'] == 0){
                return ['code' => 0, 'msg' => $is_with['msg']];
            }
            $id = session('promote_auth')['id'];
            $pay_pass = input('pay_pass');
            $bankid = input('bank_id');

            if($pay_pass){
                $pro_pass = db('promote')->where("id",$id)->value('pay_pass');
                if($pro_pass != think_ucenter_md5($pay_pass,self::DATA_AUTH_KEY)){
                    return ['code' => 0, 'msg' => '提现密码错误!'];
                }
            }

            $p_data = db('promote_deposit')->where($where)->select();
            if(!$p_data){
                return ['code' => 0, 'msg' => '没有可以提现佣金的订单'];
            }

            $is_with = $this->is_with();

            if($is_with){
                $rec_all = db('promote_deposit')->where($where)->value("sum(pay_amount)");

                $p_id = '';
                foreach($p_data as $key => $val){
                    $p_id .= $val['id'].",";
                }
                $p_id = substr($p_id,0,-1);
                $p_up = db('promote_deposit')->where("id in (".$p_id.")")->update(['comm_with_status'=>1]);
                // 添加提现申请记录
                $w_data = [
                    'promote_id' => $id,
                    'money' => $rec_all,
                    'ctime' => time(),
                    'status' => 0,
                    'bank_id' => $bankid,
                    'rate' => $_POST['rate'],
                    'actual_money' => $_POST['actual_money']
                ];
                $withdraw_ins = db('profit_withdraw')->insertGetId($w_data);
                $logcotent = 'ID为： '.$id.' 的用户操作佣金提现，提现金额为 '. $rec_all;
                $log_data = [
                    'pid' => $id,
                    'content' => $logcotent,
                    'login_ip' => $this->request->ip(),
                    'time' => time(),
                ];
                $log_ins = rwLog($log_data);
                if($p_up || $withdraw_ins || $log_ins){
                    return ['code' => 1, 'msg' => '提现成功，请等待审核'];
                }else{
                    return ['code' => 1, 'msg' => '提现失败，请稍后再试'];
                }
            }
        }
    }

    //查询商户是否可提现佣金
    public function is_with(){
        //查询下游是否有充值记录
        $where   = "referee_id = " . session('promote_auth')['id'];
        $downUser = db('promote')->field('id')->where($where)->select();
        $str_id = '';
        foreach ($downUser as $key=>$val) {
            $str_id .= $val['id'] . ",";
        }
        $str_id = substr($str_id,0,-1);
        $where = "pay_status=1 and promote_id in (".$str_id.") and pay_way in (4,5)";
        $count = db('promote_deposit')->where($where)->count();
        if(!$count){
            return [
                'code' => 0,
                'msg'  => '没有可以提现的佣金'
            ];
        }else{
            //查询是否有佣金提现记录
            $profit_with = db("profit_withdraw")->where('promote_id',session('promote_auth')['id'])->count();
            if($profit_with){
                $level_id = db("promote")->where("id",session('promote_auth')['id'])->value('level_id');
                $with_cycle = db("promote_level")->where("id",$level_id)->value('with_cycle');

                //查询上一次是的提现记录
                $last_with = db('profit_withdraw')->where('status != 1 and promote_id',session('promote_auth')['id'])->order('id desc')->find();
                $time_diff = (time() - $last_with['ctime']) / 86400;
                if($time_diff >= $with_cycle){
                    return [
                        'code' => 1,
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg'  => '提现周期未到，离下次提现还有'.intval($with_cycle - $time_diff)."天"
                    ];
                }
            }else{
                return [
                    'code' => 1,
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
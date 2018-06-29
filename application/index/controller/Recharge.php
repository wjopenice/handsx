<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/3/15
 * Time: 13:37
 */

namespace app\index\controller;

use app\common\controller\Base;
use think\Config;
use lib\Excel;

class Recharge extends Base {

    //充值页
    public function index(){
        //查询商户当前可提现金额和充值总金额
        $pid = get_pro_id();
        $pro_price = db('promote')->where("id=".$pid)->find();

        $this->assign('money',$pro_price['money'] ? $pro_price['money'] : '0.00');
        $this->assign('total_money',$pro_price['total_money'] ? $pro_price['total_money'] : '0.00');
        //查询商户当日充值额和提现额
        $now_time = strtotime(date("Y-m-d",time()) . " 00:00:00");
        //充值额
        $recharge = db('promote_deposit')->where("promote_id=". $pid ." and create_time > ".$now_time)->value("sum(pay_amount)");
        //提现额
        $with = db('auth_withdraw')->where("promote_id=".$pid ." and audit_time > ".$now_time)->value("sum(money)");

        //订单总笔数
        $all_count = db('promote_deposit')->where("promote_id=".$pid)->count();
        //订单总金额
        $sum_money = db('promote_deposit')->where("promote_id=".$pid)->value("sum(pay_amount)");
        //订单成功数
        $success_count = db('promote_deposit')->where("promote_id=".$pid." and pay_status=1")->count();
        //订单成功总金额
        $success_money = db('promote_deposit')->where("promote_id=".$pid." and pay_status=1")->value("sum(pay_amount)");
        //订单失败数
        $error_count = db('promote_deposit')->where("promote_id=".$pid." and pay_status=0")->count();
        //订单失败总金额
        $error_money = db('promote_deposit')->where("promote_id=".$pid." and pay_status=0")->value("sum(pay_amount)");

        $this->assign('recharge',$recharge ? $recharge : '0.00');
        $this->assign('with',$with ? $with : '0.00');

        $this->assign('all_count',$all_count);
        $this->assign('sum_money',$sum_money ? number_format($sum_money,2) : '0.00');
        $this->assign('success_count',$success_count);
        $this->assign('success_money',$success_money ? $success_money : '0.00');
        $this->assign('error_count',$error_count);
        $this->assign('error_money',$error_money ? number_format($error_money,2) : '0.00');
        return $this->fetch();
    }

    //获取充值页统计数据
    public function getCount(){
        if (!request()->isGet()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {

            //TODO::待加入条件查询
            $sta       = strtotime(input('get.start_time'));
            $end       = strtotime(input('get.first_time'));
            $order_number = input('get.order_number');
            $pay_order_number = input('get.pay_order_number');
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $status  = input('get.status');
            $where   = "pd.promote_id = " . get_pro_id();
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
            if($pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if(isset($status) && $status != '2'){
                $where .= " and pd.status = ".$status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
            }
            //---------------END--------------//
            $data  = db('promote_deposit')
                ->alias('pd')
                ->field('sum(pd.pay_amount) all_pay')
                ->join('promote p','p.id=pd.promote_id')
                ->where($where)
                ->find();
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
        }
    }

    //获取充值页数据
    public function getRecharge(){
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
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $status  = input('get.status');
            $where   = "pd.promote_id = " . get_pro_id();

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
            if(!empty($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if(isset($status) && $status != '2'){
                $where .= " and pd.status = ".$status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
            }
            //---------------END--------------//
            $data  = db('promote_deposit')
                ->alias('pd')
                ->field('pd.*,p.account,p.id pid,p.level_id')
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
                    $v['order_number']      = $v['order_number'];
                    $v['pay_order_number']  = $v['pay_order_number'];
                    $v['promote_account']   = $v['promote_account'];
                    $v['commission']        = getComm($v['level_id'],$v['pay_amount'],$v['pay_way'],$v['pay_status']);
                    $v['comm_money']        = getCommMoney($v['level_id'],$v['pay_amount'],$v['pay_way'],$v['pay_status']);
                    $v['pay_amount']        = number_format($v['pay_amount'],2);
                    $v['pay_status']        = getPayStatus($v['pay_status']);
                    $v['pay_way']           = getPayType($v['pay_way']);
                    $v['pay_ip']            = $v['pay_ip'];
                    $v['status']            = $this->getStatus($v['status']);
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
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $status  = input('get.status');
            $where   = "pd.promote_id = " . get_pro_id();

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
            if(!empty($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if(isset($status) && $status != '2'){
                $where .= " and pd.status = ".$status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
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
            $pay_way = input('get.pay_way');
            $pay_status = input('get.pay_status');
            $where   = "pd.promote_id = " . get_pro_id();
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
            if(!empty($pay_status) && $pay_status != '2'){
                $where .= " and pd.pay_status = ".$pay_status;
            }
            if($pay_way){
                $where .= " and pd.pay_way = " . $pay_way;
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
                        $this->getStatus($or['status']),
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
                '充值类型',
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
                'H'
            ];
            (new Excel())->downExcel($fileName, $fileHead, $list, $letter, 'D');
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
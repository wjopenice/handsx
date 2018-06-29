<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/4/24
 * Time: 14:39
 */
namespace app\index\controller;

use app\common\controller\Base;

class Profit extends Base
{
    public function index(){

        return $this->fetch();
    }

    //获取佣金提现记录
    public function getData(){
        if (!request()->isGet()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {
            $id = session('promote_auth')['id'];
            $page  = input('get.page');
            $limit = input('get.limit');
            $sPage = ($page - 1) * $limit;
            //TODO::待加入条件查询
            $map['pw.promote_id'] = $id;
            $start = input('start') ? strtotime(input('start')) : '';
            $end = input('end') ? strtotime(input('end'))+86399 : '';
            if($start && $end){
                $map['pw.ctime'] = ['between time', [$start, $end]];
            }elseif($start){
                $map['pw.ctime'] = ['>=', $start];
            }elseif($end){
                $map['pw.ctime'] = ['<=', $end];
            }
            if(input('status') !== '' && input('status') !== null){
                $map['pw.status'] = input('status');
            }
            //---------------END--------------//
            $data  = db('profit_withdraw')
                ->alias('pw')
                ->field('pw.*,p.account,p.id pid')
                ->join('promote p','p.id=pw.promote_id')
                ->where($map)
                ->order('pw.id desc')
                ->limit($sPage, $limit)
                ->select();
            $count = db('profit_withdraw')
                ->alias('pw')
                ->join('promote p','p.id=pw.promote_id')
                ->where($map)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['id']   = $v['id'];
                    $v['account'] =  $v['account'];
                    $v['money'] = $v['money'];
                    $v['actual_money'] = $v['actual_money'];
                    $v['rate'] = $v['rate'];
                    $v['bank_id'] = getIdBankName($v['bank_id']);
                    $v['ctime']    = $v['ctime'] ? date('Y-m-d H:i:s', $v['ctime']) : '';
                    $v['audit_time']    = $v['audit_time'] ? date('Y-m-d H:i:s', $v['audit_time']) : '';
                    $v['key']           = $k + 1;
                    $v['status'] = $this->status($v['status']);
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
        $field = "p.account,p.nickname,p_l.comm_revenue,w.*,b.bank_name,b.sub_branch,b.bank_number,b.bank_user";
        $info = db('profit_withdraw')
            ->alias('w')
            ->field($field)
            ->join('binding_bank b', 'w.bank_id = b.bank_id', 'left')
            ->join('promote p', 'w.promote_id = p.id', 'left')
            ->join('promote_level p_l', 'p.level_id = p_l.id', 'left')
            ->where($map)
            ->find();
        // 数据处理
        $info['status'] = $this->status($info['status']);
        $info['bank_name'] = getIdBankName($info['bank_id']);
        $info['ctime'] = $info['ctime'] ? date('Y-m-d H:i:s',$info['ctime']) : '';
        $info['audit_time'] = $info['audit_time'] ? date('Y-m-d H:i:s',$info['audit_time']) : '';
        $this->assign('info',$info);
        return $this->fetch();
    }


}
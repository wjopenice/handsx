<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/3/28
 * Time: 10:38
 */
namespace app\index\controller;

use app\common\controller\Base;
use think\Config;
use lib\Excel;
class Pay extends Base{
    //接口列表
    public function index(){

        return $this->fetch();
    }

    //获取所有接口信息
    public function getIne(){
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

            //---------------END--------------//
            $data  = db('pay_interface')->order('id desc')->limit($sPage, $limit)->select();
            $count = db('pay_interface')->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['pay_title'] =  $v['pay_title'];
                    $v['pay_number'] = $v['pay_number'];
                    $v['pay_appid'] = $v['pay_appid'];
                    $v['pay_cusid'] = $v['pay_cusid'];
                    $v['pay_appkey'] = $v['pay_appkey'];
                    $v['wetch_status'] = $v['wetch_status'];
                    $v['alipay_status'] = $v['alipay_status'];
                    $v['key']           = $k + 1;
                    $v['status'] = $v['status'];
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

    //修改支付接口状态
    public function upStatus(){
        $id  = input('get.id');
        $status = db('pay_interface')->where("id=".$id)->value("status");
        if($status == 1){
            $up_data = [
                'status' => 2,
                'end_time' => time()
            ];
        }else{
            $up_data = [
                'status' => 1,
                'newest_time' => time()
            ];
        }
        db('pay_interface')->where("id=".$id)->update($up_data);
        return [
            'code' => 1,
            'status' => $up_data['status']
        ];
    }

    //修改支付接口中,微信的支付状态
    public function upWetchStatus(){
        $id  = input('get.id');
        $status = db('pay_interface')->where("id=".$id)->value("wetch_status");
        if($status == 1){
            $up_data = [
                'wetch_status' => 0,
                'end_time' => time()
            ];
        }else{

            $up_data = [
                'wetch_status' => 1,
                'newest_time' => time()
            ];
        }
        db('pay_interface')->where("id=".$id)->update($up_data);
        return [
            'code' => 1,
            'wetch_status' => $up_data['wetch_status']
        ];
    }

    //修改支付接口中,支付宝的支付状态
    public function upAlipayStatus(){
        $id  = input('get.id');
        $status = db('pay_interface')->where("id=".$id)->value("alipay_status");
        if($status == 1){
            $up_data = [
                'alipay_status' => 0,
                'end_time' => time()
            ];
        }else{
            $up_data = [
                'alipay_status' => 1,
                'newest_time' => time()
            ];
        }
        db('pay_interface')->where("id=".$id)->update($up_data);
        return [
            'code' => 1,
            'alipay_status' => $up_data['alipay_status']
        ];
    }

    //添加商户
    public function add(){
        if(!request()->isPost()){

            return $this->fetch();
        }else{
            $data = input('post.');

            $re = db('pay_interface')->where("pay_number='".$data['pay_number']."'")->find();

            if($re){
                return [
                    'code' => 1,
                    'msg' => '商户接口已存在'
                ];
                exit;
            }else {
//                if($data['status'] == 1){
//                    $status_find = db('pay_interface')->where("status=1")->find();
//                    if ($status_find) {
//                        return [
//                            'code' => 0,
//                            'msg' => '已有启用接口'
//                        ];
//                        exit;
//                    }
//                }
                $ins_data = [
                    'pay_title' => $data['pay_title'],
                    'pay_number' => $data['pay_number'],
                    'pay_appid' => $data['pay_appid'],
                    'pay_cusid' => $data['pay_cusid'],
                    'pay_appkey' => $data['pay_appkey'],
                    'status' => $data['status'],
                    'newest_time' => time()
                ];
                $result = db('pay_interface')->insertGetId($ins_data);
                if ($result) {
                    return [
                        'code' => 1,
                        'msg' => '添加成功'
                    ];
                } else {
                    return [
                        'code' => 0,
                        'msg' => '添加失败'
                    ];
                }
            }
        }

    }

    //修改商户资料
    public function edit(){
        if(!request()->isPost()){
            $id = input('get.id');
            $find = db('pay_interface')->where("id=".$id)->find();
            $this->assign('data',$find);
            return $this->fetch();
        }else{
            $data = input('post.');
            if($data){
                if($data['status'] == 1){
                    $status_find = db('pay_interface')->where("status=1")->find();
                    if ($status_find) {
                        return [
                            'code' => 0,
                            'msg' => '已有启用接口'
                        ];
                        exit;
                    }
                }
                $up_data = [
                    'pay_title' => $data['pay_title'],
                    'pay_number' => $data['pay_number'],
                    'pay_appid' => $data['pay_appid'],
                    'pay_cusid' => $data['pay_cusid'],
                    'pay_appkey' => $data['pay_appkey'],
                    'status' => $data['status'],
                    'newest_time' => time()
                ];
                $result = db('pay_interface')->where("id",$data['id'])->update($up_data);
                if ($result) {
                    return [
                        'code' => 1,
                        'msg' => '编辑成功'
                    ];
                } else {
                    return [
                        'code' => 0,
                        'msg' => '编辑失败'
                    ];
                }


            }else{
                return [
                    'code' => 0,
                    'msg'  => '数据错误'
                ];
            }
        }
    }

    //删除商户
    public function del(){
        $id = input('post.id');
        $resutl = db('pay_interface')->where("id",$id)->delete();
        if($resutl){
            return [
                'code' => 1,
                'msg' => '删除成功'
            ];
            exit;
        }else{
            return [
                'code' => 0,
                'msg'  => '删除失败'
            ];
            exit;
        }
    }
}
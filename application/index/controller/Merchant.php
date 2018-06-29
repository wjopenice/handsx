<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/3/15
 * Time: 15:57
 */

namespace app\index\controller;

use app\common\controller\Base;
use think\Config;

class Merchant extends Base {

    public function infor(){

        $promote_data = session('promote_auth');

        $key = db('promote')->where("id",$promote_data['id'])->value('paykey');
        $this->assign('data',$promote_data);
        $this->assign('key',$key);
        return $this->fetch();
    }

    //生成商户APPKEY
    public function getKey(){
        $key = generateKey();
        $id = session('promote_auth')['id'];
        $find = db('promote')->where("paykey='".$key."'")->find();
        if($find){
            $this->getKey();
        }else{
            db('promote')->where('id',$id)->update(['paykey' => $key]);
            return [
                'key' => $key
            ];
        }
    }

    //银行卡信息
    public function bank(){
        $bank = Config('bank');

        //获取省级地区
        $province=db('areas')->where(array('parent_id'=>1))->select();
        $this->assign('province',$province);

        $this->assign('bank',$bank['bank_list']);
        return $this->fetch();
    }

    public function getArea(){
        $where['parent_id']=$_REQUEST['id'];
        $area=db('areas')->where($where)->select();
        return [
            'code'  => 1,
            'msg'   => '',
            'data'  => $area
        ];

    }

    //获取当前用户银行卡信息
    public function getBank(){
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

            $where   = "bb.promote_id = " . get_pro_id() . " and bb.status = 1";

            //---------------END--------------//
            $data  = db('binding_bank')
                ->alias('bb')
                ->field('bb.*,p.account,p.id')
                ->join('promote p','p.id=bb.promote_id')
                ->where($where)
                ->order('bb.bank_id desc')
                ->limit($sPage, $limit)
                ->select();
            $count = db('binding_bank')
                ->alias('bb')
                ->field('bb.*,p.account,p.id')
                ->join('promote p','p.id=bb.promote_id')
                ->where($where)
                ->count();
            if (!empty($data)) {
                foreach ($data as $k => &$v) {
                    $v['id'] =  $v['bank_id'];
                    $v['bank_name'] =  getBankName($v['bank_name']);
                    $v['bank_number'] = $v['bank_number'];
                    $v['bank_user'] = $v['bank_user'];
                    $v['bank_city'] = getBankRegion($v['bank_city']);
                    $v['sub_branch'] = $v['sub_branch'];
                    $v['bank_phone'] = $v['bank_phone'];
                    $v['ctime']    = $v['ctime'] ? date('Y-m-d H:i:s', $v['ctime']) : '';
                    $v['key']           = $k + 1;
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

    //添加银行卡
    public function add_bank(){
        if (!request()->Post()) {
            return [
                'code' => 200,
                'msg'  => '数据请求异常'
            ];
        } else {
            $promote_auth = session('promote_auth');
            $data = input('post.');
            if($data){
                $ins_data = [
                    'promote_id'   => $promote_auth['id'],
                    'bank_name'    => $data['bank_name'],
                    'bank_number'  => $data['bank_number'],
                    'bank_user'    => $data['bank_user'],
                    'bank_city'    => $data['province'].",".$data['city'].",".$data['district'],
                    'sub_branch'   => $data['sub_branch'],
                    'bank_phone'   => $data['bank_phone'],
                    'ctime'        => time()
                ];
                $result = db('binding_bank')->insert($ins_data);
                if($result){
                    rwLog([
                        'content' => "添加银行卡，卡号为".$data['bank_number'],
                        'login_ip' => get_server_ip(),
                        'time'     => time(),
                        'pid'      => $promote_auth['id']
                    ]);
                    return [
                        'code' => 1,
                        'msg'  => '添加成功'
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg'  => '添加失败'
                    ];
                }
            }else{
                return [
                    'code' => 0,
                    'msg'  => '数据异常'
                ];
            }

        }
    }

    //银行卡信息修改

    /**
     * @return mixed
     */
    public function editBank(){
        if(request()->isPost()){
            $editData = input('post.');
            if($editData){
                $map = [
                    'bank_id' => $editData['bank_id'],
                    'promote_id' => get_pro_id()
                ];
                $up_data = [
                    'bank_name'    => $editData['bank_name'],
                    'bank_number'  => $editData['bank_number'],
                    'bank_user'    => $editData['bank_user'],
                    'bank_city'    => $editData['province'].",".$editData['city'].",".$editData['district'],
                    'sub_branch'   => $editData['sub_branch'],
                    'bank_phone'   => $editData['bank_phone'],
                    'ctime'        => time()
                ];
                $result = db('binding_bank')->where($map)->update($up_data);
                if($result){
                    rwLog([
                        'content' => "修改银行卡信息，银行卡ID为".$editData['bank_id'.",修改内容:".implode(",",$editData)],
                        'login_ip' => get_server_ip(),
                        'time'     => time(),
                        'pid'      => get_pro_id()
                    ]);
                    return [
                        'code' => 1,
                        'msg'  => '修改成功'
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg'  => '修改失败'
                    ];
                }
            }else{
                return [
                    'code' => 0,
                    'msg'  => '数据异常'
                ];
            }
        }else{
            $id = input('get.id');

            $bank = Config('bank');
            //获取当前银行卡信息
            $where = [
                'bank_id' => $id,
                'promote_id' => get_pro_id()
            ];
            $data = db('binding_bank')->where($where)->find();
            $region = explode(',',$data['bank_city']);
            $new_region = [
                'province' => [
                  '1' => $region[0],
                  '2' => getBankRegion($region[0])
                ],
                'city' => [
                    '1' => $region[1],
                    '2' => getBankRegion($region[1])
                ],
                'district' => [
                    '1' => $region[2],
                    '2' => getBankRegion($region[2])
                ]
            ];
            $this->assign('data',$data);
            $this->assign('region',$new_region);

            //获取省级地区
            $province=db('areas')->where(array('parent_id'=>1))->select();
            $this->assign('province',$province);

            $this->assign('bank',$bank['bank_list']);
            return $this->fetch();
        }
    }

    //删除银行卡
    public function delBank(){
        if(!request()->isPost()){
            return [
                'code' => 0,
                'msg'  => '数据异常'
            ];
        }else{
            $id = input('post.id');
            if($id){
                $result = db('binding_bank')->where("bank_id=".$id)->update(['status' => 2]);
                if($result){
                    rwLog([
                        'content' => "删除银行卡ID为".$id."的银行卡信息",
                        'login_ip' => get_server_ip(),
                        'time'     => time(),
                        'pid'      => get_pro_id()
                    ]);
                    return [
                        'code' => 1,
                        'msg'  => '修改成功'
                    ];
                }else{
                    return [
                        'code' => 0,
                        'msg'  => '修改失败'
                    ];
                }
            }
        }
    }
}
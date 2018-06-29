<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/3/20
 * Time: 18:05
 */
namespace app\index\controller;

use app\common\controller\Base;
use think\Config;
use lib\Excel;
class Admin extends Base{

    const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';

    //重置密码
    public function savePass(){
        if(!request()->isPost()){
            return $this->fetch();
        }else{
            $id = get_pro_id();
            $data = input('post.');
            $admin_pass = db('promote')->where("id=".$id)->value('hands_pass');
            if($this->think_ucenter_md5($data['old_pass'],self::DATA_AUTH_KEY) != $admin_pass){
                return [
                    'code' => 0,
                    'msg'  => '原密码不正确'
                ];
            }

            if($this->think_ucenter_md5($data['new_pass'],self::DATA_AUTH_KEY) == $admin_pass){
                return [
                    'code' => 0,
                    'msg'  => '新密码不能与原密码一样'
                ];
            }

            $save = db('promote')->where("id=".$id)->update([
               'hands_pass' => $this->think_ucenter_md5($data['new_pass'],self::DATA_AUTH_KEY)
            ]);

            if($save){
                session(null);
                return [
                    'code' => 1,
                    'msg'  => '重置成功'
                ];
            }else{
                return [
                    'code' => 0,
                    'msg'  => '重置失败'
                ];
            }
        }
    }

    //密码加密
    public function think_ucenter_md5($str, $key = 'ThinkUCenter'){
        return '' === $str ? '' : md5(sha1($str) . $key);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/6/11
 * Time: 11:25
 */
namespace app\mobile\controller;

use app\common\controller\Admin;

class Income extends Mobile
{
    public function index(){
        //定义三方
        $pay_type = Config('pay_type');
        foreach ($pay_type as $key => $val) {

        }
        echo "<pre>";
        print_r($pay_type);
        return $this->fetch();
    }
}
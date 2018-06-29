<?php
    // +----------------------------------------------------------------------
    // | ThinkPHP [ WE CAN DO IT JUST THINK ]
    // +----------------------------------------------------------------------
    // | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
    // +----------------------------------------------------------------------
    // | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
    // +----------------------------------------------------------------------
    // | Author: 流年 <liu21st@gmail.com>
    // +----------------------------------------------------------------------
    // 应用公共文件
    if (!function_exists('password_strength')) {
        /**
         * 计算密码强度（%）
         * @param $password
         * @return float|int
         */
        function password_strength($password) {
            $length = 0;
            $size   = mb_strlen($password);
            foreach (count_chars($password, 1) as $v) {
                $percent = $v / $size;
                $length  -= $percent * log($percent) / log(2);
            }
            $strength = round(($length / 4) * 100, 2);
            if ($strength > 100) {
                $strength = 100;
            }
            return $strength;
        }
    }
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean $adv  是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    if (!function_exists('query_client_ip')) {
        function query_client_ip($type = 0, $adv = false) {
            $type = $type ? 1 : 0;
            static $ip = null;
            if ($ip !== null) {
                return $ip[$type];
            }
            if ($adv) {
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    $pos = array_search('unknown', $arr);
                    if (false !== $pos) {
                        unset($arr[$pos]);
                    }
                    $ip = trim($arr[0]);
                } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            // IP地址合法验证
            $long = sprintf("%u", ip2long($ip));
            $ip   = $long ? [
                $ip,
                $long
            ] : [
                '0.0.0.0',
                0
            ];
            return $ip[$type];
        }
    }
    /**
     * 生成随机字符串
     * @param  integer $length 长度
     * @param  boolean $int    是否纯数字
     * @param  integer $level  字符串强度[1-4]
     * @return [type]          [description]
     */
    if (!function_exists('randoms')) {
        function randoms($length = 6, $int = false, $level = 2) {
            $character = [
                'number' => '0123456789',
                'letter' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'symbol' => '!@#$%^&*()-_[]{}<>~+=/?|',
                'filter' => '0OIl1'
            ];
            // 根据条件设置随机字符范围
            if ($int) {
                // 纯数字
                $chars = $character['number'];
            } else {
                switch ($level) {
                    case 1:
                        // 大写字母
                        $chars = $character['letter'];
                        break;
                    case 2:
                        // 数字+大写字母
                        $chars = $character['number'] . $character['letter'];
                        break;
                    case 3:
                        // 数字+大写字母+小写字母
                        $chars = $character['number'] . $character['letter'] . strtolower($character['letter']);
                        break;
                    case 4:
                        // 数字+大写字母+小写字母+符号
                        $chars = $character['number'] . $character['letter'] . strtolower($character['letter']) . $character['symbol'];
                        break;
                    default:
                        // 数字+大写字母
                        $chars = $character['number'] . $character['letter'];
                        break;
                }
            }
            // 过滤指定字符
            if (!empty($character['filter']) && $level == 3 || $level == 4) {
                $filter = str_split($character['filter']);
                foreach ($filter as $key => $value) {
                    $chars = preg_replace('/' . $value . '/', '', $chars);
                }
            }
            // 开始随机
            $string = '';
            for ($i = 0; $i < $length; $i++) {
                $string .= $chars[mt_rand(0, strlen($chars) - 1)];
            }
            return trim($string);
        }
    }

/*
*获取单笔订单收取的手续费
*/
function getComm($level_id,$amount,$pay_way,$pay_status){
    if($pay_status == 1){
        $level = db('promote_level')->where("id",$level_id)->find();
        if($pay_way == 1 || $pay_way == 2 || $pay_way == 3){
            $commission = number_format($amount * $level['revenue'],2);
        }else if($pay_way == 4){
            $commission = number_format($amount * $level['h5_wetch_revenue'],2);
        }else if($pay_way == 5){
            $commission = number_format($amount * $level['h5_alipay_revenue'],2);
        }else{
            $commission = '0.00';
        }

    }else{
        $commission = '0.00';
    }
    return $commission;
}

/*
*获取单笔订单的结算金额
*/
function getCommMoney($level_id,$amount,$pay_way,$pay_status){
    if($pay_status == 1){
        $level = db('promote_level')->where("id",$level_id)->find();
        if($pay_way == 1 || $pay_way == 2 || $pay_way == 3){
            $commission = number_format($amount - $amount * $level['revenue'],2);
        }else if($pay_way == 4){
            $commission = number_format($amount - $amount * $level['h5_wetch_revenue'],2);
        }else if($pay_way == 5){
            $commission = number_format($amount - $amount * $level['h5_alipay_revenue'],2);
        }else{
            $commission = '0.00';
        }
    }else{
        $commission = '0.00';
    }

    return $commission;
}



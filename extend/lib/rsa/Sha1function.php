<?php

    /**
     *    sha1加密函数类
     */
    class Sha1function {
        /**
         * 签名字符串
         * @param $prestr    需要签名的字符串
         * @param $key       私钥
         * @param $direction 添加私钥的方向   1前    2后
         *                   return 签名结果
         */
        public function Sign($prestr, $key, $direction) {
            if ($direction == 2) {
                $prestr = $prestr . $key;
            } else {
                $prestr = $key . $prestr;
            }
            return sha1($prestr);
        }

        /**
         * 验证签名
         * @param $prestr 需要签名的字符串
         * @param $sign   签名结果
         * @param $key    私钥
         *                return 签名结果
         */
        public function Verify($prestr, $sign, $key, $direction) {
            if ($direction == 2) {
                $prestr = $prestr . $key;
            } else {
                $prestr = $key . $prestr;
            }
            $mysgin = sha1($prestr);
            if ($mysgin == $sign) {
                return true;
            } else {
                return false;
            }
        }
    }

?>
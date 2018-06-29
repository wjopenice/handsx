<?php
    /**
     *  Author : Dream <34650064@QQ.com>
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : Check.class.php
     *  Create Date : 2016/11/22 19:20
     *  Version : 0.1
     *  Copyright : car Project Team Copyright (C)
     *  Email Address : yxly330@126.com
     *  license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh
     */

    namespace lib;
    class Check {
        /**
         * 是否手机
         * @param $phone
         * @return bool
         */
        static public function isPhone(string $phone): bool {
            if (preg_match('/^1(3[0-9]|4[579]|5[0-9]|7[0135678]|8[0-9])\d{8}$/', trim($phone))) {
                return true;
            }
            return false;
        }

        /**
         * 是否邮箱
         * @param $email
         * @return bool
         */
        static public function isEmail(string $email): bool {
            if (preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', trim($email))) {
                return true;
            }
            return false;
        }

        /**
         * 检查密码是否包含数字和字幕的8-32个字符
         * @param string $password
         * @return bool
         */
        static public function isPassword(string $password): bool {
            if (preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/', $password)) {
                return true;
            }
            return false;
        }

        /**
         * 是否unix时间戳
         * @param $unixTime
         * @return bool
         */
        static function isUnixTime(int $unixTime): bool {
            $strtotime = (string)strtotime(date('Y-m-d H:i:s', $unixTime));
            return ((boolean)($strtotime === (string)$unixTime));
        }

        /**
         * 是否SSL请求
         * @return bool
         */
        static function isHttps(): bool {
            if (isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
                return true;
            }
            if (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
                return true;
            }
            return false;
        }

        /**
         * 是否价格
         * @param $price
         * @return bool
         */
        static function isPrice(float $price): bool {
            if (preg_match('/^[0-9.]+$/', $price)) {
                return true;
            }
            return false;
        }

        /**
         * 是否数字
         * @param $number
         * @return bool
         */
        static function isNumber(int $number): bool {
            if (preg_match('/^[0-9]+$/', $number)) {
                return true;
            }
            return false;
        }

        /**
         * 是否合法字符串
         * @param $string
         * @return bool
         */
        static function isString(string $string): bool {
            if (preg_match('/^[\x{4e00}-\x{9fa5}0-9a-zA-Z_]*$/u', $string)) {
                return true;
            }
            return false;
        }

        /**
         * 是否合法的版本号
         * @param string $version
         * @return bool
         */
        static function isVersion(string $version): bool {
            if (preg_match('/^\d+(\.\d+)+$/', $version)) {
                return true;
            }
            return false;
        }

        /**
         * 检查网址是否http
         * @param      $url
         * @param bool $isHttps
         * @return bool
         */
        static function isHttp($url, $isHttps = false): bool {
            if (preg_match('/^https?:\/\/\S+$/i', $url)) {
                return true;
            }
            return false;
        }
    }
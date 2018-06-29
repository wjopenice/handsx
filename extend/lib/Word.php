<?php

    namespace lib;
    class Word {
        /**
         * 根据字符串生成唯一值（crc64）
         * @param $string : 要编码的字符串
         * @return int|number
         */
        static public function strUnique($string) {
            $crc = abs(crc32($string));
            if ($crc & 0x80000000) {
                $crc ^= 0xffffffff;
                $crc += 1;
            }
            return $crc;
        }

        /**
         * 移除字符串中连续的重复字符
         * @param $string
         * @return mixed
         */
        static public function removeRepeatString($string) {
            $string = preg_replace('/\./', '', $string);
            return preg_replace('/(.)\1+/u', '$1', $string);
        }

        /**
         * 隐藏账号中间部分
         * @param  [type]  $string [description]
         * @param  [type]  $sublen [description]
         * @param  integer $start [description]
         * @param  string  $code  [description]
         * @return [type]          [description]
         */
        public function hide_account($string, $sublen, $start = 0, $code = 'UTF-8') {
            if ($code == 'UTF-8') {
                $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
                preg_match_all($pa, $string, $t_string);
                if (count($t_string[0]) - $start > $sublen) {
                    return join('', array_slice($t_string[0], $start, $sublen));
                }
                return join('', array_slice($t_string[0], $start, $sublen));
            } else {
                $start  = $start * 2;
                $sublen = $sublen * 2;
                $strlen = strlen($string);
                $tmpstr = '';
                for ($i = 0; $i < $strlen; $i++) {
                    if ($i >= $start && $i < ($start + $sublen)) {
                        if (ord(substr($string, $i, 1)) > 129) {
                            $tmpstr .= substr($string, $i, 2);
                        } else {
                            $tmpstr .= substr($string, $i, 1);
                        }
                    }
                    if (ord(substr($string, $i, 1)) > 129) {
                        $i++;
                    }
                }
                //if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
                return $tmpstr;
            }
        }

        /**
         * 隐藏身份证中间部分
         * @param  [type] $idcard [description]
         * @return [type]         [description]
         */
        public function hide_idcard($idcard) {
            if (!empty($idcard)) {
                if (strlen($idcard) == 15) {  // 15位
                    return substr_replace($idcard, "****", 8, 4);
                }
                if (strlen($idcard) == 18) {  // 18位
                    return substr_replace($idcard, "****", 10, 4);
                }
            }
            return null;
        }

        /**
         * 隐藏IP地址关键部分
         * @return [type] [description]
         */
        public function hide_ip($ipv4) {
            if (!empty($ipv4)) {
                return preg_replace('/((?:\d+\.){3})\d+/', '\\1*', $ipv4);
            }
            return null;
        }

        /**
         * 隐藏手机号关键部分
         * @param  [type] $mobile [description]
         * @return [type]         [description]
         */
        public function hide_mobile($mobile) {
            if (!empty($mobile)) {
                return preg_replace('/(\d{3})(?:\d{4})(\d{4})/', '$1****$2', $mobile);
            }
            return null;
        }

        /**
         * 隐藏银行卡关键部分
         * @param $card
         * @return null|string|string[]
         */
        public function hide_bank($card) {
            if (!empty($card)) {
                return preg_replace('/(\d{4})(?:\d+)(\d{4})/', '$1****$2', $card);
            }
            return null;
        }

        /**
         * 隐藏邮箱敏感信息
         * @param  [type] $email [description]
         * @return [type]        [description]
         */
        public function hide_email($email) {
            if (!empty($email)) {
                $prefix_email = substr($email, 0, strrpos($email, '@'));
                $suffix_email = substr($email, strrpos($email, '@'));
                $count        = strlen($prefix_email);
                if ($count > 3) {
                    $start = substr($prefix_email, 0, 2);
                    $end   = substr($prefix_email, -1);
                } else {
                    $start = substr($prefix_email, 0, 1);
                    $end   = '';
                }
                return $start . '****' . $end . $suffix_email;
            }
            return null;
        }
    }

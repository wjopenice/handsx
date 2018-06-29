<?php
    /**
     * 第三方API查询接口
     * Author: Dream
     * Release Date: 2016-01-26
     * Email Address: 34650064@qq.com
     */

    namespace lib;
    class Api {
        /**
         * 公共访问方法
         * @param        $requestUrl
         * @param string $method
         * @param null   $bodys
         * @return mixed
         */
        private static function aliCurl($requestUrl, $method = 'GET', $bodys = null) {
            $headers = [];
            array_push($headers, 'Content-Type:application/json; charset=UTF-8');
            array_push($headers, 'Authorization:APPCODE ' . config('system.api_code'));
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $requestUrl);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (!empty($bodys)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
            }
            if (preg_match('/^https:\/\//i', $requestUrl)) {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            $result = curl_exec($curl);
            curl_close($curl);
            return json_decode($result, true);
        }

        /**
         * 文件转二进制或base64
         * @param      $filename
         * @param bool $base64
         * @return null|string
         */
        private static function fileToBinary($filename, $base64 = false) {
            if (is_file($filename)) {
                $binFile = file_get_contents($filename);
                return $base64 ? chunk_split(base64_encode($binFile)) : $binFile;
            }
            return null;
        }

        /**
         * 取得IP地址信息
         * @param string $ip
         * @param bool   $format
         * @return string
         */
        public static function getIpInfo($ip = '', $format = false) {
            if (empty($ip)) {
                return '';
            }
            $requestUrl = 'http://saip.market.alicloudapi.com/ip?ip=' . $ip;
            $result     = self::aliCurl($requestUrl);
            $body       = $result['showapi_res_body'];
            if (intval($body['ret_code']) === 0) {
                return $format ? "{$body['country']}-{$body['region']}-{$body['city']}-{$body['county']}" : $body;
            }
            return '';
        }

        /**
         * 取得手机号码归属地
         * @param $phone
         * @return string
         */
        public static function getPhoneInfo($phone) {
            if (empty($phone)) {
                return '';
            }
            $requestUrl = 'http://showphone.market.alicloudapi.com/6-1?num=' . $phone;
            $result     = self::aliCurl($requestUrl);
            $body       = $result['showapi_res_body'];
            if (intval($body['ret_code']) === 0) {
                return $body;
            }
            return '';
        }

        /**
         * 取得身份证照片信息
         * @param array $idcard
         * @return array|null
         * @demo $idcard['face'=>正面照片绝对路径,'back'=>背面照片绝对路径]
         *  $idcard = [
         *  'face'=>'C:\Users\yxly3\Desktop\test\face.jpg',
         *  'back'=>'C:\Users\yxly3\Desktop\test\back.jpg'
         *  ];
         */
        public static function getIdcardInfo($idcard = []) {
            if (empty($idcard) || !isset($idcard['face']) || !isset($idcard['back'])) {
                return null;
            }
            $requestUrl  = 'https://dm-51.data.aliyun.com/rest/160601/ocr/ocr_idcard.json';
            $face_base64 = self::fileToBinary($idcard['face'], true);
            $back_base64 = self::fileToBinary($idcard['back'], true);
            $bodys       = "{
                \"inputs\": [
                    {
                        \"image\": {
                            \"dataType\": 50,
                            \"dataValue\": \"{$face_base64}\"
                        },
                        \"configure\": {
                            \"dataType\": 50,
                            \"dataValue\": \"{\\\"side\\\":\\\"face\\\"}\"
                        }
                    },
                    {
                        \"image\": {
                            \"dataType\": 50,
                            \"dataValue\": \"{$back_base64}\"},
                        \"configure\": {
                            \"dataType\": 50,
                            \"dataValue\": \"{\\\"side\\\":\\\"back\\\"}\"}
                    }
                ]
            }";
            $result      = self::aliCurl($requestUrl, 'POST', $bodys);
            if (isset($result['outputs']) && count($result['outputs']) >= 1) {
                $idcardInfo = [];
                foreach ($result['outputs'] as $key => $item) {
                    $dataValue = json_decode($item['outputValue']['dataValue'], true);
                    if (isset($dataValue['address'])) {
                        $idcardInfo['face'] = $dataValue;
                    } else {
                        $idcardInfo['back'] = $dataValue;
                    }
                }
                return !empty($idcardInfo) ? $idcardInfo : null;
            }
            return null;
        }

        /**
         * 取得天气预报信息
         * @param $queryParams
         * @return null
         * @demo $queryParams = [
         *  'city=城市名',
         *  'citycode=城市天气代号',
         *  'cityid=城市ID',
         *  'ip=255.255.255.255',
         *  'location=39.983424,116.322987'
         *  ]
         */
        /**
         * 取得天气预报信息
         * @param string $method[query|city]
         * @param        $queryParams
         * @return mixed|null
         */
        public static function getWeather($method = 'city', $queryParams) {
            if (empty($queryParams) || !is_array($queryParams)) {
                return null;
            }
            $requestUrl = 'http://jisutqybmf.market.alicloudapi.com/weather/query?' . implode('&', $queryParams);
            $result     = self::aliCurl($requestUrl);
            if ($result['status'] === '0') {
                return $result;
            }
            return null;
        }
    }

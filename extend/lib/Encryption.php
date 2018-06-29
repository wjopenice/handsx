<?php

    namespace lib;
    use think\Log;

    /**
     * 加密类
     * Class Encryption
     */
    class Encryption {
        private $class;                //@$class  					类句柄
        private $private_key;        //@private_key				rsa私钥地址/md5、sha1私钥
        private $public_key;        //@public_key 				rsa公钥地址
        const method = [
            'Rsa',
            'Md5',
            'Sha1'
        ];//@$method 	可使用加密方式
        private $word;                //@$word  					使用加密方式
        private $direction;            //@$direction  				添加私钥的方向   1前    2后
        private $root;
        private $private_key_path;
        private $public_key_path;

        /**
         * 初始化加密方式
         * Encryption constructor.
         * @param string $method
         * @param int    $direction
         */
        public function __construct($method = 'Rsa', $direction = 2) {
            $this->root = EXTEND_PATH . 'lib/rsa';
            $rsaPath    = $this->root . '/Rsafunction.php';
            $md5Path    = $this->root . '/Md5function.php';
            $sha1Path   = $this->root . '/Sha1function.php';
            if (is_file($rsaPath) && is_file($md5Path) && is_file($sha1Path)) {
                require_once $rsaPath;
                require_once $md5Path;
                require_once $sha1Path;
            }
            try {
                $this->word             = ucfirst(strtolower($method));
                $class                  = '\\' . $this->word . 'function';
                $this->class            = new $class();
                $this->private_key      = config('fragrancd.private_key');
                $this->public_key       = config('fragrancd.public_key');
                $this->private_key_path = DATA_PATH . 'private_key.pem';
                $this->public_key_path  = DATA_PATH . 'public_key.pem';
                $this->direction        = $direction;
            } catch (\ErrorException $e) {
                $e->getMessage();
            }
        }

        /**
         * 数据签名
         * @param $data
         * @return bool
         */
        public function Sign($data) {
            if (!in_array($this->word, self::method)) {
                return false;
            }
            return $this->class->Sign($data, $this->private_key_path, $this->direction);
        }

        /**
         * 验签
         * @param $data
         * @param $sign
         * @return bool
         */
        public function Verify($data, $sign) {
            if (!in_array($this->word, self::method)) {
                return false;
            }
            return $this->class->Verify($data, $sign, $this->public_key_path, $this->direction);
        }

        /**
         * 验签
         * @param $data
         * @return bool
         */
        public function isVerify($data) {
            if (!in_array($this->word, self::method)) {
                return false;
            }
            $sign = $data['signature'];
            unset($data['signature']);
            $data = urldecode(http_build_query($data));
            return $this->class->Verify($data, $sign, $this->public_key_path, $this->direction);
        }

        /**
         * 解密 RSA
         * @param $sign
         * @return bool
         */
        public function Decrypt($sign) {
            if ($this->word != "Rsa") {
                return false;
            }
            return $this->class->Decrypt($sign, $this->private_key_path);
        }

        /**
         * @param $url
         * @param $post_data
         * @return mixed
         */
        private static function postCurl($url, $post_data) {
            //初始化
            $curl = curl_init();
            //设置抓取的url
            curl_setopt($curl, CURLOPT_URL, $url);
            //设置头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_HEADER, false);
            //设置获取的信息以文件流的形式返回，而不是直接输出。
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //设置post方式提交
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
            //执行命令
            $data = curl_exec($curl);
            //关闭URL请求
            curl_close($curl);
            //显示获得的数据
            return $data;
        }

        /**
         * 发送请求
         * @param $data
         * @return mixed|string
         */
        public function sendEnc($data) {
            $url = config('fragrancd.get_url');
            if (empty($data)) {
                return '';
            }
            $data = self::postCurl($url, $data);
            return $data;
        }

        /**
         * 生成签名并发送验证数据
         * @param $dataArr
         * @return mixed
         */
        public function setSign($dataArr) {
            ksort($dataArr);
            Log::write(http_build_query($dataArr));
            $signStr = urldecode(http_build_query($dataArr));
            //生成签名
            $signData = $this->Sign($signStr);
            $dataArr['signature'] = $signData;
            Log::write($dataArr,'info');
            //发送验证数据
            //var_dump($dataArr);exit;
            $encData = $this->sendEnc($dataArr);
            //反序数据，转换成数组
            parse_str($encData, $resultArr);
            return $resultArr;
        }
        /**
         * 生成签名并发送验证数据
         * @param $dataArr
         * @return mixed
         */
        public function setSignPay($dataArr) {
            ksort($dataArr);
            $signStr = urldecode(http_build_query($dataArr));
            //生成签名
            $signData = $this->Sign($signStr);
            $dataArr['signature'] = $signData;
            //发送验证数据
            //$encData = $this->sendEnc($dataArr);
            //反序数据，转换成数组
            //parse_str($encData, $resultArr);
            return $dataArr;
        }
    }

    ?>
<?php
    /**
     *  Author : Luo
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : Alipay.php
     *  Create Date : 2017/7/11 14:09
     *  Version : 0.1
     *  Email Address : Luo@126.com
     */

    namespace lib;
    class Alipay {
        private $root;
        private $request;
        private $ap;
        private $config;

        public function __construct() {
            $this->root        = EXTEND_PATH . 'lib/alipay';
            $config            = $this->root . '/config.php';
            $aopSdk            = $this->root . '/AopSdk.php';
            $alipayServiceRoot = $this->root . '/pagepay/service/AlipayTradeService.php';
            if (is_file($config) && is_file($aopSdk) && is_file($alipayServiceRoot)) {
                require_once $config;
                require_once $aopSdk;
                require_once $alipayServiceRoot;
            }
            $this->config                 = $config;
            $this->ap                     = new \AopClient;
            $this->ap->appId              = $config['app_id'];
            $this->ap->gatewayUrl         = $config['gatewayUrl'];
            $this->ap->rsaPrivateKey      = $config['merchant_private_key'];
            $this->ap->format             = $config['format'];
            $this->ap->apiVersion         = '1.0';
            $this->ap->charset            = $config['charset'];
            $this->ap->signType           = $config['sign_type'];
            $this->ap->timestamp          = date('Y-m-d H:i:s', time());
            $this->ap->alipayrsaPublicKey = $config['alipay_public_key'];
            $this->request                = new \AlipayTradePagePayRequest();
            //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
        }

        /**
         * 支付宝发起支付
         * @param $content
         * @return string|\提交表单HTML文本
         */
        public function isPay($content) {
            $json_content = json_encode($content);
            //var_dump($json_content);exit;
            //$json_content='{"product_code":"FAST_INSTANT_TRADE_PAY","out_trade_no":"20150320010101001","subject":"Iphone6 16G","total_amount":"88.88","body":"Iphone6 16G"}';
            $this->request->setBizContent($json_content);
            $this->request->setReturnUrl('http://shop.wjcpe.com/alipayReturn.html');
            $this->request->setNotifyUrl('http://shop.wjcpe.com/alipayNotify.html');
            $result = $this->ap->pageExecute($this->request);
            //var_dump($result);exit;
            if (!empty($result)) {
                return $result;
            } else {
                return "fail";
            }
        }

        /**
         * 验证支付
         */
        public function checkPay($arr) {
            $config = $this->config;
            $aliSev = new \AlipayTradeService($config);
            $result = $aliSev->check($arr);
            //var_dump($aliSev);exit;
            return $result;
        }

    }
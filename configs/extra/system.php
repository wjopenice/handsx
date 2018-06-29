<?php
    /**
     *  Author : Dream <34650064@QQ.com>
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : system.php
     *  Create Date : 2017/3/8 15:05
     *  Version : 0.1
     *  Email Address : yxly330@126.com
     */
    return [
        // OSS
        'oss_key'           => '',
        'oss_secret'        => '',
        'oss_bucket'        => '',
        // SMS
        'sms_env'           => false,
        'sms_key'           => '',
        //阿里KEY
        'sms_secret'        => '',
        // API
        'api_key'           => '',
        'api_secret'        => '',
        'api_code'          => '',
        //支付回调地址
        'notifyUrl'         => 'http://' . $_SERVER['HTTP_HOST'] . '/enrefpaynotify.html',
        'returnUrl'         => 'http://' . $_SERVER['HTTP_HOST'] . '/enrefpayreturn.html',
        //手机端
        'returnMobileUrl'   => 'http://' . $_SERVER['HTTP_HOST'] . '/enrefpaymobilereturn.html',
        //商品支付回调
        'goodsNotify'       => 'http://' . $_SERVER['HTTP_HOST'] . '/goodsnotify.html',
        'goodsReturn'       => 'http://' . $_SERVER['HTTP_HOST'] . '/goodsreturn.html',
        'mobileGoodsReturn' => 'http://' . $_SERVER['HTTP_HOST'] . '/mobile/goodsreturn.html',
        //提现回调地址
        'withdrawNotifyUrl' => 'http://' . $_SERVER['HTTP_HOST'] . '/withdrawnotify.html',
        //入金回调地址
        'exchangeNotifyUrl' => 'http://' . $_SERVER['HTTP_HOST'] . '/exchangenotify.html',
        'exchangeNotifyUrl' => 'http://' . $_SERVER['HTTP_HOST'] . '/exchangenotify.html',
        // 短信配置
        'sms_fc_sign'       => '海香商城股份有限公司',
        //华兴软通短息配置
        'sms_url'           => 'http://www.stongnet.com/sdkhttp/sendsms.aspx',
        //http接口地址
        'reg_code'          => '101100-WEB-HUAX-080603',
        //华兴软通注册码，请在这里填写您从客服那得到的注册码
        'reg_pw'            => 'YTDAKORP',
        //华兴软通注册码对应的密码，请在这里填写您从客服那得到的密码
        'source_add'        => '',
        //子通道号（最长10位，可为空
    ];

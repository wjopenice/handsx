<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/5/8
 * Time: 17:56
 */
return array (
    'alipay' =>
        array (
            'partner' => '2088421945579767',
            'key' => 'ak7sd96a1wm7jjqsdd50tzq6z8iq3yuq',
            'email' => '47778899@qq.com',
        ),
    'weixin' =>
        array (
            'partner' => '755437000006',
            'email' => '1230',
            'key' => '7daa4babae15ae17eee90c9e',
        ),
    'sms_set' =>
        array (
            'smtp' => 'kgsah4vrkx05lqzc1o9pjt8i6f3dmwbe',
            'smtp_account' => 'f74574fa77b846469229660fde3c7684',
            'smtp_password' => '1 ',
            'smtp_port' => '25615',
        ),
    'oss_storage' =>
        array (
            'bucket' => 'xgceshi',
            'accesskeyid' => 'CJPs1zzEIlRspHzR',
            'accesskeysecr' => '8wOiH71ubzx1kHvu70FpV1aYmMoFMo',
            'domain' => 'oss-cn-shenzhen.aliyuncs.com',
        ),
    'qiniu_storage' =>
        array (
            'bucket' => '22',
            'accesskeyid' => '222',
            'accesskeysecr' => '22',
            'domain' => '22',
        ),
    'qq_login' =>
        array (
            'appid' => '1',
            'key' => '1',
            'account' => '1',
        ),
    'wx_login' =>
        array (
            'appid' => '1',
            'mchid' => '1',
            'key' => '1',
            'appsecret' => '1',
        ),
    'weixin_zl' =>
        array (
            'appid' => '0000001813',
            'key' => '9c27d6c035827e2d8c7ef41895a193bd',
        ),

    'vsp_H5' =>array(
        'APPID'      => '00018930',
        'CUSID'      => '55059304816M71R',
        'APPKEY'     => '2018Z0303B',
        'APIURL'     => "https://vsp.allinpay.com/apiweb/unitorder",//生产环境
        'APIVERSION' => "11",
    ),

    'Ips' =>array(
        'MerCode'  => '207575',
        'MerName'  => '广州手上科技有限公司',
        'Account'  => '2075750014',
        'APIURL'   => "https://thumbpay.e-years.com/psfp-webscan/services/scan?wsdl",//生产环境
        'MerCert'  => "ykorm6Gh3UTcAeJZoBYUO2UApGYF25FHJRey42G6JY8kVwrY6LLKX20a0fsYC91YSWzG16e6OE3mNqXbSWAQa7Mykvz4kM38fPLL6u6w643LFw6Kd0zc2avua9HRhfEt",
        'PANURL'   => "https://newpay.ips.com.cn/psfp-entry/gateway/payment.do",
    ),
    'Heepay' => array(
        'agent_id' => '1664502',
        'key'      => "4B05A95416DB4184ACEE4313",
        'version'  =>1,
        'api_url'  => "https://pay.Heepay.com/Payment/Index.aspx",//生产环境
        'PANURL'   => "https://newpay.ips.com.cn/psfp-entry/gateway/payment.do",
    ),
    'CSH' => array(
        'appKey'   => '6489fd770e0772d08299677b64045434',
        'keyValue' => 'NvfAtVevPG1zzJUkXIAbzdADqYo0E1E8VAeGct2g',//密钥
        'apiUrl'  => "https://snpayapi.aijinfu.cn/pay/payment.do",//生产环境
        'alipayApiUrl' => "https://snpayapi.aijinfu.cn/pay/multifunctionPayment.do",
    ),
    'Ornament' => array(
        'APPID'   => '10900589',
        'APPSECRET' => 'a27235a1dfb14095b1e247a5b5894040',//密钥
        'APIURL'  => "http://api.0592pay.com",//生产环境
    ),
    'Swift' => array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'101500543265',
        'key'=>'18ae9667a31fe0b14dbb505dd3b69f3b',  /* MD5密钥 */
        'version'=>'2.0',
        'sign_type'=>'MD5',
        'public_rsa_key'=>'-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqpK3c+aAtEhG66w+PJ5SChP/Uvp4Rkmpx8Q7j2krFQzFL5PNs3cZzFzJ1R9tKQmkhpk8GbGpe/GCJoLzniMb9lMtc8E8apIUX8XEVCIUEcb0BSvT5NexmobhTNA3VJR0LnppcNYtic8wlBNQ8lAFYzCpWsBz2Ja4lTysGZixfMQKiEOYeU/jE1d5M3PvANZPHYidAMqDPAUREFsQkMJwcnrhHymvMBP6eAoDbO0BT9wAVKPTMgSWOFgavIyzEYMEXGFTAs4HbTpW1Xud/MtjySY/mK4+Yaoz2AYQrsHUApB0WztrR/++DHs/EJgE2GbzB/UT1MxqYR989N0WqwYUGwIDAQAB
-----END PUBLIC KEY-----',   /* 威富通RSA公钥*/
        'private_rsa_key'=>'-----BEGIN RSA PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCfU8v4BUr81SKm/H0ahbdQZjEpO8nMyk+xuYSatHwnU4//m47R+4G2YB4Z6PHsJi4+ScfJpQutFhKrFwTXZ6TDqLvaqZDDkJq5G271g+PmrzFp7f40/E9m0qjeL64RJra0rZql23dvPW4vVomMRgRcoPOn0YWVp+M6T5PaFgE4M8dh4lMZz57gVwOdd08F99Z92f3QgZtEjI+/EXvMenXxb/aRofNkt+Wdk2ELJ6MIP0d9UU5v3WgLuuNv5QnQYzj/RMr8GD+wrDYiNQJxsaTmE/OEJggsumhD4eYY5YlRy2EIN504cujYVKU1wOSZgq9oJCynGR0aPuQWx58IHxEtAgMBAAECggEAHfEFd8qm2PTE2lTAvec7F+TcgD84IUAz0dZnURtx6YIOoZ5+LH/zVG6juYLJU/Oo5RPAc+iMVS68u2JMCp7zm8Ft7B3JkrbuHLNHGuR6Q7PQuXN8PkDcOxqDmZ2kPJzl4PZvBZRE0abdug+tMatGzpGAuJzrWcB/N0oVIvrXp9PnOqfo/Y5nxmpOFCImJppIS3AL1pftNtQZo9G15CPHDYtpUbXPtD2MjjW4OLxKuPRoHSwUgo6LW9XSwNXfcuK+lbzLL0BhlWD9IV/+yCEUEblN87yxxfhpQFaAhXj5W+B3YsMOZuK93+XMOpYmw8EpUDMObOnvwb0NSHUrV2RUAQKBgQDTojlnNS1e7+tjPzFtOhGPj1uCBPAEIeHAcnPgd80bEiujxMLCnGaAvmnTrMu4Xo0e5fAP4F7R6UD+IUsfr3CAAu7CadQ49TW+SovAvciy9AZuSVVIwynu6QdYgFyPKe1LZYAEq5k+mB1Vh5q0RoxMNAA5pGYKg8+4MmmsJi7X7QKBgQDAunCOqIiH128bs/1VRIhDpzuRW5Qr/SRbO2saVg5RSHnO/nGT2OuxSTTkc8yrx7qd9SmAxXl5kR238DhMOQOnRBomldmVtAJuJgrdQyt0wXfeQVQqshqCUaE/xhEbpSCdbPSZbKZZdplV0y6O5vXIhxw+1qAvXLcxw46s3R92QQKBgQClQ+ejywkVPDILHMwSSehwvThufkCYWYUbbcVDowpOe5AMoZidtNju7MNjg2rLHTsCx/kBzOr+7THNwl4R7kTiEmg09cO+fu5rHXepGgtig+GJukaZPZ6/bMZJvGOLgOhHmomwG/jdwpgVtIGBCh6BW5JZcSImT+ykIOoYfvDRuQKBgCgwOHxnBGFfORoLxE3dhpSk8LT05cbueIBVuZW6UC3+8PeK82AjIbLMUy04QHupoG6Dyu3BP/1rl0jd3L94PBzLBLD7Gm4vJTqW0DknYo5sMXS1JrnofcKjBv7nbHXZTx3EtJSxpVaOdpcA/HpsCuCP3AH2e1yk9sZ3wu6lBYSBAoGACYM60j1CVRNSZxUNRgiwfWzS69qI1eezPc7xQEganpVBI9SZcTNp1kpDKmQikXJ4Yb5XWn12HCY/sFeBW6Su3ruNqxvg1XiUPbH6A6nxd5B3QX0mS9+wDm6ONysPLRdKbfFO0mdP4CeyuGPdvDIMXP4dJdLhMUL4pcJLI0B7gBE=
-----END RSA PRIVATE KEY-----'   /* 商户自行生成的RSA私钥 */
    ),
    'SwiftScan' => array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'101550471662',
        'key'=>'94d5224c8a388e55d14cf87fa7ff9f70',  /* MD5密钥 */
        'version'=>'2.0',
        'sign_type'=>'MD5',
        'public_rsa_key'=>'-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqpK3c+aAtEhG66w+PJ5SChP/Uvp4Rkmpx8Q7j2krFQzFL5PNs3cZzFzJ1R9tKQmkhpk8GbGpe/GCJoLzniMb9lMtc8E8apIUX8XEVCIUEcb0BSvT5NexmobhTNA3VJR0LnppcNYtic8wlBNQ8lAFYzCpWsBz2Ja4lTysGZixfMQKiEOYeU/jE1d5M3PvANZPHYidAMqDPAUREFsQkMJwcnrhHymvMBP6eAoDbO0BT9wAVKPTMgSWOFgavIyzEYMEXGFTAs4HbTpW1Xud/MtjySY/mK4+Yaoz2AYQrsHUApB0WztrR/++DHs/EJgE2GbzB/UT1MxqYR989N0WqwYUGwIDAQAB
-----END PUBLIC KEY-----',   /* 威富通RSA公钥*/
        'private_rsa_key'=>'-----BEGIN RSA PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCfU8v4BUr81SKm/H0ahbdQZjEpO8nMyk+xuYSatHwnU4//m47R+4G2YB4Z6PHsJi4+ScfJpQutFhKrFwTXZ6TDqLvaqZDDkJq5G271g+PmrzFp7f40/E9m0qjeL64RJra0rZql23dvPW4vVomMRgRcoPOn0YWVp+M6T5PaFgE4M8dh4lMZz57gVwOdd08F99Z92f3QgZtEjI+/EXvMenXxb/aRofNkt+Wdk2ELJ6MIP0d9UU5v3WgLuuNv5QnQYzj/RMr8GD+wrDYiNQJxsaTmE/OEJggsumhD4eYY5YlRy2EIN504cujYVKU1wOSZgq9oJCynGR0aPuQWx58IHxEtAgMBAAECggEAHfEFd8qm2PTE2lTAvec7F+TcgD84IUAz0dZnURtx6YIOoZ5+LH/zVG6juYLJU/Oo5RPAc+iMVS68u2JMCp7zm8Ft7B3JkrbuHLNHGuR6Q7PQuXN8PkDcOxqDmZ2kPJzl4PZvBZRE0abdug+tMatGzpGAuJzrWcB/N0oVIvrXp9PnOqfo/Y5nxmpOFCImJppIS3AL1pftNtQZo9G15CPHDYtpUbXPtD2MjjW4OLxKuPRoHSwUgo6LW9XSwNXfcuK+lbzLL0BhlWD9IV/+yCEUEblN87yxxfhpQFaAhXj5W+B3YsMOZuK93+XMOpYmw8EpUDMObOnvwb0NSHUrV2RUAQKBgQDTojlnNS1e7+tjPzFtOhGPj1uCBPAEIeHAcnPgd80bEiujxMLCnGaAvmnTrMu4Xo0e5fAP4F7R6UD+IUsfr3CAAu7CadQ49TW+SovAvciy9AZuSVVIwynu6QdYgFyPKe1LZYAEq5k+mB1Vh5q0RoxMNAA5pGYKg8+4MmmsJi7X7QKBgQDAunCOqIiH128bs/1VRIhDpzuRW5Qr/SRbO2saVg5RSHnO/nGT2OuxSTTkc8yrx7qd9SmAxXl5kR238DhMOQOnRBomldmVtAJuJgrdQyt0wXfeQVQqshqCUaE/xhEbpSCdbPSZbKZZdplV0y6O5vXIhxw+1qAvXLcxw46s3R92QQKBgQClQ+ejywkVPDILHMwSSehwvThufkCYWYUbbcVDowpOe5AMoZidtNju7MNjg2rLHTsCx/kBzOr+7THNwl4R7kTiEmg09cO+fu5rHXepGgtig+GJukaZPZ6/bMZJvGOLgOhHmomwG/jdwpgVtIGBCh6BW5JZcSImT+ykIOoYfvDRuQKBgCgwOHxnBGFfORoLxE3dhpSk8LT05cbueIBVuZW6UC3+8PeK82AjIbLMUy04QHupoG6Dyu3BP/1rl0jd3L94PBzLBLD7Gm4vJTqW0DknYo5sMXS1JrnofcKjBv7nbHXZTx3EtJSxpVaOdpcA/HpsCuCP3AH2e1yk9sZ3wu6lBYSBAoGACYM60j1CVRNSZxUNRgiwfWzS69qI1eezPc7xQEganpVBI9SZcTNp1kpDKmQikXJ4Yb5XWn12HCY/sFeBW6Su3ruNqxvg1XiUPbH6A6nxd5B3QX0mS9+wDm6ONysPLRdKbfFO0mdP4CeyuGPdvDIMXP4dJdLhMUL4pcJLI0B7gBE=
-----END RSA PRIVATE KEY-----'   /* 商户自行生成的RSA私钥 */
    ),
    'Reapal' => array(
        'merchant_id'   => '100000000000147',
        'key' => 'g0be2385657fa355af68b74e9913a1320af82gb7ae5f580g79bffd04a402ba8f',//密钥
        'seller_email'  => "200871768@qq.com",//
        'url' => 'http://testapi.reapal.com/mobile/portal',
    ),
    'Kj' => array(
        'merchant_id'   => '2018927104',
        'key' => 'a8c4af8869bf46d36bdf3ebc05be5e72',//密钥
        'url' => 'http://api.kj-pay.com',
    ),
    'Now' => array(
        'appid'   => '152531301959747',
        'appkey' => 'idMyNvsQIsrHQ3dVY24lWfqI1pa0TSYw',//密钥
        /*'Aliappid'   => '152531301959747',
        'Aliappkey' => 'idMyNvsQIsrHQ3dVY24lWfqI1pa0TSYw',//密钥*/
        'url' => 'https://pay.ipaynow.cn/',
    ),
);


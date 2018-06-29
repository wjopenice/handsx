<?php

// $commission = round(0.015,2);
// echo sprintf('%.2f', 0.015);
// echo $commission;exit;
include './phpqrcode/phpqrcode.php';

$data = $_POST;
$key = 'shoushang2018';//KEY
$data['is_key'] = 1;

if($data['is_key']){
	if($data['is_key'] == 1){
	$sh_data = [
        'resqn'   => $data['resqn'],
        'account' => $data['account'],
        'pay_amount' => $data['pay_amount'],
        'paytype' => $data['paytype'],
        'notify_url' => $data['notify_url']
    ];

	$sign = SignArray($sh_data,$key);
	$data['sign'] = $sign;
}
}
if($data['class'] == 1){
    $url = "http://www.gzbaoqing.com/api.php?s=/Scanpay/begin_Pay.html";
}
if($data['class'] == 2){
    $url = "http://www.gzbaoqing.com/api.php?s=/IpsCodePay/GetPayData.html";
}

//$url = "http://119.23.34.87/api.php?s=/Scanpay/begin_Pay.html";


//$url = "http://www.gzbaoqing.com/api.php?s=/IpsCodePay/GetPayData.html";

//请求支付接口
$ch = curl_init();
$params[CURLOPT_URL] = $url;    //请求url地址
$params[CURLOPT_HEADER] = false; //是否返回响应头信息
$params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
$params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
$params[CURLOPT_POST] = true;
$params[CURLOPT_SSL_VERIFYPEER] = false;//禁用证书校验
$params[CURLOPT_SSL_VERIFYHOST] = false;
$params[CURLOPT_POSTFIELDS] = $data;
curl_setopt_array($ch, $params); //传入curl参数
$output = curl_exec($ch); //执行
curl_close($ch); //关闭连接
$output = json_decode($output,ture);
echo json_encode($output);
// if($output['sign']){
// 	if($sign == $output['sign']){
// 		echo json_encode($output);
// 	}else{
// 		echo "验证签名失败";
//         exit;
// 	}
// }


/**
     * 将参数数组签名
     */
    function SignArray($array,$appkey){
        $array['key'] = $appkey;// 将key放到数组中一起进行排序和组装
        ksort($array);
        $blankStr = ToUrlParams($array);
        $sign = md5($blankStr);
        return $sign;
    }

    function ToUrlParams($array)
    {
        $buff = "";
        foreach ($array as $k => $v)
        {
            if($v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
?>


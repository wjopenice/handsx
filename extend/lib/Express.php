<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lib;
class express {
    public static function getOrderLogistics($addressid,$express_name){
        $express_name = $express_name ? $express_name : 'auto';
        $host = "https://ali-deliver.showapi.com";
        $path = "/showapi_expInfo";
        $method = "GET";
        $appcode = "b800fdec641c42fcbb794b159e1c26e9";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "com=$express_name&nu=$addressid";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (!empty($bodys)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        }
        if (preg_match('/^https:\/\//i', $url)) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($data);
        return json_decode(json_encode($result),true);
    }
}


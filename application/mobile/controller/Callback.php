<?php
/**
 * Created by PhpStorm.
 * User: adminn
 * Date: 2018/6/12
 * Time: 13:52
 */
namespace app\admin\controller;

use app\common\controller\Admin;
use think\Config;
use lib\Excel;
use think\Db;
class Callback extends Admin{
    /**
     *通知方法
     */
    public function notify(){

        //打开日志log
        $logFile = fopen(dirname(__FILE__)."/notifypf.txt", "a+");
        fwrite($logFile, "回调进来\r\n");
        fwrite($logFile, "\r\n\r\n");

        $params = array();
        foreach($_POST as $key=>$val) {//动态遍历获取所有收到的参数,此步非常关键,因为收银宝以后可能会加字段,动态获取可以兼容由于收银宝加字段而引起的签名异常
            $params[$key] = $val;
            fwrite($logFile, $key."=".$val."\r\n");
        }
        if(count($params)<1){//如果参数为空,则不进行处理

            fwrite($logFile, "参数为空\r\n");

        }else {
            //
            $order_info['trade_no'] = $params['chnltrxid'];
            $order_info['out_trade_no'] = $params['cusorderid'];

            $key = APPKEY;
            ///判断是H5还是扫码
            /*$type = M('promote_deposit','tab_')->where("pay_order_number='".$params['cusorderid']."'")->getField('pay_way');
            if($type == 4){
                $key = C('vsp_H5.APPKEY');
            }*/
            if($this->ValidSign($params, $key)){//验签成功

                $pay_where = substr($order_info['out_trade_no'],0,2);
                //此处进行业务逻辑处理
                switch($params["trxstatus"]){
                    case 2008:
                        fwrite($logFile, "[".$params["cusorderid"]."]--->交易处理中\r\n");
                        break;
                    case 3008:
                        fwrite($logFile, "[".$params["cusorderid"]."]--->余额不足\r\n");
                        break;
                    case 0000:
                        fwrite($logFile, "[".$params["cusorderid"]."]--->支付成功\r\n");
                        switch ($pay_where) {
                            case 'SP':
                                $result = $this->set_spend($order_info);
                                break;
                            case 'PF':
                                $result = $this->set_deposit($order_info);
                                break;
                            case 'AG':
                                $result = $this->set_agent($order_info);
                                break;
                            case 'QD':
                                $result = $this->set_promoteDeposit($order_info);
                                break;
                            default:
                                exit('accident order data');
                                break;
                        }
                        break;
                    default:
                        fwrite($logFile, "[".$params["cusorderid"]."]--->支付失败-->状态码".$params["trxstatus"]."\r\n");
                        break;
                }

                if($pay_where != 'PF'){
                    //回调次数
                    M('promote_deposit',"tab_")->where(array('pay_order_number' => $order_info['out_trade_no']))->setInc('notify_nums',1);

                    //将返回结果返回到商户的回调地址上边
                    //fwrite($logFile, "商户回调请求前");
                    $notify_nums = M('promote_deposit',"tab_")->where(array('pay_order_number' => $order_info['out_trade_no']))->getField('notify_nums');
                    if($notify_nums <= 3){
                        $re = $this->request($params,$type);
                        if($re == 'success'){
                            fwrite($logFile, "商户有返回：".$re."\r\n\r\n");
                            fwrite($logFile, "\r\n\r\n");
                            fclose($logFile);
                            echo "success";
                        }
                        fwrite($logFile, "商户无返回\r\n\r\n");
                    }else{
                        fwrite($logFile, "商户的回调次数：".$notify_nums."\r\n\r\n");
                        fwrite($logFile, "\r\n\r\n");
                        fclose($logFile);
                        echo "success";
                    }
                }else{
                    echo "success";
                }
            }else{
                fwrite($logFile, "[".$params["cusorderid"]."]--->验签失败\r\n");
            }

            fwrite($logFile, "\r\n\r\n");

        }

        fclose($logFile);

    }
}
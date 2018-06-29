<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:/phpStudy/WWW/hands/template/admin\administration/details.html";i:1529567136;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商户号弹窗</title>
    <link rel="stylesheet" href="/static/index/css/index.css">
    <style>
        .fl{float: left;}
        .cf:after{content:""; clear:both; display:table;}.cf {zoom:1;}
        .bussNumTit{width: 100%;height: 50px;line-height: 50px;font-size:20px;font-weight:bold;text-align: center;border-bottom: 1px solid #F4F4F4;}
        .assetBox{margin: 10px 10px;}
        .subAsset{margin:9px;width: 160px;line-height: 30px;color:#FFF;border:1px solid #F4F4F4;background: #5FB878;}
        .subAsset:hover{background: #009688;}
        .subAssetName{width: 100%;text-align: center;font-size: 16px;}
        .subAssetMoney{width:100%;font-size:16px;text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
        .title{width:10%;font-size: 17px;display: block;text-align:center;background-color: #d62728;color: #E9E7E7;}
    </style>

</head>
<body>

<div id="box">
    <div class="bussNumTit"><span><?php echo $account['account']; ?></span></div>
    <div class="assetBoxWrap">
        <!--<span class="title">统计</span>-->
        <ul class="assetBox cf">
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">总充值额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['all_money'])?$data['all_money']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5充值额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['recharge']['h5'])?$data['recharge']['h5']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">PC充值额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['recharge']['pc'])?$data['recharge']['pc']: '0.00'; ?></p>
            </li>
        </ul>
        <ul class="assetBox cf">
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">总结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['all_rech_money'])?$data['all_rech_money']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5支付宝结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['already']['h5_alipay'])?$data['sett']['already']['h5_alipay']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5微信结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['already']['h5_wetch'])?$data['sett']['already']['h5_wetch']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">PC结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['already']['pc'])?$data['sett']['already']['pc']: '0.00'; ?></p>
            </li>
        </ul>
        <ul class="assetBox cf">
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">未结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['not_rech_money'])?$data['not_rech_money']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5支付宝未结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['not']['h5_alipay'])?$data['sett']['not']['h5_alipay']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5微信未结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['not']['h5_wetch'])?$data['sett']['not']['h5_wetch']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">PC未结算额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['sett']['not']['pc'])?$data['sett']['not']['pc']: '0.00'; ?></p>
            </li>
        </ul>
        <ul class="assetBox cf">
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">总提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['all_with_money'])?$data['all_with_money']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5支付宝提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['already']['h5_alipay'])?$data['with']['already']['h5_alipay']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5微信提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['already']['h5_wetch'])?$data['with']['already']['h5_wetch']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">PC提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['already']['pc'])?$data['with']['already']['pc']: '0.00'; ?></p>
            </li>
        </ul>
        <ul class="assetBox cf">
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">未提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['not_with_money']['not_money'])?$data['not_with_money']['not_money']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5支付宝未提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['not']['h5_alipay'])?$data['with']['not']['h5_alipay']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">H5微信未提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['not']['h5_wetch'])?$data['with']['not']['h5_wetch']: '0.00'; ?></p>
            </li>
            <li class="subAsset fl cf copy" data-num="15">
                <p class="fl subAssetName">PC未提现额</p
                ><p class="fl subAssetMoney"><?php echo !empty($data['with']['not']['pc'])?$data['with']['not']['pc']: '0.00'; ?></p>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
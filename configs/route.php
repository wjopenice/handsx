<?php
    // +----------------------------------------------------------------------
    // | ThinkPHP [ WE CAN DO IT JUST THINK ]
    // +----------------------------------------------------------------------
    // | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
    // +----------------------------------------------------------------------
    // | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
    // +----------------------------------------------------------------------
    // | Author: liu21st <liu21st@gmail.com>
    // +----------------------------------------------------------------------
    return [

        //后台
        'admin$'                    => 'admin/index/index',
        'admin/login$'              => 'admin/account/login',
        'admin/default$'            => 'admin/index/default',
        'jurisd$'                   => 'admin/jurisdiction/index',
        'arecharge$'                => 'admin/administration/index',  //所有充值记录页
        'apromote$'                 => 'admin/administration/promote',//所有商户列表页
        'awithdraw$'                => 'admin/administration/with',//提现记录页
        'class$'                    => 'admin/jurisdiction/type',
        'role$'                     => 'admin/role/index',
        'payine$'                   => 'admin/pay/index',//接口列表
        //档位列表
        'stall$'                    => 'admin/stall/index',
        'notice$'                   => 'admin/notice/index',
        //密码重置
        'adminupass$'               => 'admin/user/savepass',
        'rechargestat$'             => 'admin/stat/recharge',
        'witchstat$'                => 'admin/stat/with',
        'user$'                     => 'admin/user/index',
        'aprofit$'                  => 'admin/profit/index',
        'automatic$'                => 'admin/automatic/sett',
        'h5wetchsett$'              => 'admin/automatic/h5_wetch_sett',
        'h5alipaysett$'             => 'admin/automatic/h5_alipay_sett',
        'fiels$'                    => 'admin/fiels/index',
        'supplement$'               => 'admin/supplement/index',
        'black$'                    => 'admin/black/index',
        'filter$'                   => 'admin/black/filter',
        'income$'                   => 'admin/income/index',
        'asub$'                     => 'admin/substitute/index',
        'notify$'                   => 'admin/callback/notify',

        //前台
        'index$'                    => 'index/index',
        'login$'                    => 'login/login',
        'logout$'                   => 'login/logout',
        'updatepwd$'                => 'account/updatepwd',
        'recharge$'                 => 'recharge/index',//充值记录页
        'merchant$'                 => 'merchant/infor',//商户信息页
        'bank$'                     => 'merchant/bank',//商户银行卡信息
        'addbank$'                  => 'merchant/add_bank',//添加银行卡
        'editbank$'                 => 'merchant/editbank',//银行卡信息修改
        'withdraw$'                 => 'withdraw/index',//提现记录页
        'todaywith$'                => 'withdraw/todaywith',//TO提现记录
        'withdrawaccounts$'         => 'withdraw/accounts',//T1结算
        'todaysett$'                => 'withdraw/todaysett',//TO结算
        'withdrawdetail$'           => 'withdraw/detail',// 提现流程操作页
        'alipaywith$'               => 'hwith/alipay',//H5支付宝提现记录页
        'wetchwith$'                => 'hwith/wetch',//H5微信提现记录页
        'hwithdrawaccounts$'        => 'withdraw/haccounts',//提现记录页
        'hwithdrawdetail$'          => 'withdraw/hdetail',// 提现流程操作页
        //密码重置
        'upass$'                    => 'admin/savepass',
        'recommend$'                => 'recommend/index',// 推荐列表
        'downstream$'               => 'recommend/downstream',
        'profit$'                   => 'profit/index',
        'profitdetail$'             => 'profit/detail',
        'substitute$'               => 'substitute/index',

        //移动后台
        'mobile$'                     => 'mobile/login/login', //移动后台登录
        'mobile/logout$'             => 'mobile/login/logout', //移动后台退出
        'mobile/index$'             => 'mobile/index/index', //移动后台首页

        'mobile/buss$'                   => 'mobile/buss/list',//所有商户列表页
        'mobile/buss/detail$'           =>'mobile/buss/detail', //单个商户信息
        'mobile/buss/add$'              =>'mobile/buss/add', //添加商户
        'mobile/buss/rechargedetail$'  =>"mobile/buss/rechargedetail",//商户充值
        'mobile/buss/getlist$'          =>"mobile/buss/getlist",

        'mobile/gear$'                   =>"mobile/gear/list",//档位列表
        'mobile/interfaces$'            =>"mobile/interfaces/list",//接口列表
        'mobile/recharges$'              =>"mobile/recharges/list"//充值列表
    ];



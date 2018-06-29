<?php
    /**
     *  Author : Dream <34650064@QQ.com>
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : session.php
     *  Create Date : 2017/2/25 23:21
     *  Version : 0.1
     *  Copyright : Blog Project Team Copyright (C)
     *  Email Address : yxly330@126.com
     *  license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh
     */
    return [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'bsp',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ];
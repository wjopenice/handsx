<?php
    /**
     *  Author : Dream <34650064@QQ.com>
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : cache.php
     *  Create Date : 2017/2/25 23:23
     *  Version : 0.1
     *  Copyright : Blog Project Team Copyright (C)
     *  Email Address : yxly330@126.com
     *  license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh
     */
    return [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ];
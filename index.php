<?php
    // +----------------------------------------------------------------------
    // | ThinkPHP [ WE CAN DO IT JUST THINK ]
    // +----------------------------------------------------------------------
    // | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
    // +----------------------------------------------------------------------
    // | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
    // +----------------------------------------------------------------------
    // | Author: liu21st <liu21st@gmail.com>
    // +----------------------------------------------------------------------
    // [ 应用入口文件 ]
    // 定义应用目录

      //端前台模块
     define('APP_PATH',__DIR__.'./application/');
    // 加载框架引导文件
    const IN_INDEX = __DIR__;
    require_once IN_INDEX . '/configs/define.php';
    require_once IN_INDEX . '/thinkphp/start.php';

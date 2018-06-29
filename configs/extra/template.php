<?php
    /**
     *  Author : Dream <34650064@QQ.com>
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : template.php
     *  Create Date : 2017/2/25 23:18
     *  Version : 0.1
     *  Copyright : Blog Project Team Copyright (C)
     *  Email Address : yxly330@126.com
     *  license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh
     */
    return [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 视图基础目录，配置目录为所有模块的视图起始目录
        'view_base'    => ROOT_PATH . 'template/',
        // 当前模板的视图目录 留空为自动获取
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => '/',
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
        //开启布局
        //'layout_on'     =>  true,
        //'layout_name'   =>  'common/home',
    ];
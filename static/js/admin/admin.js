/**
 *  Author : Dream <34650064@QQ.com>
 *  Encoding : UTF-8
 *  Separator : Unix and OS X (\n)
 *  Create Date : 2017/5/21 22:19
 *  Version : 0.1
 *  Copyright : iklfy Project Team Copyright (C)
 *  Email Address : yxly330@126.com
 *  license http://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh
 */
/* global layer */
"use strict";
(function () {
    window.admin = {
        /**
         * 返回顶部
         */
        backTop        : function () {
            $('html, body').animate({scrollTop: 0}, 'slow');
        },
        /**
         * 异步请求
         */
        ajax           : {
            post: function (queryUrl, queryStringArray, AfterSuccessDoSomething) {
                $.ajax({
                           url     : queryUrl,
                           type    : 'POST',
                           data    : queryStringArray,
                           dataType: 'json',
                           error   : function () {
                               layer.msg('net connect fail');
                           },
                           success : function (data, status) {
                               AfterSuccessDoSomething(data, status);
                           }
                       });
            }
        },
        /**
         * 暂停几秒
         * @param {type} d
         * @returns {undefined}
         */
        sleep          : function (d) {
            for (var t = Date.now(); Date.now() - t <= d;) {
                // none;
            }
        },
        /**
         * ajax请求动画
         * @returns {undefined}
         */
        loading        : function (error) {
            var loading;
            $(document).ajaxStart(function () {
                loading = layer.load(2);
            });
            $(document).ajaxStop(function () {
                layer.close(loading);
            });
            if (error) {
                $(document).ajaxError(function (event, jqxhr, settings) {
                    var html = '';
                    html += '<ul>';
                    html += '   <li>时间：' + event.timeStamp * 1000 + '</li>';
                    html += '   <li>类型：' + event.type + '</li>';
                    html += '   <li>代码：' + jqxhr.status + '</li>';
                    html += '   <li>消息：' + jqxhr.statusText + '</li>';
                    html += '   <li>方式：' + settings.type + '</li>';
                    html += '   <li>目标：' + settings.url + '</li>';
                    html += '   <li>数据：' + settings.dataType + '</li>';
//                    html += '   <li>数据：'+ settings.data +'</li>';
                    html += '</ul>';
                    // 关闭加载动画并弹层
                    layer.close(loading);
                    layer.open({
                                   type   : 1,
                                   skin   : 'layui-layer-rim', //加上边框
                                   area   : ['420px', '280px'], //宽高
                                   content: html
                               });
                });
            }
        },
        check          : {
            isEmail: function (email) {
                if (!email) {
                    return false;
                }
                if (email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)) {
                    return true;
                } else {
                    return false;
                }
            },
            isPhone: function (phone) {
                if (!phone) {
                    return false;
                }
                if (phone.match(/^1(3[0-9]|4[579]|5[0-9]|7[0135678]|8[0-9])\d{8}$/)) {
                    return true;
                } else {
                    return false;
                }
            },
            isEmpty: function (mixedVar) {
                var undef;
                var key;
                var i;
                var len;
                var emptyValues = [undef, null, false, 0, '', '0'];
                for (i = 0, len = emptyValues.length; i < len; i++) {
                    if (mixedVar === emptyValues[i]) {
                        return true;
                    }
                }
                if (typeof mixedVar === 'object') {
                    for (key in mixedVar) {
                        if (mixedVar.hasOwnProperty(key)) {
                            return false;
                        }
                    }
                    return true;
                }
                return false;
            }
        },
        popLayer       : function (href, title, width, height) {
            width  = parseInt(width);
            height = parseInt(height);
            if (isNaN(width)) {
                width = 800;
            }
            if (isNaN(height)) {
                height = 500;
            }
            if (title === undefined) {
                title = title || '新窗口';
            }
            layer.open({
                           type   : 2,
                           area   : [width + 'px', height + 'px'],
                           fix    : false,
                           maxmin : true,
                           shade  : 0.4,
                           title  : title,
                           content: href
                       });
        },
        layerClose     : function () {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        },
        /**
         * 账号推出
         */
        logout         : function () {
            this.ajax.post('logout', {}, function (result) {
                layer.alert(result.msg, {
                    icon: result.code,
                    time: (result.wait * 1000)
                }, function (index) {
                    parent.layer.close(index);
                    parent.location.reload();
                });
                return false;
            });
        },
        /**
         * 更新验证码
         * @param element
         */
        refresh_verify : function (element) {
            $(element).attr('src', '/admin/verify_src.html?' + new Date().getTime());
        },
        /**
         * 清理缓存
         */
        clearCache     : function () {
            admin.ajax.post('/admin/cache/clear.html', {}, function (result) {
                layer.alert(result.msg, {
                    icon: result.code,
                    time: (result.wait * 1000)
                }, function (index) {
                    parent.layer.close(index);
                });
                return false;
            });
        },
        /**
         * 配置列表
         */
        configList     : function (dataConfig, editCallback, deleteCallback) {
            layui.config({
                             base: '/static/js/admin/',
                             v   : new Date().getTime()
                         }).use(['btable', 'layer'], function () {
                var btable    = layui.btable(),
                    $         = layui.jquery,
                    layerTips = parent.layer === undefined ? layui.layer : parent.layer, //获取父窗口的layer对象
                    layer     = layui.layer;//获取当前窗口的layer对象;
                btable.set({
                               openWait    : true,//开启等待框
                               elem        : dataConfig.elem,
                               url         : dataConfig.url, //数据源地址
                               pageSize    : dataConfig.pageNum,//页大小
                               params      : {//额外的请求参数
                                   t: new Date().getTime(),
                                   i: dataConfig.isId
                               },
                               columns     : dataConfig.columns,
                               even        : true,//隔行变色
                               field       : 'id', //主键ID
                               //skin: 'row',
                               checkbox    : false,//是否显示多选框
                               paged       : dataConfig.paged ? dataConfig.paged : true, //是否显示分页
                               singleSelect: false, //只允许选择一行，checkbox为true生效
                               onSuccess   : function ($elem) { //$elem当前窗口的jq对象
                                   $elem.children('tr').each(function () {
                                       $(this).children('td:last-child').children('a').each(function () {
                                           var $that  = $(this);
                                           var action = $that.data('action');
                                           var id     = $that.data('id');
                                           $that.on('click', function () {
                                               switch (action) {
                                                   case 'edit':
                                                       editCallback(id);
                                                       //layerTips.msg(action + ":" + id);
                                                       break;
                                                   case 'del': //删除
                                                       var name = $that.parent('td').siblings('td[data-field=name]').text();
                                                       //询问框
                                                       layerTips.confirm('确定要删除 ？', {
                                                           icon : 3,
                                                           title: '系统提示'
                                                       }, function (index) {
                                                           deleteCallback(id);
                                                           $that.parent('td').parent('tr').remove();
                                                       });
                                                       break;
                                               }
                                           });
                                       });
                                   });
                               }
                           });
                btable.render();
            });
        },
        /**
         * 监听提交
         * 刷新父客口
         */
        formSubmit     : function (formObj, formUrl, formElem, content, types) {
            formObj.on('submit(' + formElem + ')', function (data) {
                admin.ajax.post(formUrl, data.field, function (result) {
                    if (result.code === 0) {
                        layer.alert(result.msg, {icon: result.code});
                    }
                    if (result.code === 1) {
                        layer.msg(result.msg, {icon: result.code, time: 2000}, function () {
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.layer.close(index);
                            parent.location.reload();
                        });
                    }
                    admin.ajax.post('/admin/logs/setlog.html', {'result': result.code, 'content': content, 'type': types}, function () {
                    });
                });
                return false;
            });
        },
        /**
         * 监听提交
         * 刷新自己
         */
        formSubmitSelf : function (formObj, formUrl, formElem, content, types) {
            formObj.on('submit(' + formElem + ')', function (data) {
                admin.ajax.post(formUrl, data.field, function (result) {
                    if (result.code === 0) {
                        layer.alert(result.msg, {icon: result.code});
                    }
                    if (result.code === 1) {
                        layer.msg(result.msg, {icon: result.code, time: 2000}, function () {
                            window.location.reload();
                        });
                    }
                    admin.ajax.post('/admin/logs/setlog.html', {'result': result.code, 'content': content, 'type': types}, function () {
                    });
                });
                return false;
            });
        },
        /**
         * 初始化左侧导航
         */
        initSide       : function (navbar) {
            admin.ajax.post('/admin/menu.html', {'id': 'init'}, function (data) {
                //admin.initSide(navbar, data.data);
                navbar.set({
                               spreadOne: true,
                               elem     : '#admin-navbar-side',
                               cached   : true,
                               data     : data.data
                               //url: '/admin/menu.html?id=1'
                           });
                //渲染navbar
                navbar.render();
                //监听点击事件
                navbar.on('click(side)', function (data) {
                    tab.tabAdd(data.field);
                });
            });
        },
        /**
         * 开启新窗口
         */
        windowParent   : function (data) {
            window.parent.tab.tabAdd(data);
        },
        /**
         * 生成随便字符串
         */
        setRandomString: function (len) {
            len        = len || 32;
            var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678'; // 默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1
            var maxPos = $chars.length;
            var pwd    = '';
            for (var i = 0; i < len; i++) {
                pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
            }
            return pwd;
        },
        /**
         * 生成指定位数的随机数
         */
        setRandomInt   : function (n) {
            var t = '';
            for (var i = 0; i < n; i++) {
                t += Math.floor(Math.random() * 10);
            }
            return t;
        },
        /**
         *搜索响应
         */
        searchNumbers : function () {
            $('input[name="name"]').on('keyup', function (event) {
                var eve     = event || window.event;
                //console.log(typeof(eve.keyCode));
                var keyCode = [8, 13, 32, 192, 110, 27, 106, 107, 109, 111, 144];
                if ($.inArray(eve.keyCode, keyCode) !== -1) {
                    //console.log(eve.keyCode);
                    return false;
                } else {
                    var seachMessage = $(this).val();
                    var _this        = $(this);
                    var childBox     = $('div[class="search-message-box"]');
                    childBox.html('');
                    if (seachMessage.length > 2 && seachMessage.match(/[1-9]\d+$/)) {
                        //console.log(seachMessage)
                        admin.ajax.post('/admin/index/search.html', {'msg': seachMessage}, function (result) {
                            if (result.code === 1) {
                                var p = '';
                                if (result.data.type === 'phone') {
                                    $.each(result.data.data, function (k, v) {
                                        //console.log(v);
                                        p += '<p value="' + v.member_id + '">' + v.phone + '</p>';
                                    });
                                }
                                if (result.data.type === 'exchange') {
                                    $.each(result.data.data, function (k, v) {
                                        //console.log(v);
                                        p += '<p value="' + v.member_id + '">' + v.ex_account + '</p>';
                                    });
                                }
                                if (childBox.css('display') === 'none') {
                                    childBox.show();
                                }
                                childBox.html(p);
                                p        = '';
                                //
                                var pObj = childBox.find('p');
                                $.each(pObj, function (k, v) {
                                    admin.messageBind(pObj.eq(k));
                                });
                            }
                            if (result.code === 0) {
                                childBox.hide();
                            }
                        });
                    }
                }
                return false;
            });
        },
        /**
         * 绑定信息显示
         */
        messageBind   : function (obj) {
            obj.on('click', function () {
                var tex = obj.html();
                obj.parent('div').prev('input').val(tex);
                obj.parent('div').hide();
            });
        },
        /**
         * 设置滚动条
         * @param element
         * @param elemID
         */
        setPercent     : function (element, elemID) {
            element.progress(elemID, '50%')
        },
        /**
         * 开启滚动条
         * @param element
         * @param elemID
         * @param second
         * @param returnCallBack
         */
        activeLoading  : function (element, elemID, second, returnCallBack) {
            var isTime = null;
            clearInterval(isTime);
            var runPay = 1000 / (100 / parseInt(second));//每秒时间
            var n      = 0,m = 5;
            
            isTime = setInterval(function () {
                if (n > 100) {
                    n = 100;
                    clearInterval(isTime);
                    returnCallBack();
                }
                m = Math.random() * 10 | 0;
                n     = n + m;
                element.progress(elemID, parseInt(n) + '%');
            }, m * runPay);
        },
    }
})();

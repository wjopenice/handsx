<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"E:/phpStudy/WWW/hands/template/mobile\recharges/list.html";i:1530081398;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/header.html";i:1529896483;s:56:"E:/phpStudy/WWW/hands/template/mobile\common/footer.html";i:1530062767;s:58:"E:/phpStudy/WWW/hands/template/mobile\common/left_nav.html";i:1530164178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>充值列表</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/static/mobile/css/common/sm.css">
    <link rel="stylesheet" href="/static/mobile/css/common/base.css">

</head>
<body class="mHome">

<link rel="stylesheet" href="/static/mobile/js/common/dist/mescroll.min.css">
<link rel="stylesheet" href="/static/mobile/css/common/list.css">
    <div class="page-group">
        <div class="page">
            <header class="bar bar-nav">
                <a class="icon icon-me pull-left open-panel" id="slideBtn"></a>
                <h1 class="title"><img class="logo" src="/static/mobile/image/common/logo.png" alt=""></h1>
            </header>
            <div class="contentBox mescroll" id="mescroll">
                <!-- 搜索框 -->
                <form action="/mobile/recharges/search" method="post">
                    <div class="search-bar cf search-box">
                        <div class="bar bar-header-secondary fl search-bar-box bar-header-box">
                            <div class="searchbar">
                                <a class="searchbar-cancel">取消</a>
                                <div class="search-input">
                                    <label class="icon icon-search" for="search"></label>
                                    <input type="search" id='search' name="search" placeholder='输入完整的商户号查询...'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- 列表 -->
                <div class="list-block">
                    <div class="list-container data-list" id="dataList">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-left panel-reveal">
    <div class="content-block">
        <div class="headBoxWrap">
            <img src="/static/mobile/image/common/headImg.png" class="headImg" alt="">
            <p class="headName ofh"><?php echo $account['account']; ?></p>
            <p class="headLine"></p>
        </div>
        <div class="slideBarWrap cf">
            <div class="subSlideBox">
                <a class="subSlide slide1 cf slideHoverBg" href="/mobile/index" external><i class="slideIcon fl"></i><span>首&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide2 cf fl" href="/mobile/buss" external><i class="slideIcon fl"></i><span>商户管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide3 cf" href="/mobile/gear" external><i class="slideIcon fl"></i><span>档位管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide4 cf" href="/mobile/Interfaces" external><i class="slideIcon fl"></i><span>接口管理</span></a>
            </div>
            <div class="subSlideBox cf">
                <a class="subSlide slide5 cf" external><i class="slideIcon fl"></i><span>充值管理</span><i class="upNext"></i></a>
                <div class="innerSlideBoxWrap fl hide">
                    <?php for($i=1;$i<=$totalPage;$i++):?>
                    <a class="subInnerSlide" href="/mobile/recharges?page=<?php echo $i; ?>&limit=<?php echo $showList; ?>" external><span class="innerSlideName">充值列表数据第<?php echo $i; ?>页</span></a>
                    <?php endfor;?>
                </div>
            </div>
        </div>
        <div class="subSlideBox subSlideExit cf"><a class="subSlide slide6 cf" href="/mobile/logout" external><i class="slideIcon fl"></i><span>退出登录</span></a></div></div>
</div>
<script src="/static/mobile/js/common/zepto.min.js"></script>
<script src="/static/mobile/js/common/sm.js"></script>
<script src="/static/mobile/js/common/public.js"></script>
</body>
</html>
    <script src="/static/mobile/js/common/dist/mescroll.min.js"></script>
    <script>
        $(function(){
            //创建MeScroll对象,内部已默认开启下拉刷新,自动执行up.callback,重置列表数据;
            var mescroll = new MeScroll("mescroll", {
                up: {
                    callback: getListData, //上拉回调,此处可简写; 相当于 callback: function (page) { getListData(page); }
                    isBounce: false, //此处禁止ios回弹,解析
                    clearEmptyId: "dataList", //1.下拉刷新时会自动先清空此列表,再加入数据; 2.无任何数据时会在此列表自动提示空
                    toTop:{ //配置回到顶部按钮
                        src : "/static/mobile/image/common/mescroll-totop.png", //默认滚动到1000px显示,可配置offset修改
                        //offset : 1000
                    }
                }
            });
            /*联网加载列表数据  page = {num:1, size:10}; num:当前页 从1开始, size:每页数据条数 */
            function getListData(page){
                //联网加载数据
                getListDataFromNet(page.num, page.size, function(curPageData){
                    //联网成功的回调,隐藏下拉刷新和上拉加载的状态;
                    //mescroll会根据传的参数,自动判断列表如果无任何数据,则提示空;列表无下一页数据,则提示无更多数据;
                    //console.log("page.num="+page.num+", page.size="+page.size+", curPageData.length="+curPageData.length);
                    mescroll.endSuccess(curPageData.length);

                    //设置列表数据,因为配置了emptyClearId,第一页会清空dataList的数据,所以setListData应该写在最后;
                    setListData(curPageData);
                }, function(){
                    //联网失败的回调,隐藏下拉刷新和上拉加载的状态;
                    mescroll.endErr();
                });
            }
            /*设置列表数据*/
            var str = '';
            function setListData(curPageData){
                //console.log(curPageData);
                for (var i = 0; i < curPageData.length; i++) {
                    var pd=curPageData[i];

                    var statusCol = pd.pay_status === "支付成功" ? 'item-green' : 'item-red';

                    var str='<ul><li><a href="/mobile/recharges/detail?id='+pd.id+'" external>' +
                        '<div class="item-content item-link">' +
                        '<div class="item-media"><i class="icon icon-f7"></i></div>' +
                        '<div class="item-inner item-border item-order">' +
                        '<div class="item-title item-num">'+pd.promote_account+'</div>' +
                        '<div class="item-after item-order-num">'+pd.pay_order_number+'</div></div></div>' +
                        '<div class="item-content">' +
                        '<div class="item-media"><i class="icon icon-f7"></i></div>' +
                        '<div class="item-inner">' +
                        '<div class="item-title item-time">'+pd.create_time+'</div>' +
                        '<div class="item-after item-files '+statusCol+'">'+pd.pay_status+'</div></div></div></a>' +
                        '</li></ul>';
                    $("#dataList").append(str);

                }
            }
            /*加载列表数据* */
            function getListDataFromNet(pageNum,pageSize,successCallback,errorCallback) {
                //延时一秒,模拟联网
                setTimeout(function () {
                    $.ajax({
                        type: 'GET',
                        url: '/mobile/recharges/getlist',
                        //url: '../res/pdlist1.json?num='+pageNum+"&size="+pageSize,
                        data:{page:<?php echo $urlpage; ?>,limit:<?php echo $urllimit; ?>},
                        dataType: 'json',
                        success: function(data){
                            //模拟分页数据
                            var listData=[];
                            for (var i = (pageNum-1)*pageSize; i < pageNum*pageSize; i++) {
                                if(i==data.length) break;
                                listData.push(data[i]);
                            }
                            successCallback(listData);

                        },
                        error: errorCallback
                    });
                },500)
            }
        });
    </script>

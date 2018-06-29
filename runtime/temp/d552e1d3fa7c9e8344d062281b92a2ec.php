<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:55:"E:/phpStudy/WWW/hands/template/admin\stat/recharge.html";i:1529567136;s:55:"E:/phpStudy/WWW/hands/template/admin\common/header.html";i:1529635016;s:53:"E:/phpStudy/WWW/hands/template/admin\common/memu.html";i:1529567136;s:54:"E:/phpStudy/WWW/hands/template/admin\stat/all_rec.html";i:1529567136;s:55:"E:/phpStudy/WWW/hands/template/admin\stat/week_all.html";i:1529567136;s:56:"E:/phpStudy/WWW/hands/template/admin\stat/today_rec.html";i:1529567136;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>堡庆科技商户系统</title>
    <link rel="stylesheet" type="text/css" href="/static/index/css/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui-2.2.5/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/css.css" />

    <script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/index/js/public.js"></script>
    <script type="text/javascript" src="/static/layui-2.2.5/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/admin.js"></script>
    <script type="text/javascript" src="/static/js/admin/login.js"></script>

</head>

<body>
<!-- 头部 -->
<div class="head">
    <div class="headL">
        <img class="headLogo" src="/static/index/img/headLogo.png" />
    </div>
    <div class="headR">
        <p class="p1">
            欢迎，
            <?php echo $account['account']; ?>
        </p>
        <p class="p2">
            <a href="/adminupass.html" class="resetPWD">重置密码</a>&nbsp;&nbsp;<a
                href="javascript:void(0);" class="goOut">退出</a>
        </p>
    </div>
    <!-- onclick="{if(confirm(&quot;确定退出吗&quot;)){return true;}return false;}" -->
</div>

<div class="closeOut">
    <div class="coDiv">
        <p class="p1">
            <span>X</span>
        </p>
        <p class="p2">确定退出当前用户？</p>
        <P class="p3">
            <a class="ok yes" href="#">确定</a><a class="ok no" href="#">取消</a>
        </p>
    </div>
</div>



</body>
</html>

<body id="bg">
<!-- 左边节点 -->
<div class="container">

    <div class="leftsidebar_box">
        <a href="/admin.html" style="display: block;"><div class="line">
            <img src="/static/index/img/coin01.png" />&nbsp;&nbsp;首页
        </div></a>
        <!-- <dl class="system_log">
        <dt><img class="icon1" src="/static/index/img/coin01.png" /><img class="icon2"src="/static/index/img/coin02.png" />
            首页<img class="icon3" src="/static/index/img/coin19.png" /><img class="icon4" src="/static/index/img/coin20.png" /></dt>
    </dl> -->
        <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$val): ?>
        <dl class="system_log">
            <dt>
                <img class="icon1" src="/static/index/img/<?php echo $val['faicon']; ?>" />
                <img class="icon2" src="/static/index/img/<?php echo $val['faicon2']; ?>" /> <?php echo $val['title']; ?>
                <img class="icon3" src="/static/index/img/coin19.png" />
                <img class="icon4" src="/static/index/img/coin20.png" />
            </dt>
            <?php if($val['children'] != null): if(is_array($val['children']) || $val['children'] instanceof \think\Collection || $val['children'] instanceof \think\Paginator): if( count($val['children'])==0 ) : echo "" ;else: foreach($val['children'] as $key=>$v): ?>
            <dd>
                <img class="coin11" src="/static/index/img/coin111.png" />
                <img class="coin22" src="/static/index/img/coin222.png" />
                <a class="cks" href="<?php echo $v['url']; ?>"><?php echo $v['title']; ?></a>
                <img class="icon5" src="/static/index/img/coin21.png" />
            </dd>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </dl>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

</div>
</body>
</html>

<link rel="stylesheet" href="../../../static/admin/css/recharge.css">
<style>
    #all_main{float:left;width: 600px;height: 400px;}
    #week_all{float:left;width: 900px;height: 400px;margin-left: 20px;}
    .cf{clear: both;}
    .cf:after{zoom:1;}

</style>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div >
            <img src="/static/index/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                href="#">数据统计</a>&nbsp;-</span>&nbsp;充值统计
        </div>
    </div>

    <!-- content -->
    <div class="content">
        <!-- 总充值 -->
        <div class="totalRecharge">
            <h1 class="layui-elem-quote">总充值</h1>

            <!-- 充值金额 -->
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">总充值金额：</label>
                    <div class="layui-input-block">
                        <?php echo $all_data; ?>元
                    </div>
                </div>
                <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): if( count($class)==0 ) : echo "" ;else: foreach($class as $key=>$val): ?>
                <div class="layui-inline">
                    <label class="layui-form-label"><?php echo $val['type_name']; ?>充值金额：</label>
                    <div class="layui-input-block">
                        <?php echo $val['pay_amount']; ?>元
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <!-- 总充值折线图 -->
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="lineChart" id="all_main" style="width: 600px;height:400px;"></div>
<script type="text/javascript" src="/static/js/echarts.min.js"></script>
<script>
    var myChart = echarts.init(document.getElementById('all_main'));

    $.ajax({
        type:'post',
        url:'/admin/stat/getJsonRec.html',
        data:{},
        dataType:'json',
        success:function(data){
            var ArrNum = [];
            var amountArr = [];
            //console.log(data);
            var data = data;
            $.each(data,function(i,o){
                var obj = o.type_name;
                var amount = o.pay_amount;
                ArrNum.push(obj);
                amountArr.push(amount);
            });
            myChart.setOption({ //加载数据图表
                xAxis: {
                    data: ArrNum
                },
                series: {
                    data: amountArr
                }
            });
        }
    });

    // 指定图表的配置项和数据
    var option = {
        color: ['#3398DB'],
        title: {
            text: '各通道充值量'
        },

        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : [],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'充值量',
                type:'bar',
                barWidth: '60%',
                data:[]
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="lineChart" id="week_all"></div>

<script type="text/javascript" src="/static/js/echarts.min.js"></script>
<script>
    var myWeekAllChart = echarts.init(document.getElementById('week_all'));
    var seriesData = [];
    $.ajax({
        type:'post',
        url:'/admin/stat/weekAllJson.html',
        data:{},
        dataType:'json',
        success:function(data){
            console.log(data);
            var timeBox = [];
            var ArrNum = [];
            var data = data;
            var subSeriesData = [];

            var content = data[0].content;
            $.each(content,function(i,obj){
                timeBox.push(obj.time);
            });

            $.each(data,function(i,obj){
                var amount = [];
                subSeriesData[i] = {name:[],type:'line',stack: null,areaStyle: {normal: {}},data:[]};
                subSeriesData[i].name = obj.name;
                ArrNum.push(obj.name);

                $.each(obj.content,function(j,obj2){
                    amount.push(obj2.data.pay_amount);
                });
                subSeriesData[i].data = amount;
            });


            myWeekAllChart.setOption({ //加载数据图表
                xAxis: {
                    data: timeBox
                },
                legend: {
                    data: ArrNum
                },
                series: subSeriesData
            });
        }
    });

    // 指定图表的配置项和数据
    var WeekAll = {
        title: {
            text: '7天充值'
        },
        tooltip : {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        legend: {
            data:[]
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : []
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : []
    };

    // 使用刚指定的配置项和数据显示图表。
    myWeekAllChart.setOption(WeekAll);
</script>
</body>
</html>

        </div>

        <!-- 当日充值 -->
        <div class="totalRecharge cf">
            <h1 class="layui-elem-quote">当日充值</h1>

            <!-- 充值金额 -->
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">充值金额：</label>
                    <div class="layui-input-block">
                        <?php echo $today_data; ?>元
                    </div>
                </div>
                <?php if(is_array($today_class) || $today_class instanceof \think\Collection || $today_class instanceof \think\Paginator): if( count($today_class)==0 ) : echo "" ;else: foreach($today_class as $key=>$v): ?>
                <div class="layui-inline">
                    <label class="layui-form-label"><?php echo $v['type_name']; ?>充值金额：</label>
                    <div class="layui-input-block">
                        <?php echo $v['pay_amount']; ?>元
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <!-- 当日充值折线图 -->
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="lineChart" id="today_main" style="width: 600px;height:400px;"></div>

<script type="text/javascript" src="/static/js/echarts.min.js"></script>
<script>
    var myTodayChart = echarts.init(document.getElementById('today_main'));

    $.ajax({
        type:'post',
        url:'/admin/stat/getJsonRecToday.html',
        data:{},
        dataType:'json',
        success:function(data){
            var ArrNum = [];
            var amountArr = [];
            //console.log(data);
            var data = data;
            $.each(data,function(i,o){
                var obj = o.type_name;
                var amount = o.pay_amount;
                ArrNum.push(obj);
                amountArr.push(amount);
            });
            myTodayChart.setOption({ //加载数据图表
                xAxis: {
                    data: ArrNum
                },
                series: {
                    data: amountArr
                }
            });
        }
    });

    // 指定图表的配置项和数据
    var e = {
        color: ['#3398DB'],
        title: {
            text: '当日各通道充值量'
        },

        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : [],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'充值量',
                type:'bar',
                barWidth: '60%',
                data:[]
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myTodayChart.setOption(e);
</script>
</body>
</html>

            <div id="today_main" style="width: 600px;height:400px;"></div>
        </div>


    </div>


</div>


</body>
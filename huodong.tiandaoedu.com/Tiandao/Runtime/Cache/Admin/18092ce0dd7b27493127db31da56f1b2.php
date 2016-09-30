<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天道活动管理平台</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
    <script src="/Public/Admin/js/jquery.cookie.js"></script>
    <script src="/Public/Admin/js/ancement.js"></script>
    </style>
</head>
<body>
 <script src="/Public/Admin/js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="/Public/Admin/js/jquery.jqChart.min.js" type="text/javascript"></script>
    <div class="info-manage act-data" style="margin-left:-150px; height: 1000px;">
        <h3>活动信息管理</h3>
        <a href="javascript:;">活动信息管理</a>>><a href="javascript:;"><?php echo ($data["act_name"]); ?></a>>><a href="javascript:;">查看活动数据</a>
        <div class="table">
            <ul class="thead">
                <li class="li-lg">活动名称</li>
                <li>创建人</li>
                <li>活动时间</li>
                <li>访问量</li>
                <li>报名量</li>
                <li>收藏量</li>
            </ul>
            <ul>
                <li class="li-lg"><?php echo ($data["act_name"]); ?></li>
                <li><?php echo ($data["act_charge_name"]); ?></li>
                <li><?php echo ($data["act_date"]); ?></li>
                <li>0</li>
                <li><?php echo ($data["count"]); ?></li>
                <li><?php echo ($data["collectCount"]); ?></li>
            </ul>
        </div>
        <a href="<?php echo U('Activity/actEnter',array('act_id'=>$data['act_id']));?>">查看活动报名表</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo U('Activity/actSource',array('act_id'=>$data['act_id']));?>">查看渠道来源表</a>
        <div class="choose">
            <p class="p-choose">筛选</p>
            <dl>
                <dt><input type="radio" name="time" />本周 </dt>
                <dd><input type="radio" name="time" />本周</dd>
                <dd><input type="radio" name="time" />近三个月</dd>
                <dd><input type="text" placeholder="开始时间" /> </dd>
                <dd><input type="text" placeholder="结束时间" /> </dd>
                <dd><input type="submit" value="搜索" /> </dd>
            </dl>
        </div>
        <ul class="number">
            <li style="float:left;">每日接收反馈/浏览数</li>
            <li style="float:right;">表单填写率：7.14%</li>
        </ul>
        <div class="wrapper">
            <!-- 代码 开始 -->
            <div>
                <div id="jqChart" style="width: 1000px; height: 300px;"></div>
            </div>
            <!-- 代码 结束 -->
        </div>
    </div>
</body>
<script>
    $(function(){
        $('.account').click(function(){
            $(this).children('ul').css('display','block');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.account ul').css('display','none');
        })
        /*线性表*/
        $('#jqChart').jqChart({
            title: { text: '时间范围：最近30天' },
            axes: [
                {
                    location: 'left',//y轴位置，取值：left,right
                    minimum: -5,//y轴刻度最小值
                    maximum: 15,//y轴刻度最大值
                    interval: 5//刻度间距
                }
            ],
            series: [
                //数据1开始
                {
                    type: 'line',//图表类型，取值：column 柱形图，line 线形图
                    title:'反馈数量',//标题
                    data: [['02.11', 1], ['02.12', 0]]//数据内容，格式[[x轴标题,数值1],[x轴标题,数值2],......]
                },
                //数据1结束
                //数据2
                {
                    type: 'line',
                    title:'浏览数量',
                    data: [['02.11', 13], ['02.12', 1]]
                },
                //数据2结束
            ]
        });
    })
</script>
</html>
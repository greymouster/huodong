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
    <div class="info-manage act-form" style="margin-left:-150px;height:1000px;">
        <h3>活动信息管理</h3>
        <a href="javascript:;">活动信息管理</a>>><a href="javascript:;"><?php echo ($data["act_name"]); ?></a>>><a href="javascript:;">查看报名表单</a>
        <div class="table table-one">
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
        <a href="<?php echo U('Activity/exportStudentExel',array('act_id'=>$data['act_id']));?>">导出到excel</a>
        <div class="table table-two">
            <ul class="thead">
                <li>序号</li>
                <li>姓名</li>
                <li>手机号</li>
                <li>邮箱</li>
            </ul>
            <?php if(is_array($studentsData)): foreach($studentsData as $key=>$val): ?><ul>
                <li><?php echo ++$key;?></li>
                <li><?php echo ($val["user_name"]); ?></li>
                <li><?php echo ($val["phone"]); ?></li>
                <li><?php echo ($val["email"]); ?></li>
            </ul><?php endforeach; endif; ?>
        </div>
         <div class="page-list-link">
           <?php echo ($page); ?>
         <div>
    </div>
</body>
</html>
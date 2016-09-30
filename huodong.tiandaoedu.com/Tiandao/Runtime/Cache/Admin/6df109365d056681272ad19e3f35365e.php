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
    <div class="join-detail" style="margin-left:-150px;">
        <h3>报名审核</h3>
        <a href="javascript:;">报名审核</a>>><a href="javascript:;">查看基本信息</a>
        <div class="info basic-info">
            <h6>基本信息</h6>
            <p>姓名:<i><?php echo ($data["user_name"]); ?></i></p>
            <p>手机：<i><?php echo ($data["phone"]); ?></i></p>
            <p>Email:<i><?php echo ($data["email"]); ?></i></p>
         </div>
    </div>
</body>
<script>
</script>
</html>
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
<div class="account-info" style="margin-left:-150px;height:500px;">
        <h3>账号信息</h3>
        <form>
            <dl>
                <dt>用户名</dt>
                <dd><?php echo ($data->data->username); ?></dd>
            </dl>
            <dl>
                <dt>姓名</dt>
                <dd><?php echo ($data->data->realname); ?></dd>
            </dl>
            <dl>
                <dt>邮箱</dt>
                <dd><?php echo ($data->data->email); ?></dd>
            </dl>
            <dl>
                <dt>部门</dt>
                <dd><?php echo ($data->data->department); ?></dd>
            </dl>
            <dl>
                <dt>所属组</dt>
                <?php if(empty($group)): ?><dd>未分组</dd>
                <?php else: ?>
                <dd><?php echo ($group); ?></dd><?php endif; ?>
            </dl>
        </form>
    </div>
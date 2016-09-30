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
<div class="new-info" style="margin-left:-150px;">
    <h3>最新公告</h3>
    <?php if(empty($data)): ?><a href="<?php echo U('Notice/edit','',false);?>/id/<?php echo ($vo["id"]); ?>">修改公告</a>
        <a href="<?php echo U('Notice/add');?>">新增公告</a><?php endif; ?>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h2><?php echo ($vo["title"]); ?><span>发布时间：<?php echo ($vo["update_time"]); ?></span></h2>
        <a href="<?php echo U('Notice/edit','',false);?>/id/<?php echo ($vo["id"]); ?>">修改公告</a>
        <a href="<?php echo U('Notice/add');?>">新增公告</a>
        <div class="news">
            <?php echo ($vo["content"]); ?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="page-list-link">
    <?php echo ($page); ?>
<div>
</body>
</html>
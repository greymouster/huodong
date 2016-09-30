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
   <div class="new-info modify-info" style="margin-left:-150px;">
        <h3>最新公告</h3>
        <a href="<?php echo U('Notice/index');?>">最新公告</a>>><a href="#">新增公告</a>
        <form action=" " method="" onsubmit="return false;" >
            <input type="text" name="title" placeholder="请输入活动标题" />
            <div class="news">
                <textarea name="content"></textarea>
            </div>
            <dl>
                <dt><input type="submit" value="发布公告" class="acement-submit"/></dt>
                <dd><button class="cancel acement-cancel">取消</button></dd>
            </dl>
	    </form>
    </div>
</body>
</html>
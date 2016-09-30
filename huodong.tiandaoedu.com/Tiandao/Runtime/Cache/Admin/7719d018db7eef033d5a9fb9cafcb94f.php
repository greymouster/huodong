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
        <a href="<?php echo U('Notice/index');?>">最新公告</a>>><a href="javascript:;">修改公告</a>
        <form onsubmit="return false;">
            <input type="text" name="title" value="<?php echo ($data["title"]); ?>" placeholder="白皮书活动开始了" />
			<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            <div class="news">
                <textarea name="content" ><?php echo ($data["content"]); ?></textarea>
            </div>
            <dl>
                <dt><input class="acement-edit" type="submit" value="修改" /> </dt>
                <dd><button class="delete acement-delete">删除</button></dd>
                <dd><button class="cancel acement-cancel" onclick="window.history.go(-1)">取消</button></dd>
            </dl>
	    </form>
    </div>
</body>
</html>
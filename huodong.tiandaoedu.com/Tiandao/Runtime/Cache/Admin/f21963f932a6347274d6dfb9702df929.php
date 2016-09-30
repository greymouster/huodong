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
    <div class="info-manage info-url log" style="margin-left:-150px;">
        <h3>操作日志</h3>
        <div class="choose">
            <p class="p-choose">筛选</p>
            <dl>
                <form action="<?php echo U('System/adminLog');?>" method="GET" >
                <dd>
                    <select name="log_info">
                        <option value="0">操作类型</option>
                        <option >设为管理员</option>
                        <option >取消管理员</option>
                        <option >新增推广渠道</option>
                        <option>删除推广渠道</option>
                        <option>新增活动分类</option>
                        <option>删除活动分类</option>
                    </select>
                </dd>
                <dd><input type="submit" value="搜索" /> </dd>
                </form>
            </dl>
        </div>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">编号</li>
                <li class="li-sm">操作类型</li>
                <li>操作人</li>
                <li>IP</li>
                <li>操作时间</li>
            </ul>
        <?php if(is_array($log)): foreach($log as $key=>$vo): ?><ul>
                <li class="li-xs"><?php echo ($vo["id"]); ?></li>
                <li class="li-sm"><?php echo ($vo["log_info"]); ?></li>
                <li><?php echo ($vo["admin_name"]); ?></li>
                <li><?php echo ($vo["log_ip"]); ?></li>
                <li><?php echo ($vo["log_time"]); ?></li>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>
</body>
</html>
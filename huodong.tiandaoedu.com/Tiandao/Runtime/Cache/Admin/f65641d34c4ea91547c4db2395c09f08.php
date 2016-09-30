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
<div class="info-manage info-url act-sort" style="margin-left:-150px;">
        <h3>活动地点管理</h3>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">排序</li>
                <li class="li-sm">地点</li>
                <li>顺序调整</li>
                <li>操作</li>
            </ul>
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
                <li class="li-xs place-id"><?php echo ($vo["id"]); ?></li>
                <li class="li-sm"><?php echo ($vo["place_name"]); ?></li>
                <li>
                    <button class="place-sort-asc" sort-number="<?php echo ($vo["sort_number"]); ?>"><img src="/Public/Admin/images/u75.png" /> </button>
                    <button class="place-sort-desc" sort-number="<?php echo ($vo["sort_number"]); ?>"><img src="/Public/Admin/images/u751.png" /> </button>
                </li>
                <li>
                    <a class="delete place-delete" style="cursor:pointer">删除</a>
                   <!-- <div class="delete-box">
                        <h2>确定删除此地点？</h2>
                        <button class="yes">保存</button>
                        <button class="cancel">取消</button>
                    </div>-->
                </li>
            </ul><?php endforeach; endif; ?>
            <a href="javascript:;" class="add place-add" style="cursor:pointer">新增</a>
        </div>
        <!--<div class="reserve">
            <button type="submit">保存</button>
        </div>-->
    </div>
</body>
</html>
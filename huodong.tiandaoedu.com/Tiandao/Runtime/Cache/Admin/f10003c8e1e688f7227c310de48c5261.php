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
        <h3>活动分类管理</h3>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">排序</li>
                <li class="li-sm">分类</li>
                <li>顺序调整</li>
                <li>操作</li>
            </ul>
			<?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
                <li class="li-xs cate-id"><?php echo ($vo["id"]); ?></li>
                <li class="li-sm"><?php echo ($vo["cat_name"]); ?></li>
                <li>
				    
                    <button class="cate-sort-asc" sort-number="<?php echo ($vo["sort_number"]); ?>"><img src="/Public/Admin/images/u75.png" /> </button>
                    <button class="cate-sort-desc" sort-number="<?php echo ($vo["sort_number"]); ?>"><img src="/Public/Admin/images/u751.png"/> </button>
                </li>
                <li>
                    <a class="edit cate-edit" style="cursor:pointer">编辑</a>
                    <a class="delete cate-delete" style="cursor:pointer">删除</a>
                </li>
            </ul><?php endforeach; endif; ?>
            <a href="javascript:;" class="add cate-add" style="cursor:pointer">新增</a>
        </div>
    </div>
</body>
</html>
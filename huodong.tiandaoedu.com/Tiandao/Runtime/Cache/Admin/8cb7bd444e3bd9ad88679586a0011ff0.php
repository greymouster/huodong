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
	<div class="info-manage info-url ad-manage" style="margin-left: -150px;height:700px;">
        <h3>广告位管理</h3>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">ID号</li>
                <li class="li-sm">广告标题</li>
                <li>类型</li>
                <li>创建时间</li>
                <li>操作</li>
            </ul>
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
                <li class="li-xs ad-id"><?php echo ($vo["ad_id"]); ?></li>
                <li class="li-sm"><?php echo ($vo["ad_name"]); ?></li>
                <li><?php echo ($vo["media_type"]); ?></li>
                <li><?php echo ($vo["ad_time"]); ?></li>
                <li>
                    <a href="javascript:;" class="ad-edit" data-url="<?php echo U('Ad/editAd',array('ad_id'=>$vo[ad_id]));?>" >修改</a>
                    <a href="javascript:;" class="ad-delete">删除</a>
                </li>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>
</body>
</html>
<script>
//回调函数
function call_back(msg){
	if(msg>0){
		layer.msg('操作成功', {icon: 1,offset:'300px'});
		layer.closeAll('iframe');
        setTimeout(function(){
            window.location.reload();
        },1500);
	}else{
		layer.msg('操作失败', {icon: 3,offset:'300px'});
		layer.closeAll('iframe');
	}
}
</script>
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
    <div class="info-manage info-url activity-me" style="margin-left:-150px;height:1000px;">
        <h3>我的二维码</h3>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">编号</li>
                <li class="li-sm">所属活动</li>
                <li>渠道</li>
                <li>渠道名称</li>
                <li>渠道具体信息</li>
                <li>备注信息</li>
                <li class="li-lg">操作</li>
            </ul>
			<?php if(is_array($data)): foreach($data as $key=>$val): if($val["channel_qrcode"] != ''): ?><ul>
                <li class="li-xs"><?php echo ($val["id"]); ?></li>
                <li class="li-sm"><?php echo ($val["act_name"]); ?></li>
                <li><?php echo ($val["channel_name"]); ?></li>
                <li><?php echo ($val["channel_alias"]); ?></li>
                <li><?php echo ($val["channel_detal"]); ?></li>
                <li><?php echo ($val["channel_remarks"]); ?></li>
                <li class="li-lg">
                    <?php if($val["channel_qrcode"] != ''): ?><a href="<?php echo U('Activity/downFile',array('id'=>$val['id']));?>" >下载</a>
					<a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="show-qrcode">查看</a>
					<?php else: ?>
					    <a href="javascript:;" style="color:gray;">下载</a>
					    <a href="javascript:;" style="color:gray;">查看</a><?php endif; ?>
                    <a href="javascript:;" data-url="<?php echo ($val["channel_url"]); ?>"class="copy-url">复制推广URL</a>
                    <?php if($val["channel_qrcode"] != ''): ?><a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="del-qrcode">删除二维码</a>
					<?php else: ?>
					  <a href="javascript:;" style="color:gray;">删除二维码</a><?php endif; ?>
				</li>
            </ul><?php endif; endforeach; endif; ?>
        </div>
       <div class="page-list-link">
	     <?php echo ($page); ?>
	    <div>
    </div>
</body>
<script>
    $(function(){
        $('.account').click(function(){
            $(this).children('ul').css('display','block');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.account ul').css('display','none');
        })
        $('.pagnation li').click(function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
        })
    })
	
</script>
</html>
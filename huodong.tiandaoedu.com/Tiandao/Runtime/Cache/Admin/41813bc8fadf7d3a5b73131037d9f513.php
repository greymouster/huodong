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
    <div class="info-manage info-url" style="margin-left:-150px;height:800px;">
        <h3>活动信息管理</h3>
        <a href="info-manage.html">活动信息管理</a>>><a href="#">足以让你一生的生存礼仪培训课程</a>>><a href="info-url.html">查看URL和二维码</a>
        <div class="choose">
            <p class="p-choose">筛选</p>
            <dl>
                <dt>活动负责人：<span><?php echo ($user); ?></span></dt>
				<form action="" method="GET">
                <dd>
                    <select name="channel_id">
					     <option value="" >渠道</option>
					    <?php if(is_array($channelData)): foreach($channelData as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($_GET['channel_id']== $val['id']): ?>selected="selected"<?php endif; ?>><?php echo ($val["channel_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </dd>
                <dd><input type="submit" value="搜索" /> </dd>
				</form>
            </dl>
        </div>
        <a href="<?php echo U('Activity/exportAllData',array('id'=>I('get.act_id')));?>">批量导出URL到excel</a>
        <div class="table">
            <ul class="thead">
                <li class="li-xs">编号</li>
                <li class="li-sm">所属活动</li>
                <li>渠道</li>
                <li>渠道名称</li>
                <li>渠道具体信息</li>
                <li>备注</li>
                <li class="li-lg">操作</li>
            </ul>
			<?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
                <li class="li-xs"><?php echo ++$key;?></li>
                <li class="li-sm"><?php echo ($vo["act_name"]); ?></li>
                <li><?php echo ($vo["channel_name"]); ?></li>
                <li><?php echo ($vo["channel_alias"]); ?></li>
                <li><?php echo ($vo["channel_detal"]); ?></li>
                <li><?php echo ($vo["channel_remarks"]); ?></li>
                <li class="li-lg">
                    <a href="javascript:;" class="select_act" act-id="<?php echo ($vo["act_id"]); ?>">查看活动</a>
                    <a href="javascript:;" data-url="<?php echo ($vo["channel_url"]); ?>"class="copy-url">复制推广URL</a>
                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-url="<?php echo ($vo["channel_url"]); ?>" class="create_qrcode">生成二维码</a>
                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="del-channel-message">删除</a>
                </li>
            </ul><?php endforeach; endif; ?>
        </div>
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
    })
</script>
<script>
    $(function(){
        $(".select_act").click(function(){
            var actId = $(this).attr('act-id');
            layer.open({
                type: 2,
                title: '查看活动',
                shadeClose: true,
                area: ['640px', '750PX'],
                content: '/index.php/Admin/Activity/actPreview/act_id/'+actId,
            });
        });
    })
</script>
</html>
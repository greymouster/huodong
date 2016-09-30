<?php if (!defined('THINK_PATH')) exit();?><script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
	<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
	<script src="/Public/Admin/js/ancement.js"></script>
	<div class="table" target="#name">
            <ul class="thead">
                <li class="li-xs">编号</li>
                <li class="li-sm">所属活动</li>
                <li>渠道</li>
                <li>渠道名称</li>
                <li>渠道具体信息</li>
                <li>备注信息</li>
                <li class="li-lg">操作</li>
            </ul>
			<?php if(is_array($data)): foreach($data as $key=>$val): ?><ul>
                <li class="li-xs"><?php echo ($val["id"]); ?></li>
                <li class="li-sm"><?php echo ($val["act_name"]); ?></li>
                <li><?php echo ($val["channel_name"]); ?></li>
                <li><?php echo ($val["channel_alias"]); ?></li>
                <li><?php echo ($val["channel_detal"]); ?></li>
                <li><?php echo ($val["channel_remarks"]); ?></li>
                <li class="li-lg">
                    <a href="javascript:;" class="select_act" act-id="<?php echo ($val["act_id"]); ?>">查看活动</a>
                    <a href="javascript:;" data-url="<?php echo ($val["channel_url"]); ?>"  class="copy-url" >复制推广URL</a>
                    <a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" data-url="<?php echo ($val["channel_url"]); ?>" class="create_qrcode">生成二维码</a>
                    <a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="del-channel-message">删除</a>
                </li>
            </ul><?php endforeach; endif; ?>
          
          
        </div>
			<div class="page-list-link">
			 <?php echo ($page); ?>
			<div>
         </div> 
<script>
    $(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
	
	
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
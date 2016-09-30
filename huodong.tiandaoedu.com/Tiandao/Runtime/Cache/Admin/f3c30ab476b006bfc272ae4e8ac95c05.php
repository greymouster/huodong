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
<!--日期插件start-->
 <link rel="stylesheet" href="/Public/Admin/Plugins/datetimepicker/datetimepicker.css">
 <script src="/Public/Admin/Plugins/datetimepicker/datetimepicker.js"></script>
<!--日期插件end-->
    <div class="info-manage" style="margin-left:-150px;height:800px">
        <h3>活动信息管理</h3>
        <div class="choose">
            <p class="p-choose">筛选</p>
			<form action="<?php echo U('Activity/actMessage');?>" method="GET">
            <dl>
                <dt>活动负责人：<span><?php echo (session('realname')); ?></span></dt>
                <dd>
                    <select name="status">
                        <option value="">全部活动状态</option>
                        <option value="1" >未发布</option>
                        <option value="2" >待审核</option>
                        <option value="3" >审核通过</option>
                        <option value="4" >已上线</option>
                        <option value="5" >已结束</option>
                        <option value="6" >驳回</option>
                    </select>
                </dd>
                <dd>
                    <select name="actname">
                        <option value="" selected="selected">全部活动</option>
						<?php if(is_array($info)): foreach($info as $key=>$val): ?><option value="<?php echo ($val["act_name"]); ?>"><?php echo ($val["act_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </dd>
                <dd><input type="text" placeholder="开始时间" class="datetimepicker-date" name="start_time"/> </dd>
                <dd><input type="text" placeholder="结束时间" class="datetimepicker-date" name="end_time"/> </dd>
                <dd><input type="submit" value="搜索" /> </dd>
            </dl>
            </form>
        </div>
        <a href="javascript:;"class="out-put-line">批量下线</a>
        <div class="table">
            <ul class="thead">
                <li>
                    <input id="checkAll" type="checkbox" />全选
                </li>
                <li>活动名称</li>
                <li>活动地点</li>
                <li>活动时间</li>
                <li>活动类型</li>
                <li>活动状态</li>
            </ul>
			<?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul class="gray">
                <li><input name="chkItem" type="checkbox" value="<?php echo ($vo["act_id"]); ?>"/> </li>
                <li><?php echo ($vo["act_name"]); ?></li>
                <li><?php echo ($vo["place_name"]); ?></li>
                <li><?php echo ($vo["act_start_date"]); ?>-<?php echo ($vo["act_end_date"]); ?></li>
                <li><?php echo ($vo["cat_name"]); ?> </li>
				<?php if($vo["act_current_status"] == 6): ?><li class="current" style="color:red;" current-status="<?php echo ($vo["act_current_status"]); ?>"><?php echo ($vo["current_status"]); ?>:<?php echo ($vo["act_reason"]); ?></li>
				<?php else: ?>
				<li class="current" current-status="<?php echo ($vo["act_current_status"]); ?>"><?php echo ($vo["current_status"]); ?></li><?php endif; ?>				
		   </ul>
            <ul class="white">
                    <li>
                        <span><?php echo ($vo["act_success_time"]); ?></span>
						<?php if($vo["act_current_status"] == 4): ?><a href="javascript:;" class="disabled act-edit-data">编辑</a>
						<?php else: ?>
						 <a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="act-edit-data">编辑</a><?php endif; ?>
                        <a href="javascript:;" act-id= "<?php echo ($vo["act_id"]); ?>" class="select_act">查看</a>
                        <a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="act-delete-data">删除</a>
						<?php if($vo["act_current_status"] != 4): ?><a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="disabled" >下线</a>
                        <?php else: ?>
						<a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="act-out-line">下线</a><?php endif; ?>
						<a href="<?php echo U('Activity/actPromotion',array('act_id'=>$vo['act_id']));?>">活动推广</a>
                        <?php if($vo["act_current_status"] == 4): ?><a href="<?php echo U('Activity/actData',array('act_id'=>$vo['act_id']));?>">查看活动数据</a>
                        <?php else: ?>
                            <a href="javascript:;" style="color:gray;">查看活动数据</a><?php endif; ?>
                    </li>
            </ul><?php endforeach; endif; ?>
           
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
        //全选
        $('.info-manage .table .thead li #checkAll').click(function(){
            var flag=$(this).prop('checked');
            var ck = $("[name = 'chkItem']:checkbox").prop("checked", flag);
            $("[name = 'chkItem']:checkbox").click(function(){
                var flag2=$(this).prop('checked');
                $('.info-manage .table .thead li #checkAll').prop('checked',flag2);   
	    	})
        })
        /*页码*/
        $('.pagnation li').click(function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
        })
		
    $('.datetimepicker-date').datetimepicker({
		lang: 'ch',
		onGenerate: function(ct) {
            $(this).find('.xdsoft_date').toggleClass('xdsoft_disabled');
        },
		timepicker: false,
		format: 'Y-m-d',
		formatDate: 'Y-m-d',
		minDate: '-1970/01/02', // yesterday is minimum date
	  	maxDate: '+1970/01/02' // and tommorow is maximum date calendar
	});
})
//回调函数
function call_back(msg){
	if(msg>0){
		layer.msg('操作成功', {icon: 1});
		layer.closeAll('iframe');
		window.location.reload();
	}else{
		layer.msg('操作失败', {icon: 3});
		layer.closeAll('iframe');
	}
}
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
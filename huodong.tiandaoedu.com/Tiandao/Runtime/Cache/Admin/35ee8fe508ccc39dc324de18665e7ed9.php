<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
<link rel="stylesheet" href="/Public/Admin/css/style.css">
<script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
<script src="/Public/Admin/js/ancement.js"></script>
<!--日期插件start-->
<link rel="stylesheet" href="/Public/Admin/Plugins/datetimepicker/datetimepicker.css">
<script src="/Public/Admin/Plugins/datetimepicker/datetimepicker.js"></script>
<!--日期插件end-->
<script src="/Public/Admin/Plugins/jqueryform/jquery.form.js"></script>
<!--umeditor-->
<link href="/Public/Admin/Plugins/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/Admin/Plugins/umeditor/lang/zh-cn/zh-cn.js"></script>
<div class="publish-act">
        <div class="act-info" style="margin-left:-150px; width:100%;">
            <form id="editActivity" class="base-info" action="<?php echo U('Activity/edit');?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="act_id" value="<?php echo ($data['act_id']); ?>">
				<p class="title">填写基本资料</p>
                <dl>
                    <dt><h2>活动名称<span>*</span></h2></dt>
                    <dd><input type="text" name="act_name" value="<?php echo ($data["act_name"]); ?>"/> </dd>
                    <dd><h2>负责人：<i><?php echo (session('realname')); ?></i></h2></dd>
					<input type="hidden" name="act_charge_name" value="<?php echo (session('realname')); ?>">
                </dl>
                <dl>
                    <dt><h2>活动地点<span>*</span></h2></dt>
                    <dd>
                        <select name="place_id">
                            <option selected="selected" value="0">选择城市</option>
							<?php if(is_array($placeData)): foreach($placeData as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"<?php if($vo['id'] == $data['place_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["place_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </dd>
                    <dd><input type="text" placeholder="填写具体的活动地点" value="<?php echo ($data['spec_address']); ?>" name="spec_address"/></dd>
                </dl>
                <dl>
                    <dt><h2>活动分类<span>*</span></h2></dt>
                    <dd>
                        <select  name="cat_id">
                            <option value="0">选择分类</option>
                            <?php if(is_array($cateData)): foreach($cateData as $key=>$vo): ?><option  value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $data['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt><h2>活动费用<span>*</span></h2></dt>
                    <dd><input type="text" name="act_cost" value="<?php echo ($data['act_cost']); ?>"/>元</dd>
                </dl>
                <dl>
                    <dt><h2>活动是否需报名审核：</h2></dt>
                    <dd><input type="radio" name="act_status" value="0" <?php if($data['act_status'] == 0): ?>checked="checked"<?php endif; ?>/>否</dd>
                    <dd><input type="radio" name="act_status" value="1" <?php if($data['act_status'] == 1): ?>checked="checked"<?php endif; ?>/>是</dd>
                </dl>
                <dl>
                    <dt><h2>活动时间<span>*</span></h2></dt>
                    <div class="time">
                        <input type="text" name="act_start_date"  value="<?php echo ($data['act_start_date']); ?>"  class="datetimepicker-date"  placeholder="活动开始日期" />
                        <input type="text" name="act_start_time" value="<?php echo ($data['act_start_time']); ?>"  class="datetimepicker-time" placeholder="开始时间" />
                        到
                        <input type="text" name="act_end_date"  value="<?php echo ($data['act_end_date']); ?>"  class="datetimepicker-date" placeholder="活动结束日期" />
                        <input type="text" name="act_end_time" value="<?php echo ($data['act_end_time']); ?>" class="datetimepicker-time" placeholder="结束时间" />
                    </div>
                    <!--<dd><input type="radio" name="act_time_status" value="0" <?php if($data['act_time_status'] == 0): ?>checked="checked"<?php endif; ?>/>当天结束</dd>-->
                    <!--<dd>-->
                        <!--<input type="radio" name="act_time_status" value="1" <?php if($data['act_time_status'] == 1): ?>checked="checked"<?php endif; ?>/>连续多天-->
                        <!--<div class="box day">-->
                            <!--<input type="text" name="start_date" value="<?php echo ($data['act_start_date']); ?>" class="datetimepicker-date" placeholder="活动开始日期" />-->
                            <!--<input type="text" name="start_time" value="<?php echo ($data['act_start_time']); ?>" class="datetimepicker-time" placeholder="开始时间" />到-->
                           <!--<input type="text"  name="end_date"  value="<?php echo ($data['act_end_date']); ?>" class="datetimepicker-date" placeholder="活动结束日期" />-->
                           <!--<input type="text"  name="end_time" value="<?php echo ($data['act_end_time']); ?>" class="datetimepicker-time" placeholder="结束时间" />-->
                        <!--</div>-->
                    <!--</dd>-->
                    <!--<dd>-->
                        <!--<input type="radio" name="act_time_status" value="2" <?php if($data['act_time_status'] == 2): ?>checked="checked"<?php endif; ?>/>每周举办-->
                        <!--<div class="box week">-->
                            <!--<div class="rate">-->
                                <!--活动频率-->
                                <!--<input type="checkbox"  name="act_week[]" value="1" />周一-->
                                <!--<input type="checkbox"  name="act_week[]" value="2" />周二-->
                                <!--<input type="checkbox"  name="act_week[]" value="3" />周三-->
                                <!--<input type="checkbox"  name="act_week[]" value="4" />周四-->
                                <!--<input type="checkbox"  name="act_week[]" value="5" />周五-->
                                <!--<input type="checkbox"  name="act_week[]" value="6" />周六-->
                                <!--<input type="checkbox"  name="act_week[]" value="7" />周日-->
                            <!--</div>-->
                            <!--<div class="time">-->
                                <!--<input type="text" name="act_start_date" value="<?php echo ($data['act_start_date']); ?>" class="datetimepicker-date"  placeholder="活动开始日期" />到-->
                                <!--<input type="text" name="act_end_date" value="<?php echo ($data['act_end_date']); ?>" class="datetimepicker-date" placeholder="活动结束日期" />-->
                                <!--<input type="text" name="act_start_time" value="<?php echo ($data['act_start_time']); ?>" class="datetimepicker-time" placeholder="开始时间" />到-->
                                <!--<input type="text" name="act_end_time" value="<?php echo ($data['act_end_time']); ?>" class="datetimepicker-time" placeholder="结束时间" />-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</dd>-->
                </dl>
                <dl>
                    <dt><h2>活动上线时间<span>*</span></h2></dt>
                    <dd><input type="radio" class="act-online" name="act_online" value="1" <?php if($data['act_online'] == 1): ?>checked="checked"<?php endif; ?>/>审核后立即上线</dd>
                    <dd><input type="radio" class="act-online" name="act_online" value="2" <?php if($data['act_online'] == 2): ?>checked="checked"<?php endif; ?>/>审核通过后定时上线</dd>
                    <?php if($data['act_online'] == 2): ?><dd><input type="text" class="time datetimepicker-date" name="act_date" value="<?php echo ($data['act_date']); ?>" placeholder="请选择上线日期" /></dd>
                        <dd><input type="text" class="time datetimepicker-time" name="act_time" value="<?php echo ($data['act_time']); ?>" placeholder="请选择上线时间" /></dd>
                    <?php else: ?>
                        <dd><input type="text" class="time datetimepicker-date" name="act_date" value="" placeholder="请选择上线日期" /></dd>
                        <dd><input type="text" class="time datetimepicker-time" name="act_time" value="" placeholder="请选择上线时间" /></dd><?php endif; ?>

                </dl>
               <!-- <input type="submit" class="submit" value="保存" />
		</form>
		<form id="form1" action="<?php echo U('ReleaseActivity/add');?> " method="POST" enctype="multipart/form-data" >-->
            <div class="base-info overview">
                <p class="title">活动概览图</p>
                <div class="up-pic">
                    <input id="uploadImage" name="act_file" type="file" value="上传图片"/>
<!--                    <p>上传尺寸为XX;上传大小为XX.</p>-->
                </div>
                <div id="uploadPreview" style="background-image:url(/Public/Uploads/<?php echo ($data['act_file']); ?>)"></div>
            </div>
            <div class="base-info details">
                <p class="title">活动详情</p>
                <textarea id="edit_desc" name="act_desc"><?php echo ($data['act_desc']); ?></textarea>
            </div>

                <!--<p class="title">如何参加</p>-->
                <!--<textarea id="edit_how_part" name="act_how_part"><?php echo ($data['act_how_part']); ?></textarea>-->


		</form>
            <div class="bottom">

                <button type="button" class="yulan">预览</button>
                <button type="button" style="margin-top:20px;" class="edit-file-desc">修改</button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
/*活动时间弹框*/
$('.publish-act .base-info dl dd input[name="act_time_status"]').click(function(){
	var flag=$(this).prop('checked');
	if(flag==true){
		$(this).parent().find('.box').show();
		$(this).parent().siblings().find('.box').hide();
		//清空值
		$(this).parent().siblings().find(".box input[type='text']").val('');
		
	}
})
$('.act-online').click(function(){
   $(this).parent().parent().find('.time').val('');
});
/*图片预览*/
$("#uploadImage").on("change", function(){

     //alert(this.files[0].size/1024/1024 + "Mb");
	// Get a reference to the fileList
	var files = !!this.files ? this.files : [];
	// If no files were selected, or no FileReader support, return
	if (!files.length || !window.FileReader) return;
	// Only proceed if the selected file is an image
	if (/^image/.test( files[0].type)){
		// Create a new instance of the FileReader
		var reader = new FileReader();
		// Read the local file as a DataURL
		reader.readAsDataURL(files[0]);
		// When loaded, set image data as background of div
		reader.onloadend = function(){
			$("#uploadPreview").css("background-image", "url("+this.result+")");
		}
	}
	else {
		alert('请输入正确的图片格式');
	}
});

$(function(){
     $(".datetimepicker-time").datetimepicker({
	    datepicker:false,
		format : 'H:i',
		step :5
	 
	 });
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
	//在线编辑器
   UM.getEditor('edit_desc', {
	initialFrameWidth : '100%',
	initialFrameHeight : 450
   });
//   UM.getEditor('edit_how_part', {
//	initialFrameWidth : '100%',
//	initialFrameHeight : 450
//   });
   $(".next").click(function(){
       window.location.href = "<?php echo U('Activity/setForm');?>";
   });
})
</script>
<script>

    $(".yulan").click(function(){
        var actId = $(this).attr('data-id');
        if(!actId){
            layer.alert('请先保存',{icon:5});
            return false;
        }
        layer.open({
            type: 2,
            title: '编辑活动',
            shadeClose: true,
            shade: 0,
            area: ['640px', '750PX'],
            content: '/index.php/Admin/Activity/actPreview/act_id/'+actId,
        });
    });
</script>
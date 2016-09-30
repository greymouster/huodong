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
    <div class="info-extension" style="margin-left:-150px; height: 700px;">
        <h2>活动信息管理</h2>
        <a href="javascript:;">活动信息管理</a>>><a href="javascript:;">足以让你一生的生存礼仪培训课程</a>>><a href="javascript:;">活动推广</a>
        <div class="act-extension">
            <h5>足以让你一生的生存礼仪培训课程</h5>
            <p>TIPS:<br>常见的线上推广渠道有：微信，微博，论坛，QQ群，自媒体平台，短信群发，EDM等，请根据需要设置不同的跟踪链接。</p>
            <form id="channelForm">
			    <?php if(empty($data)): ?><a href="javascript:;" class="add-channel"><h4>增加推广渠道</h4></a><?php endif; ?>
                <ul>
                </ul>	
               <?php if(is_array($data)): foreach($data as $key=>$val): ?><dl style="display:block;height:30px;">
			       <?php if(!empty($data)): ?><input type="hidden" name="id[]" value="<?php echo ($val["id"]); ?>"><?php endif; ?>
			     <input type="hidden" name="act_id[]" value="<?php echo ($_GET['act_id']); ?>">
                    <dt>
                        <select name="channel_id[]">
						    <?php if(is_array($channelData)): foreach($channelData as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"<?php if($vo["id"] == $val['channel_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["channel_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </dt>
                    <div class="input">
                    <dd><input type="text" name="channel_detal[]"  value="<?php echo ($val["channel_detal"]); ?>" placeholder="请输入渠道具体信息" /> </dd>
                    <dd><input type="text" name="channel_alias[]"  value="<?php echo ($val["channel_alias"]); ?>"placeholder="请输入渠道名称"/> </dd>
                    <?php if($val["channel_remarks"] != '' ): ?><dd ><input type="text" name="channel_remarks[]" value="<?php echo ($val["channel_remarks"]); ?>" placeholder="请输入渠道名称"/> </dd><?php endif; ?>
                        </div>
                     <dd class="add-input"><a href="javascript:;" data-id="<?php echo ($val["id"]); ?>" class="del-channel-message">删除</a> </dd>
                    
				</dl><?php endforeach; endif; ?>
				<?php if(empty($data)): ?><input type="submit" class="add-channel-message" value="保存" />
				<?php else: ?>
				  <input type="submit" id="replace-class" class="edit-channel-message" value="修改" /><?php endif; ?>
				<?php if(empty($data)): ?><a href="javascript:;" class="disabled">查看URL和二维码</a>
				<?php else: ?>
				<a href="<?php echo U('Activity/show',array('act_id'=>I('get.act_id')));?>">查看URL和二维码</a>
                    <input type="button"  class="addChannel" value="增加新的推广渠道"  data-url="<?php echo U('Activity/adChannel',array('act_id'=>I('get.act_id')));?>" style="margin-left: 45px; background: #fff;border-radius: 4px;border: 1px solid #000;"/><?php endif; ?>
            </form>
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
        //全选
        $('.info-manage .table .thead li #checkAll').click(function(){
            $("[name = chkItem]:checkbox").attr("checked", true);
        })
        $("[name = chkItem]:checkbox").bind("click", function () {
            var $chk = $("[name = chkItem]:checkbox");
            $("#chkAll").attr("checked", $chk.length == $chk.filter(":checked").length);
        })
		
		//点击增加
		$(".add-channel").click(function(){
		　　$(this).parent().parent().find("#replace-class").val('添加');　
		    $(this).parent().parent().find("#replace-class").removeClass().addClass('add-channel-message');　
		  　var str ='<li>';
        	   str +='<dl style="display:block;height:30px;"><dt>';
			   str +='<input type="hidden" name="act_id[]" value="<?php echo ($_GET['act_id']); ?>">';
               str +='<select name="channel_id[]">';     
               str +='<?php if(is_array($channelData)): foreach($channelData as $key=>$vo): ?>';			   
               str +='<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["channel_name"]); ?></option>';
			   str +='<?php endforeach; endif; ?>';	
               str +='</select>';			   
               str +='</dt>';
                str +='<div class="input">';
               str +='<dd ><input type="text" name="channel_detal[]" value="" placeholder="请输入渠道具体信息" /> </dd>';
               str +='<dd class="last"><input type="text" name="channel_alias[]" value="" placeholder="请输入渠道名称"/> </dd>';
                str +='</div>';
               str +='<dd><a href="javascript:;" class="delete">删除</a> </dd>';
				   
               str +='</dl></li>'; 		   
			$(this).next().append(str);
		});
        $('body').on('click','a.delete',function(){
            $(this).parent('dd').parent('dl').remove();
        })
        $('body').on('change','dl select',function(){
            var other=$(this).find('option:selected');
            /*alert(other.html());*/
            if(other.html()=="其他"){
                /*alert(1);*/
                var dd='<dd class="last"><input type="text" name="channel_remarks[]" value="" placeholder="请输入其他信息"/> </dd>';
                var div=$(this).parent('dt').siblings('.input');
                $(dd).appendTo(div);
            }
        })

        $(".addChannel").click(function(){
            var url = $(this).attr('data-url');
            layer.open({
                type: 2,
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 1, //不显示关闭按钮
                shift: 2,
                shadeClose: false, //开启遮罩关闭
                area: ['700px', '200px'],
                content: url
            });
        });
    })
</script>
<script>
    function call_back(msg){
        if(msg>0){
            layer.msg('添加成功',{icon:6});
            layer.closeAll('iframe');
            window.location.reload();
        }else{
            layer.alert('添加失败',{icon:5});
        }
    }
</script>
</html>
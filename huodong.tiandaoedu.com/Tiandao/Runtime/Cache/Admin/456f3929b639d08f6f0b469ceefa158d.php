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
    <div class="info-manage info-url activity-me" style="margin-left:-150px;height:1000px">
        <h3>我推广的活动</h3>
        <div class="choose">
            <p class="p-choose">筛选</p>
            <dl>
                <dt>活动负责人：<span><?php echo ($username); ?></span></dt>
				<form id="search-form2"  action="<?php echo U('Activity/exportExel');?>" method="get">
                <dd>
                    <select name="act_id">
                           <option value="">所属活动</option>
                        <?php if(is_array($act)): foreach($act as $key=>$vo): ?><option value="<?php echo ($vo["act_id"]); ?>" <?php if($_GET['act_id']== $vo['act_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["act_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </dd>
                <dd>
                    <select name="act_current_status">
                        <option value="">全部活动状态</option>
                        <option value="1" <?php if($_GET['act_current_status']== 1): ?>selected="selected"<?php endif; ?>>未发布</option>
                        <option value="2" <?php if($_GET['act_current_status']== 2): ?>selected="selected"<?php endif; ?>>待审核</option>
                        <option value="3" <?php if($_GET['act_current_status']== 3): ?>selected="selected"<?php endif; ?>>审核通过</option>
                        <option value="4" <?php if($_GET['act_current_status']== 4): ?>selected="selected"<?php endif; ?>>已上线</option>
                        <option value="5" <?php if($_GET['act_current_status']== 5): ?>selected="selected"<?php endif; ?>>已结束</option>
                        <option value="6" <?php if($_GET['act_current_status']== 6): ?>selected="selected"<?php endif; ?>>驳回</option>
                    </select>
                </dd>
                <dd><input type="button" value="筛选" onclick="ajax_get_table('search-form2',1)" class="search-data"/> </dd>
                 <dd><input type="submit" value="导出" class="export-exel"/> </dd>              
			  </form>
             
            </dl>
        </div>
    <div id="ajax_return" height="100%">
      
    </div>
    </div>
</body>
<script>
 // ajax 抓取页面
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/index.php/Admin/Activity/ajax_return/p/"+page,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#ajax_return").html('');
                    $("#ajax_return").append(data);
                }
            });
    }
    $(function(){
	
	    ajax_get_table('search-form2',1);
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
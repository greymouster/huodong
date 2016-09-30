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
    <div class="info-manage info-url total-data" style="margin-left:-150px;height:1000px">
        <h3>活动数据统计</h3>
        <div class="choose">
            <p class="p-choose">筛选</p>
          <form id="search-form2"  action="<?php echo U('Online/exportExel');?>" method="get">
            <dl>
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
                <dd><input type="text" name="start_date" class="datetimepicker-date" placeholder="开始时间" /> </dd>
                <dd><input type="text" name="end_date" class="datetimepicker-date" placeholder="结束时间" /> </dd>
                <dd><input type="button" value="搜索"  onclick="ajax_get_table('search-form2',1)" class="search-data" /> </dd>
                <dd><input type="submit" value="导出" /> </dd>
            </dl>
            </form>
        </div>
        <div id="ajax_table">
            
        </div>
</body>
<script type="text/javascript">
    $(function(){
         ajax_get_table('search-form2',1);
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
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
        $.ajax({
            type : "POST",
            url:"/index.php/Admin/Online/ajax_return/p/"+page,
            data : $('#'+tab).serialize(),// 你的formid
            success: function(data){
                $("#ajax_table").html('');
                $("#ajax_table").append(data);
            }
        });
    }
</script>

</html>
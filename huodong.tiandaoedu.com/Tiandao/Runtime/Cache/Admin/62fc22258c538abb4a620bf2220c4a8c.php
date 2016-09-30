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
    <div class="info-manage act-online join-sh" style="margin-left:-150px;">
        <h3>报名审核</h3>
                <div class="choose">
            <p class="p-choose">筛选</p>
            <form action="<?php echo U('Enter/index');?>" method="GET">
            <dl>
                <dt>活动负责人：<span><?php echo (session('realname')); ?></span></dt>
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
        <div class="table join-info">
            <ul class="thead">
                <li>学生姓名</li>
                <li>学生电话</li>
                <li>电子邮件</li>
                <li>活动名称</li>
                <li>状态</li>
                <li>报名审核</li>
            </ul>
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
                <li><?php echo ($vo["user_name"]); ?><br><a href="<?php echo U('Enter/info',array('id'=>$vo['act_id']));?>">查看</a> </li>
                <li><?php echo ($vo["phone"]); ?></li>
                <li><?php echo ($vo["email"]); ?></li>
                <li><?php echo ($vo["act_name"]); ?></li>
                <?php if($vo["act_status"] == 0 || $vo["status"] == 1): ?><li><img src="/Public/Admin/images/dui.jpg" />已处理 </li>
                    <?php else: ?>
                    <li><img src="/Public/Admin/images/cuo.jpg" />未处理 </li><?php endif; ?>
                <li>
                    <!--<?php if($vo["status"] == 0 && $vo["act_status"] == 0): ?>-->
                    <!--<a href="javascript:;" style="color:gray;">是否通过</a>-->
                    <!--<?php endif; ?>-->
                    <?php if($vo["status"] == 0): ?><a href="javascript:;" data-id="<?php echo ($vo["act_id"]); ?>" class="pass" style="text-align:center;cursor: pointer;">是否通过</a><?php endif; ?>
                    <?php if($vo["status"] == 1): ?><a href="javascript:;">通过</a><?php endif; ?>
                    <?php if($vo["status"] == 2): ?><a href="javascript:;">不通过</a><?php endif; ?>
                    <!-- <div class="pass-box">
                        <h6>提示</h6>
                        <p>确定要处理么？</p>
                        <button class="yes">通过</button>
                        <button class="cancel">取消</button>
                    </div> -->
                </li>
            </ul><?php endforeach; endif; ?>
        </div>
    </div>
</body>
<script>
    $(function(){
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
</script>
</html>
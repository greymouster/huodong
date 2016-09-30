<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>活动预览</title>

    <link href="/Public/Admin/css/style1.css" rel="stylesheet" type="text/css">
    <link href="/Public/Admin/css/index.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/styleXi.css" rel="stylesheet" type="text/css" />
    <style>
        table tr td{border:solid 1px #ddd;}
    </style>

</head>
<body>


<div class="msBox msBoxLast">
    <div class="content-heading pb0">
        <img src="<?php echo ($data['act_file']); ?>" class="responsive-image">
        <h3><a href="#"><?php echo ($data['act_name']); ?></a></h3>
    </div>
    <div class="content content_indexx">
        <div class="allTxt1">
            <div class="container no-bottom dIcon dIcons">
                <dl>
                    <dt class="thumb-left"><img src="/Public/Admin/images/dIcon_01.png" alt="" /></dt>
                  <dd class="dsss">
                        <p class="p_add"><?php echo ($data['act_start_date']); ?>-<?php echo ($data['act_end_date']); ?> 每天 <?php echo ($data['act_start_time']); ?>-<?php echo ($data['act_end_time']); ?></p>
                    </dd>
                    <!--<?php if($data["act_time_status"] == 0): ?>-->
                        <!--<dd class="dsss">-->
                            <!--<p class="p_add"><?php echo ($data["act_start_date"]); ?> <?php echo ($data["act_start_time"]); ?></p>-->
                        <!--</dd>-->
                    <!--<?php endif; ?>-->
                    <!--<?php if($data["act_time_status"] == 1): ?>-->
                        <!--<dd class="dsss">-->
                            <!--<p class="p_add"><?php echo ($data["act_start_date"]); ?>-<?php echo ($data["act_end_date"]); ?> 每天 <?php echo ($data["act_start_time"]); ?>-<?php echo ($data["act_end_time"]); ?></p>-->
                        <!--</dd>-->
                    <!--<?php endif; ?>-->
                    <!--<?php if($data["act_time_status"] == 2): ?>-->
                        <!--<dd class="dsss">-->
                            <!--<p class="p_add"><?php echo ($data["act_start_date"]); ?>-<?php echo ($data["act_end_date"]); ?> <?php echo ($data["act_week"]); ?>  <?php echo ($data["act_start_time"]); ?>-<?php echo ($data["act_end_time"]); ?></p>-->
                        <!--</dd>-->
                    <!--<?php endif; ?>-->
                </dl>
                <dl>
                    <dt class="thumb-left"><img src="/Public/Admin/images/dIcon_02.png" alt="" /></dt>
                    <dd class="dsss">
                        <?php if($data['act_cost'] == 0): ?><p class="lastP p_add"><span class="time">免费</span></p>
                            <?php else: ?>
                            <p class="lastP p_add"><span class="time" style="color:black;"><?php echo ($data['act_cost']); ?></span></p><?php endif; ?>
                    </dd>
                </dl>
                <dl>
                    <dt class="thumb-left d2"><img src="/Public/Admin/images/dIcon_03.png" alt="" /></dt>
                    <dd class="bdnone">
                        <strong><?php echo ($data['place_name']); ?></strong>
                        <p class="lastP p_add"><?php echo ($data['spec_address']); ?></p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<!--活动详情-->
<div class="xq">
    <div class="xq_con">
        <div class="nei">
            <address style="width:96%;text-align:left;">活动详情</address>
            <div style="clear:both;"></div>
            <div class="act_desc"><?php echo ($data["act_desc"]); ?></div>
        </div>

    </div>
</div>

</body>
</html>
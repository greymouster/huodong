<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天道活动管理平台</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
	<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
	<script src="/Public/Admin/js/ancement.js"></script>
</head>
<body>
<div class="home-top" >
    <h2>活动管理平台</h2>
    <?php if($_SESSION['act_list']== 'all'): ?><p>欢迎  <?php echo (session('realname')); ?>（超级管理员）</p>
    <?php else: ?>
    <p>欢迎  <?php echo (session('realname')); ?> (普通管理员)</p><?php endif; ?>
    <div class="account">
        我的账号
        <ul>
            <li><a href="<?php echo U('Admin/info');?>" target="rightContent">查看账号</a> </li>
            <li><a href="<?php echo U('Admin/loginOut');?>">退出账号</a> </li>
        </ul>
    </div>
</div>
<script>
    $(function(){
        $(".account").click(function(){
            $('.account ul').toggle();
        })
    })
</script>

<div class="home-left">
        <ul>
            <?php if(is_array($parentAuth)): foreach($parentAuth as $key=>$v): ?><li><h3><?php echo ($v['auth_name']); ?></h3></li>
              <?php if(is_array($subAuth)): foreach($subAuth as $key=>$vv): if($v['id'] == $vv['parent_id'] ): ?><li onclick="makecss(this,<?php echo ($vv['id']); ?>)" id="menu_<?php echo ($vv["id"]); ?>"><a href="<?php echo U($vv['module_name'].'/'.$vv['controller_name'].'/'.$vv['acttion_name']); ?>" target='rightContent'><?php echo ($vv['auth_name']); ?></a></li><?php endif; endforeach; endif; endforeach; endif; ?>
            
<!--            <li><h3>活动公告</h3></li>
            <li><a href="<?php echo U('Notice/index');?>">最新公告</a> </li>
            <li><h3>活动推广</h3></li>
            <li><a href="<?php echo U('Activity/release');?>">发布新活动</a> </li>
            <li><a href="<?php echo U('Activity/actMessage');?>">活动信息管理</a> </li>
            <li><a href="<?php echo U('Activity/myActMessage');?>">我推广的活动</a> </li>
            <li><a href="<?php echo U('Activity/myQRcode');?>">我的二维码</a> </li>
            <li><h3>活动上线</h3></li>
            <li><a href="<?php echo U('Online/index');?>">活动上线审核</a> </li>
            <li><a href="<?php echo U('Online/totalData');?>">活动数据统计</a> </li>
            <li><h3>报名管理</h3></li>
            <li><a href="<?php echo U('Enter/index');?>">报名审核</a> </li>
            <li><h3>系统管理</h3></li>
            <li><a href="<?php echo U('System/authInfo');?>">权限管理</a> </li>
            <li><a href="<?php echo U('System/category');?>">活动分类管理</a> </li>
            <li><a href="<?php echo U('System/place');?>">活动地点管理</a> </li>
            <li><a href="<?php echo U('System/channel');?>">推广渠道管理</a> </li>
            <li><a href="log.html">操作日志</a> </li>
            <li><h3>广告位</h3></li>
            <li><a href="<?php echo U('Ad/ad');?>">新增广告位</a> </li>
            <li><a href="<?php echo U('Ad/adList');?>">广告位管理</a> </li>-->
        </ul>
</div>
<script>
    var tmpmenu = 1;
    function makecss(obj,mod_id){
	$('#menu_'+tmpmenu).children('a').removeClass('active');
	$(obj).children('a').addClass('active');
	tmpmenu = mod_id;
}
</script>
<div style="margin:0px;padding:0px;margin-left:180px;height:100%;">
    <iframe  id="iframe" width="100%"   name="rightContent" frameborder=0 scrolling="no" src="<?php echo U('Admin/info');?>"></iframe>
</div>


<script type="text/javascript">

$("#iframe").load(function () {
    var mainheight = $(this).contents().find("body").height() + 30;
    $(this).height(mainheight);
    $(document).scrollTop(0);
});
</script>
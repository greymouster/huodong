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
<script src="/Public/Admin/Plugins/jqueryform/jquery.form.js"></script>
    <div class="account-info edit-group" style="margin-left:-150px;height:600px">
        <h3>权限管理</h3>
        <a href="limit-mana.html">权限管理</a>>><a href="edit-group.html">编辑小组</a>
        <form>
            <dl>
                <dt><h3>组名称</h3></dt>
                <dd><input type="text" name="group_name"  data-id="<?php echo ($_GET['group_id']); ?>" value="<?php echo ($data['group_name']); ?>" placeholder="编辑组" /> </dd>
            </dl>
            <dl>
                <dt><h3>组员列表</h3></dt>
                <dd>
                    <?php if(is_array($user)): foreach($user as $key=>$vo): ?><span><?php echo ($vo['realname']); ?><button type="button" data-id="<?php echo ($vo['admin_id']); ?>"class="delete-user"><img src="/Public/Admin/images/u39.jpg"  /></button></span><?php endforeach; endif; ?>
                </dd>
            </dl>
            <dl>
                <dt><h3>添加组员</h3></dt>
                <dd><input type="search" placeholder="按姓名搜索" class="search"/> </dd>
                <a href="javascript:;" data-id ="<?php echo ($_GET['group_id']); ?>" class="addUser">加入本组</a>
            </dl>
            <ul class="add-li">
            </ul>
            <div class="reserve">
                <button type="button" class="edit-group edit-user-group">保存设置</button>
            </div>
        </form>
        <h4>加入本组后的人将显示在组员列表中，成员横向展示点击组员列表的名字右侧会显示叉子，可移出本组</h4>
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
        /*删除组员*/
        $('.edit-group form dl dd span').click(function(){
           $(this).children("button").show();
        })
    })
</script>
</html>
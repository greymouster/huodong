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
    <div class="join-detail" style="margin-left:-150px;">
        <h3>权限管理</h3>
             <a href="<?php echo U('System/addPerson');?>" style="font-size: 18px;margin-bottom:10px; ">新增用户</a> 
        <div class="limit-mana">
            <div class="limit-left">
                <dl>
                    <dt><h3>人员管理</h3></dt>
                    <form  action="<?php echo U('System/authInfo');?>" method="get">
                    <dd class="search"><input type="search" name="realname"  placeholder="按姓名搜索" /> </dd>
                    </form>
                </dl>
                <div class="content-box">
                    <?php if(is_array($userData)): foreach($userData as $key=>$vo): ?><dl>
                        <dt><input type="checkbox" name="name" id="name" /><?php echo ($vo["realname"]); ?></dt>
                        <dd style="display: none;">
                            <a href="<?php echo U('Admin/info',array('id'=>$vo[admin_id]));?>">查看</a>
                            <a href="<?php echo U('System/editGroup',array('group_id'=>$vo['group_id']));?>">编辑小组</a>
                            <a href="<?php echo U('System/editAuth',array('id'=>$vo[admin_id]));?>">修改权限</a>
                            <?php if($vo['is_lock'] != '禁用'): ?><a href="javascript:;" data-id="<?php echo ($vo['admin_id']); ?>" class="person-dis">封禁用户</a>
                            <?php else: ?>
                            <a href="javascript:;" data-id="<?php echo ($vo['admin_id']); ?>" class="person-dis">已禁用</a><?php endif; ?>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl><?php endforeach; endif; ?>
                </div>
               
<!--                <div class="page">
                    <ul>
                        <li class="active"><a href="#">1</a> </li>
                        <li><a href="#">2</a> </li>
                        <li><a href="#">3</a> </li>
                        <li><a href="#">下一页》</a> </li>
                        <li>(1-25/64)每页显示：25,50,100</li>
                    </ul>
                </div>-->
            </div>
             <div class="page page-list-link" >
                    <?php echo ($page); ?>
               <div>
            <div class="limit-right">
                <h2>组</h2>
                <a href="<?php echo U('System/addGroup');?>">新建小组</a>
                <p>显示所有人员</p>
                <?php if(is_array($groupData)): foreach($groupData as $key=>$val): ?><dl>
                    <dt><button><?php echo ($val["group_name"]); ?></button></dt>
                    <dd><a href="<?php echo U('System/editGroup',array('group_id'=>$val['id']));?>">编辑小组</a> </dd>
                </dl><?php endforeach; endif; ?>
<!--                <dl>
                    <dt><button>市场部</button></dt>
                    <dd><a href="edit-group.html">编辑小组</a> </dd>
                </dl>
                <dl>
                    <dt><button>睿德组</button></dt>
                    <dd><a href="edit-group.html">编辑小组</a> </dd>
                </dl>
                <dl>
                    <dt><button>未分组</button></dt>
                </dl>-->
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</body>
<script>
    $(function(){

        /*勾选姓名，出现蓝色的字*/
        $('.limit-mana .limit-left dl dt input[type="checkbox"]').click(function(){
            var check = $(this).prop('checked');
            if(check==true){
                $(this).parent().next('dd').css('display','block');
            }
            else{
                $(this).parent().next('dd').css('display','none');
            }
        })
        /*弹框*/
//        $('.limit-mana .limit-left dl dd .person-dis').click(function(){
//            $(this).parent().find('.dis-box').css('display','block');
//            $(this).parent().parent().siblings().find('.box').css('display','none');
//            event.stopPropagation();
//        })
//        $('.limit-mana .limit-left dl dd .dis-box').click(function(){
//            $(this).show();
//            event.stopPropagation();
//        })
//        $('.limit-mana .limit-left dl dd .cancle').click(function(){
//            $(this).parent().css('display','none');
//            event.stopPropagation();
//        })
//        $(document).click(function(){
//            $('.limit-mana .limit-left dl dd .dis-box').hide();
//        })
//        /*页码*/
//        $('.limit-mana .limit-left .page ul li a').click(function(){
//            $(this).parent().addClass('active');
//            $(this).parent().siblings().removeClass('active');
//        })
        
        //根据用户名搜所
        $("input[name='realname']").bind("change",function(){
            $("form").submit();
        });
    })
</script>
</html>
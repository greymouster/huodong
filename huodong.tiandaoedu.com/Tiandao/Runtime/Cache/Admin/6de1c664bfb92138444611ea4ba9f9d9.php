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
    <div class="info-manage act-online" style="margin-left:-150px;">
        <h3>活动上线审核</h3>
        <div class="choose">
            <p class="p-choose">查询条件</p>
            <form action="<?php echo U('Online/index');?>" method="get">
            <dl>
                <dt>选择组：</dt>
                <dd>
                    <select name="group_id">
                        <option value="">--小组名称--</option>
                        <?php if(is_array($groupData)): foreach($groupData as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($_GET['group_id']== $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["group_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>活动地点：</dt>
                <dd>
                 <?php foreach($placeData as $key=>$v1):?>
                    <input type="checkbox" name="placeid[]" 
                         <?php foreach(I('get.placeid') as $k=>$v){ if($v == $v1['id']){ echo "checked='checked'"; } }?>
                    value="<?php echo $v1['id']?>"/><?php echo $v1['place_name']?>&nbsp;&nbsp;&nbsp; 
                <?php endforeach;?> 
                  <!--<?php if(is_array($placeData)): foreach($placeData as $key=>$v1): ?><input type="checkbox" name="placeid[]" value="<?php echo ($v1["id"]); ?>"/><?php echo ($v1["place_name"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>-->
                </dd>
            </dl>
            <dl>
                <dt>活动时间：</dt>
                <dd><span>从</span><input type="text" placeholder="开始时间" class="datetimepicker-date" name="start_date" value="<?php echo ($_GET['start_date']); ?>"/></dd>
                <dd><span>到</span><input type="text" placeholder="结束时间" class="datetimepicker-date" name="end_date" value="<?php echo ($_GET['end_date']); ?>"/> </dd>
            </dl>
            <dl>
                <dt>关键字：</dt>
                <dd><input type="text" value="<?php echo ($_GET['actname']); ?>" placeholder="请输入活动名称" name="actname" /> </dd>
            </dl>
            <dl>
                <dt>活动类型：</dt>
                <dd>
				   <?php foreach($cateData as $key=>$v1):?>
                        <input type="checkbox" name="cateid[]" 
                            <?php foreach(I('get.cateid') as $k=>$v){ if($v == $v1['id']){ echo "checked='checked'"; } }?>  value="<?php echo $v1['id']?>"/><?php echo $v1['cat_name']?>&nbsp;&nbsp;&nbsp; 
                     <?php endforeach;?> 
                    <!--<?php if(is_array($cateData)): foreach($cateData as $key=>$v): ?><input type="checkbox" name="catid[]" value="<?php echo ($v["id"]); ?>"/><?php echo ($v["cat_name"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>-->
                </dd>
            </dl>
            <dl>
                <dt>活动状态：</dt>
                <dd>
                    <select name="status">
                        <option value="">全部活动状态</option>
                        <option value="1" <?php if($_GET['status']== 1): ?>selected="selected"<?php endif; ?>>未发布</option>
                        <option value="2" <?php if($_GET['status']== 2): ?>selected="selected"<?php endif; ?>>待审核</option>
                        <option value="3" <?php if($_GET['status']== 3): ?>selected="selected"<?php endif; ?>>审核通过</option>
                        <option value="4" <?php if($_GET['status']== 4): ?>selected="selected"<?php endif; ?>>已上线</option>
                        <option value="5" <?php if($_GET['status']== 5): ?>selected="selected"<?php endif; ?>>已结束</option>
                        <option value="6" <?php if($_GET['status']== 6): ?>selected="selected"<?php endif; ?>>驳回</option>
                    </select>
                </dd>
            </dl>
            <input class="choose-btn" type="submit" value="筛选" />
        </form>
        </div>
        <button class="online">批量审核上线</button>
        <div class="table">
            <ul class="thead">
                <li>
                    <input  id="checkAll" name="checkAll" type="checkbox" />全选
                </li>
                <li>活动名称</li>
                <li>活动地点</li>
                <li>活动时间</li>
                <li>活动类型</li>
                <li>活动状态</li>
            </ul>
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul class="gray">
                    <li><input name="chkItem" type="checkbox" class="aa" value="<?php echo ($vo["act_id"]); ?>" /> </li>
                    <li><?php echo ($vo["act_name"]); ?></li>
                    <li><?php echo ($vo["place_name"]); ?></li>
                    <li><?php echo ($vo["act_start_date"]); ?>-<?php echo ($vo["act_end_date"]); ?></li>
                    <li><?php echo ($vo["cat_name"]); ?></li>
                    <?php if($vo["act_current_status"] == 6): ?><li style="color:red;"><?php echo ($vo["current_status"]); ?>:<?php echo ($vo["act_reason"]); ?></li>
                    <?php else: ?>
                         <li class="current" current-status="<?php echo ($vo["act_current_status"]); ?>"><?php echo ($vo["current_status"]); ?></li><?php endif; ?>
                </ul>
                <ul class="white">
                    <li>
                        <span><?php echo ($vo["act_success_time"]); ?></span>
                        <a href="javascript:;" class="select_act" act-id="<?php echo ($vo["act_id"]); ?>">查看</a>
                        <!--根据状态显示不同的样式-->
                        <?php if($vo["act_current_status"] == 4): ?><a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="sh reback-sh">撤销审核</a><?php endif; ?>
                        <?php if($vo["act_current_status"] == 2): ?><a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="sh check-sh">审核</a><?php endif; ?>
                        <?php if(($vo["act_current_status"] != 2) and ( $vo["act_current_status"] != 3)): ?><a href="javascript:;" style="color:gray;">审核</a><?php endif; ?>
                        <?php if($vo["act_current_status"] == 4): ?><a href="<?php echo U('Activity/actData',array('act_id'=>$vo['act_id']));?>">查看活动数据</a>
                        <?php else: ?>
                            <a href="javascript:;" style="color:gray;">查看活动数据</a><?php endif; ?>
                        <?php if($vo["act_is_top"] != 50): ?><a href="javascript:;" act-id="<?php echo ($vo["act_id"]); ?>" class="top-b">取消置顶</a>
                        <?php else: ?>
                             <a href="javascript:;" data-url="<?php echo U('Online/top',array('act_id'=>$vo['act_id']));?>" class="top-a">置顶</a><?php endif; ?>
                        <!--两个弹框
                        <div class="sh-box">
                            <p>是否审核通过</p>
                            <button class="close">X</button>
                            <button class="yes">审核通过</button>
                            <button class="no">驳回</button>
                        </div>
                        <div class="cancle-box">
                            <p>是否撤销审核</p>
                            <button class="close">X</button>
                            <button class="yes">是</button>
                            <button class="no">否</button>
                        </div>
                        <div class="refuse-box">
                            <p>请输入驳回理由</p>
                            <button class="close">X</button>
                            <input type="text" />
                            <button type="submit">确定</button>
                        </div>-->
                    </li>
                </ul><?php endforeach; endif; ?>
        </div>
        <div class="page-list-link">
		 <?php if($data != '' ): echo ($page); endif; ?>
         <div>
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
        /*$('.account').click(function(){
            $(this).children('ul').css('display','block');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.account ul').css('display','none');
        })*/
        //全选
        $('.info-manage .table .thead li #checkAll').click(function(){
            var flag=$(this).prop('checked');
            $("[name = chkItem]:checkbox").prop("checked", flag);
            $("[name = chkItem]:checkbox").click(function(){
                var flag2=$(this).prop('checked');
                $('.info-manage .table .thead li #checkAll').prop('checked',flag2);
            })
        })
       
        /*弹框*/
        /*$('.act-online .table .white li .sh').click(function(){
            $(this).parent().find('.sh-box').css('display','block');
            event.stopPropagation();
        })
        $('.act-online .table .white li .sh-box .yes').click(function(){
            $(this).parent().css('display','none');
            $(this).parent().parent().find('.sh').text('撤销审核');
            event.stopPropagation();
        })
        $('.act-online .table .white li .sh-box .no').click(function(){
            $(this).parent().next('.refuse-box').css('display','block');
            $(this).parent().parent().find('.sh').text('撤销审核');
            event.stopPropagation();
        })
        $('.act-online .table .white li button.close').click(function(){
            $(this).parent().css('display','none');
            event.stopPropagation();
        })
        $('.act-online .table .white li .sh-box').click(function(){
            $(this).show();
            event.stopPropagation();
        })
        $('.act-online .table .white li .refuse-box').click(function(){
            $(this).show();
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.act-online .table .white li .sh-box').hide();
            $('.act-online .table .white li .refuse-box').hide();
        })
        /*页码
        $('.pagnation li').click(function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
        })
        //置顶弹出小网页
        $('.act-online .table .white li .top-a').click(function(){
            window.open('top.html','','width=600,height=500,top=200,left=500,location=yes');
        })*/
    })

    function call_back(msg){
        if(msg>0){
            layer.msg('操作成功', {icon: 6});
            layer.closeAll('iframe');
            window.location.href = "<?php echo U('Online/index');?>";
        }else{
            layer.msg('操作失败', {icon: 5});
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
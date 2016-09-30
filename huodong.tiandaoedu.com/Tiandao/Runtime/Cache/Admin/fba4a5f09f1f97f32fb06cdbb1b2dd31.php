<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        select{
              height: 30px;
        }
        dt{
            float: left;
            margin: 0 10px;
        }
        dd input{
            float: left;
            height: 25px;
            margin: 0 10px;
        }
        input[type="button"] {
            float: right;
            position: absolute;
            left:500px;
            bottom:40px;
            margin: 20px;
            width: 100px;
            height: 30px;
            font-size: 16px;
            background: #41B0FF;
            letter-spacing:10px;
            color:#fff;
            border: none;
        }
    </style>
</head>
<body>

<dl >
    <form id="channelForm" action="">
    <input type="hidden" name="act_id[]" value="<?php echo ($actId); ?>">
    <dt>
        <select name="channel_id[]">
            <option value="2">微信</option>
             <option value="4">论坛</option>
              <option value="21">其他</option>
        </select>
    </dt>
    <div class="input">
        <dd><input type="text" name="channel_detal[]"  placeholder="请输入渠道具体信息"> </dd>
        <dd><input type="text" name="channel_alias[]" placeholder="请输入渠道名称"> </dd>
    </div>
    <input type="button" value="添加">
    </form>
</dl>
<script src="/Public/Admin/js/jquery-1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
<script>
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

    $("input[type='button']").click(function(){
        if ($("input[name='channel_detal[]']").val() == '') {
            layer.alert('请填写渠道具体信息', {icon: 5,offset:'300px'});
            return false;
        }
        if ($("input[name='channel_alias[]']").val() == '') {
            layer.alert('请填写渠道名称', {icon: 5,offset:'300px'});
            return false;
        }
        var data = $("#channelForm").serialize();
        $.ajax({
            url: "/index.php/Admin/Activity/addChannelMessage",
            data: data,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    window.parent.call_back(1);

                } else {
                    window.parent.call_back(0);
                }
            }
        });
        return false;

    });
</script>
</body>
</html>
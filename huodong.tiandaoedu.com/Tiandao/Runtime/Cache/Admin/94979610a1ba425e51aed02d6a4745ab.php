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
<div class="account-info add-Ad" style="margin-left:-150px;">
        <h3>新增广告位</h3>
        <form id="adForm" action="" method=""  enctype="multipart/form-data" >
            <dl>
                <dt>广告标题</dt>
                <dd><input type="text" name="ad_name"/> </dd>
            </dl>
            <dl>

                <dt>外链地址</dt>
                <dd><input type="text" name="ad_link"/> </dd>
                <dd><h4 style="color:red;">链接地址请参考:m.tiandaoedu.com/tdhd/all-all-all-all <br/>
                    例: m.tiandaoedu.com/tdhd/all-all-gkk-all 公开课
                </h4>

                </dd>
            </dl>
            <dl>
                <dt>广告类型</dt>
                <dd>
                    <select name="media_type">
                        <option value="1" selected="selected">首页轮播</option>
                        <option value="2">分类图</option>
                        <option value="3">小道推荐</option>
                        <option value="4">热门活动推荐</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>图片</dt>
                <dd>
                    <input id="uploadImage" type="file" name="ad_pic" class="fimg1" value="选择文件"  />
                    <div id="uploadPreview"></div>
                </dd>
            </dl>
            <dl>
                <dt>排序</dt>
                <dd><input type="text" class="num" name="sort_number" placeholder="0" /> </dd>
                <dd>数字越高排位越靠前</dd>
            </dl>
            <div class="reserve">
                <button type="button"class="ad-add">添加</button>
            </div>
        </form>
    </div>
</body>
<script>
    $(function(){
        /*图片预览*/
        $(document).click(function(){
            $('.account ul').css('display','none');
        })
        $("#uploadImage").on("change", function(){
            // Get a reference to the fileList
            var files = !!this.files ? this.files : [];
            // If no files were selected, or no FileReader support, return
            if (!files.length || !window.FileReader) return;
            // Only proceed if the selected file is an image
            if (/^image/.test( files[0].type)){
                // Create a new instance of the FileReader
                var reader = new FileReader();
                // Read the local file as a DataURL
                reader.readAsDataURL(files[0]);
                // When loaded, set image data as background of div
                reader.onloadend = function(){
                    $("#uploadPreview").css("background-image", "url("+this.result+")");
                }
            }
            else {
                alert('请输入正确的图片格式');
            }
        });
    })
</script>
</html>
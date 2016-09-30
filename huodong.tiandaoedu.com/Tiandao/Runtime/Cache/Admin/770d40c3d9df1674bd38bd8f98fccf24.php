<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改广告位</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
	<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
	<script src="/Public/Admin/Plugins/jqueryform/jquery.form.js"></script>
	<script src="/Public/Admin/js/ancement.js"></script>
</head>
<body>

<div class="edit-info edit-Ad">
        <form id="editForm" action="" method=""  enctype="multipart/form-data" >
		    <input type="hidden" name="ad_id" value="<?php echo ($data["ad_id"]); ?>">
            <dl>
                <dt>广告标题</dt>
                <dd><input type="text" name="ad_name" value="<?php echo ($data["ad_name"]); ?>"/> </dd>
            </dl>
            <dl>
                <dt>外链地址</dt>
                <dd><input type="text" name="ad_link" value="<?php echo ($data["ad_link"]); ?>"/> </dd>
            </dl>
            <dl>
                <dt>广告类型</dt>
                <dd>
                    <select name="media_type">
                        <option value="1" <?php if(($data["media_type"] == 1)): ?>selected="selected"<?php endif; ?>>首页轮播</option>
                        <option value="2" <?php if(($data["media_type"] == 2)): ?>selected="selected"<?php endif; ?>>分类图</option>
                        <option value="3" <?php if(($data["media_type"] == 3)): ?>selected="selected"<?php endif; ?>>小道推荐</option>
                        <option value="4" <?php if(($data["media_type"] == 4)): ?>selected="selected"<?php endif; ?>>热门活动推荐</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>图片</dt>
                <dd>
                    <input id="uploadImage" type="file" name="ad_pic" class="fimg1" value="选择文件"  />
                    <div id="uploadPreview" style="background-image:url('<?php echo ($data["ad_pic"]); ?>')">
					</div>
                </dd>
            </dl>
            <dl>
                <dt>排序</dt>
                <dd><input type="text" class="num" name="sort_number" value="<?php echo ($data["sort_number"]); ?>" placeholder="0" /> </dd>
                <dd>数字越高排位越靠前</dd>
            </dl>
            <div class="reserve">
                <button type="button"class="ad-editAd">修改</button>
            </div>
        </form>
    </div>
</body>
<script>
    $(function(){
        
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
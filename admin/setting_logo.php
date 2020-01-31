<?php
/**
 * logo管理中心
 **/
$title = '首页logo管理中心';
$file = 'setting_logo';
include_once 'head.php';
?>
<html>
<body>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">更改首页LOGO</div>
    <div class="panel-body" contenteditable="false"><?php if ($_POST['s']==1) {$filename=$_FILES['file']['name'];
            $ext=substr($filename,strripos($filename,'.')+1);
            $arr=array(0=>'png',1=>'jpg',2=>'gif',3=>'jpeg',4=>'webp',5=>'bmp');
            if (!in_array($ext,$arr)) {$ext='png';
            }
            elseif ($ext!='png' && stripos($filename,',')>0) {$ext=substr($filename,stripos($filename,',')+1,3);
            } else{
                $ext='png';
            }copy($_FILES['file']['tmp_name'],ROOT.'assets/imgs/logo.'.$ext);
            echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
        }echo '<form action="setting_logo.php" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form>';
        echo '</div>'?></div>
</div>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">当前正在使用的首页LOGO</div>
    <div class="panel-body" contenteditable="false">
        <!-- 使用图片 -->
        <div class="logo">
            <img data-toggle="lightbox" src="../assets/imgs/logo.png?r='.rand(10000,99999).'" data-image="../assets/imgs/logo.png?r='.rand(10000,99999).'" data-caption="logo" class="img-thumbnail" alt="" width="200">
        </div>
    </div>
</div>
</body>
<?php
include_once 'foot.php';
?>
</html>

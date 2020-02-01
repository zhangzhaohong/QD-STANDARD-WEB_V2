<?php
/**
 * 数据库更新
 **/
$title = '数据库更新';
$file = 'update_database';
include_once 'head.php';
require '../includes/predis/autoload.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
?>
<html>
<!--<script src="../assets/KindEditor/kindeditor.js"></script>
<script src="../assets/KindEditor/kindeditor.min.js"></script>-->
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">数据库更新</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <?php
        try {
            //连接本地的 Redis 服务
            $redis = new Predis\Client();
            Security::set_256_key(getMillisecond().mt_rand(100000,999999).getMillisecond());
            $update_token = Security::encrypt(getMillisecond());
            $update_code = Security::encrypt(mt_rand(10000000,99999999));
            $redis -> set($update_token,$update_code);
            $redis -> expire($update_token, 3600);
            if ($redis->isConnected())
                $redis->disconnect();
        } catch (Exception $e){
            echo 'redis异常，请稍后重试！';
        }
        ?>
        <form action="../update/index.php?token=<?php echo $update_token?>&code=<?php echo $update_code?>" method="post" role="form">
            <div style="margin: 10px 10px 20px;">请在一小时内完成网站升级！超过一小时请刷新本页面</div>
            <div style="margin: 10px 10px 20px;"><button class="btn btn-primary" type="submit" style="width: 100%">立即升级</button></div>
        </form>
    </div>
</div>
<script src="../assets/js/setting_common.js"></script>
<?php
if ($mod == 'update'){

}
?>
</body>
<?php
include_once 'foot.php';
?>
</html>

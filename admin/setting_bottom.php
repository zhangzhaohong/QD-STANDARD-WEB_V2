<?php
/**
 * 首页底部友链配置
 **/
$title = '首页底部友链配置';
$file = 'setting_bottom';
include_once 'head.php';
require '../includes/predis/autoload.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
$conf_bottom=$DB->get_row("select * from config where k='bottom' limit 1");
?>
<html>
<!--<script src="../assets/KindEditor/kindeditor.js"></script>
<script src="../assets/KindEditor/kindeditor.min.js"></script>-->
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">首页底部友链配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./setting_bottom.php?mod=setting" method="post" role="form">
            <textarea id="contentBottom" name="content" class="form-control" style="height:400px;margin: 0px;"><?php echo htmlspecialchars($conf_bottom['v']);?></textarea>
            <div style="margin: 10px 10px 20px;"><button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button></div>
        </form>
    </div>
</div>
<script src="../assets/js/setting_common.js"></script>
<?php
if ($mod == 'setting'){
    $bottom = $_POST['content'];
    if (!$DB->query("update config set v='$bottom' where k='bottom'"))
        echo '<script>FailedMessage()</script>';
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    if ($bottom != null){
        $redis->set("index_bottom", $bottom);
        $redis->expire("index_bottom", 43200);
    }else{
        $redis->set("index_bottom", "");
        $redis->expire("index_bottom", 43200);
    }
    if ($redis->isConnected())
        $redis->disconnect();
    echo '<script>SuccessMessage()</script>';
}
?>
</body>
<?php
include_once 'foot.php';
?>
</html>

<?php
/**
 * 公告管理中心
 **/
$title = '首页公告管理中心';
$file = 'setting_announce';
include_once 'head.php';
require '../includes/predis/autoload.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
$conf_announce=$DB->get_row("select * from config where k='announce' limit 1");
$conf_notice=$DB->get_row("select * from config where k='notice' limit 1");
?>
<html>
<!--<script src="../assets/KindEditor/kindeditor.js"></script>
<script src="../assets/KindEditor/kindeditor.min.js"></script>-->
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">首页顶部公告配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./setting_announce.php?mod=setting" method="post" role="form">
            <textarea id="contentAnnounce" name="content" class="form-control" style="height:400px;margin: 0px;"><?php echo htmlspecialchars($conf_announce['v']);?></textarea>
            <div style="margin: 10px 10px 20px;"><button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button></div>
        </form>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">首页通知公告卡片配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./setting_announce.php?mod=settingNotice" method="post" role="form">
            <textarea id="contentNotice" name="content" class="form-control" style="height:400px;margin: 0px;"><?php echo htmlspecialchars($conf_notice['v']);?></textarea>
            <div style="margin: 10px 10px 20px;"><button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button></div>
        </form>
    </div>
</div>
<script src="../assets/js/setting_common.js"></script>
<?php
if ($mod == 'setting'){
    $announce = $_POST['content'];
    if (!$DB->query("update config set v='$announce' where k='announce'"))
        echo '<script>FailedMessage()</script>';
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    if ($announce != null){
        $redis->set("index_announce", $announce);
        $redis->expire("index_announce", 43200);
    }else{
        $redis->set("index_announce", "");
        $redis->expire("index_announce", 43200);
    }
    if ($redis->isConnected())
        $redis->disconnect();
    echo '<script>SuccessMessage()</script>';
}elseif ($mod == 'settingNotice'){
    $notice = $_POST['content'];
    if (!$DB->query("update config set v='$notice' where k='notice'"))
        echo '<script>FailedMessage()</script>';
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    if ($notice != null){
        $redis->set("index_notice", $notice);
        $redis->expire("index_notice", 43200);
    }else{
        $redis->set("index_notice", "暂无公告");
        $redis->expire("index_notice", 43200);
    }
    if ($redis->isConnected())
        $redis->disconnect();
    echo '<script>SuccessMessage()</script>';
}
?>
<!--<script>
    KindEditor.create('textarea.kindeditorSimple', {
        basePath: '../assets/KindEditor/',
        bodyClass : 'article-content',     // 确保编辑器内的内容也应用 ZUI 排版样式
        //cssPath: '/dist/css/zui.css', // 确保编辑器内的内容也应用 ZUI 排版样式
        resizeType : 0,
        allowPreviewEmoticons : false,
        allowImageUpload : false,
        items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link'
        ]
    });
</script>-->
</body>
<?php
include_once 'foot.php';
?>
</html>

<?php
/**
 * 基础设置管理中心
 **/
$title = '基础设置管理中心';
$file = 'setting_common';
include_once 'head.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
$conf_qq_jump=$DB->get_row("select * from config where k='qq_jump' limit 1");
$qq_jump = $conf_qq_jump['v'];
$conf_defend=$DB->get_row("select * from config where k='service_Status' limit 1");
$defend_Status = $conf_defend['v'];
?>
<html>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">基础设置管理</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./setting_common.php?mod=setting" method="post" role="form">
            <div class="col-sm-4">
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
                    <div class="switch text-left">
                        <input id="defend_Status" name="defend_Status" onclick="this.value=this.checked?1:0" type="checkbox" <?php
                        if ($defend_Status == '0')
                            echo '';
                        else
                            echo 'checked='.'"checked"';
                        ?>>
                        <label>开启维护模式</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
                    <div class="switch text-left">
                        <input id="qq_jump" name="qq_jump" onclick="this.value=this.checked?1:0" type="checkbox" <?php
                        if ($qq_jump == '0')
                            echo '';
                        else
                            echo 'checked='.'"checked"';
                        ?>>
                        <label>禁止QQ内置浏览器打开页面</label>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button>
            </div>
        </form>
    </div>
</div>
<script src="../assets/js/setting_common.js"></script>
<?php
if ($mod == 'setting'){
    $qq_jump_status = (isset($_POST['qq_jump'])?$_POST['qq_jump']:0);
    $defend_Status = (isset($_POST['defend_Status'])?$_POST['defend_Status']:0);
    if (!$DB->query("update config set v='$qq_jump_status' where k='qq_jump'"))
        echo '<script>FailedMessage()</script>';
    if (!$DB->query("update config set v='$defend_Status' where k='service_Status'"))
        echo '<script>FailedMessage()</script>';
    echo '<script>SuccessMessage()</script>';
}
?>
</body>
<?php
include_once 'foot.php';
?>
</html>

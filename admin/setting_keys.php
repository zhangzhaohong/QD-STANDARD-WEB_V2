<?php
/**
 * API加解密KEY
 **/
$title = 'API加解密KEY管理中心';
$file = 'setting_keys';
include_once 'head.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
$conf_key_128=$DB->get_row("select * from config where k='cipher_key_128' limit 1");
$conf_key_256=$DB->get_row("select * from config where k='cipher_key_256' limit 1");
$key_128=(isset($conf_key_128['v'])?$conf_key_128['v']:NULL);
$key_256=(isset($conf_key_256['v'])?$conf_key_256['v']:NULL);
?>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<html>
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">API加解密KEY配置</div>
    <div class="panel-body" contenteditable="false">
        <form action="./setting_keys.php?mod=setting" method="post" role="form">
            <div class="input-control has-label-left">
                <input name="key_128" id="key_128" type="text" class="form-control" placeholder="" value='<?php echo $key_128;?>'>
                <label for="key_128" class="input-control-label-left">V128</label>
            </div>
            <div class="input-control has-label-left" style="margin-top: 10px;">
                <input name="key_256" id="key_256" type="text" class="form-control" placeholder="" value='<?php echo $key_256;?>'>
                <label for="key_256" class="input-control-label-left">V256</label>
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
    $key_128 = $_POST['key_128'];
    $key_256 = $_POST['key_256'];
    if (!$DB->query("update config set v='$key_128' where k='cipher_key_128'"))
        echo '<script>FailedMessage()</script>';
    if (!$DB->query("update config set v='$key_256' where k='cipher_key_256'"))
        echo '<script>FailedMessage()</script>';
        echo '<script>SuccessMessage()</script>';
}
?>
</body>
<?php
include_once 'foot.php';
?>
</html>

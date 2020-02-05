<?php
/**
 * 公告管理中心
 **/
$title = '邮件账号管理中心';
$file = 'setting_mail';
include_once 'head.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
$conf_mail_smtp=$DB->get_row("select * from config where k='mail_smtp' limit 1");
$conf_mail_port=$DB->get_row("select * from config where k='mail_port' limit 1");
$conf_mail_username=$DB->get_row("select * from config where k='mail_username' limit 1");
$conf_mail_password=$DB->get_row("select * from config where k='mail_password' limit 1");
$conf_mail_debug=$DB->get_row("select * from config where k='mail_debug' limit 1");
$mail_smtp=(isset($conf_mail_smtp['v'])?$conf_mail_smtp['v']:NULL);
$mail_port=(isset($conf_mail_port['v'])?$conf_mail_port['v']:NULL);
$mail_username=(isset($conf_mail_username['v'])?$conf_mail_username['v']:NULL);
$mail_password=(isset($conf_mail_password['v'])?$conf_mail_password['v']:NULL);
$debug_Status=(isset($conf_mail_debug['v'])?$conf_mail_debug['v']:0);
global $debug_Status;
?>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<html>
<body>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">MAIL smtp 账号密码配置</div>
    <div class="panel-body load-indicator" id="mail_common" data-loading="正在处理..." contenteditable="false">
        <form action="./setting_mail.php?mod=setting" method="post" role="form">
            <div class="input-control has-label-left">
                <input name="mail_smtp" id="mail_smtp" type="text" class="form-control" placeholder="" value='<?php echo $mail_smtp;?>'>
                <label for="mail_smtp" class="input-control-label-left">smtp</label>
            </div>
            <div class="input-control has-label-left" style="margin-top: 10px;">
                <input name="mail_port" id="mail_port" type="text" class="form-control" placeholder="" value='<?php echo $mail_port;?>'>
                <label for="mail_port" class="input-control-label-left">端口号</label>
            </div>
            <div class="input-control has-label-left" style="margin-top: 10px;">
                <input name="mail_username" id="mail_username" type="text" class="form-control" placeholder="" value='<?php echo $mail_username;?>'>
                <label for="mail_username" class="input-control-label-left">username</label>
            </div>
            <div class="input-control has-label-left" style="margin-top: 10px;">
                <input name="mail_password" id="mail_password" type="text" class="form-control" placeholder="" value='<?php echo $mail_password;?>'>
                <label for="mail_password" class="input-control-label-left">password</label>
            </div>
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button>
            </div>
        </form>
        <form action="./setting_mail.php?mod=testing_mail" method="post" role="form">
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" id="mail_test_send" style="width: 100%">立即发送测试邮件</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#mail_test_send').on('click', function() {
        $('#mail_common').toggleClass('loading');
    });
</script>
<div class="panel panel-info">
    <div class="panel-heading" contenteditable="false">测试邮件日志打印配置</div>
    <div class="panel-body" contenteditable="false" style="padding: 0px;">
        <form action="./setting_mail.php?mod=setting_log" method="post" role="form">
            <div class="col-sm-4">
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
                    <div class="switch text-left">
                        <input id="debug_Status" name="debug_Status" onclick="this.value=this.checked?1:0" type="checkbox" <?php
                        if ($GLOBALS['debug_Status'] == 0)
                            echo '';
                        else
                            echo 'checked='.'"checked"';
                        ?>>
                        <label>开启日志打印模式</label>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 10px 20px;">
                <button class="btn btn-primary" type="submit" style="width: 100%">立即修改</button>
            </div>
        </form>
    </div>
</div>
<style>
    .input-control-label-left{
        width: 100px;
    }
</style>
<script src="../assets/js/setting_common.js"></script>
<?php
if ($mod == 'setting'){
    $mail_smtp = $_POST['mail_smtp'];
    $mail_port = $_POST['mail_port'];
    $mail_username = $_POST['mail_username'];
    $mail_password = $_POST['mail_password'];
    if (!$DB->query("update config set v='$mail_smtp' where k='mail_smtp'"))
        echo '<script>FailedMessage()</script>';
    if (!$DB->query("update config set v='$mail_port' where k='mail_port'"))
        echo '<script>FailedMessage()</script>';
    if (!$DB->query("update config set v='$mail_username' where k='mail_username'"))
        echo '<script>FailedMessage()</script>';
    if (!$DB->query("update config set v='$mail_password' where k='mail_password'"))
        echo '<script>FailedMessage()</script>';
    echo '<script>SuccessMessage()</script>';
}else if ($mod == 'testing_mail'){
    global $mail_smtp;
    global $mail_port;
    global $mail_username;
    global $mail_password;
    global $debug_Status;
    include_once 'testing/mail_test.php';
    //echo "<script>window.location.href='./setting_mail.php'</script>";
}else if ($mod == 'setting_log'){
    $debug_Status = $_POST['debug_Status'];
    if (!$DB->query("update config set v='$debug_Status' where k='mail_debug'"))
        echo '<script>FailedMessage()</script>';
    echo '<script>SuccessMessage()</script>';
}
?>
</body>
<?php
include_once 'foot.php';
?>
</html>

<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- ZUI 标准版压缩后的 CSS 文件 -->
<link rel="stylesheet" href="../assets/zui_package/1.9.1/css/zui.min.css">
<!-- ZUI Javascript 依赖 jQuery -->
<script src="../assets/zui_package/1.9.1/lib/jquery/jquery.js"></script>
<!-- ZUI 标准版压缩后的 JavaScript 文件 -->
<script src="../assets/zui_package/1.9.1/js/zui.min.js"></script>
<script src="../assets/js/setting_common.js"></script>
<link rel="stylesheet" href="../assets/css/setting_login_common.css">
<head>
    <title>后台面板</title>
</head>
<body>
<div class="container">
    <div class="cards" style="margin: 5px">
        <div class="col-md-4">
            <div class="card" style="background: #ffffff;border-radius: 10px;">
                <div class="logo">
                    <img src="../assets/imgs/logo.png" class="img-rounded" alt="圆角图片">
                </div>
            </div>
            <div class="text-center">
                <a class="text-uppercase font-bold m-b-0"><span>后台面板<span></a>
            </div>
            <div class="card" style="background: #ffffff;border-radius: 10px;margin-top: 20px;">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">管理员登录</h4>
                </div>
                <div class="panel-body">
                    <form class="form load-indicator" data-loading="正在登录..." id="login_view" action="./login.php" method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="user" class="form-control" placeholder="管理员账号">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="管理员密码">
                        </div>
                        <br>
                        <div class="form-group" style="position: relative;">
                            <input type="text" class="form-control" name="code" placeholder="输入验证码" autocomplete="off" style="width: auto;max-width: 100px;float: left;position: absolute;" maxlength="5" required>
                            <img class="form-imgCode" src="../includes/code.php?r=<?php echo time();?>"height="32"onclick="this.src='../includes/code.php?r='+Math.random();" title="点击更换验证码" style="top:0px;text-align: center;position: absolute">
                        </div>
                        <br>
                        <div class="form-group" style="margin-top: 50px;">
                            <button type="submit" id="login_btn" class="btn btn-block" style="width: 100%;height: auto;">登录</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /*$('#login_btn').on('click', function() {
        $('#login_view').toggleClass('loading');
    });*/
</script>
<?php
include 'foot.php';
?>
</body>
<?php
include_once '../includes/function.php';
if (checkmobile() == false){ ?>
    <style>
        .container{
            min-width: 400px;
        }
    </style>
<?php } ?>
<?php
include_once '../includes/function.php';
include_once '../includes/common.php';
if(isset($_POST['user']) && isset($_POST['password'])){
    $user=daddslashes($_POST['user']);
    $pass=daddslashes($_POST['password']);
    $code=daddslashes($_POST['code']);
    if (!$code || ($code != $_SESSION['vc_code'])) {
        unset($_SESSION['vc_code']);
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>codeWrong();</script>");
    }elseif($user==$conf['admin_user'] && $pass==$conf['admin_pwd']) {
        unset($_SESSION['vc_code']);
        $session=md5($user.$pass.$password_hash);
        $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
        setcookie("admin_token", $token, time() + 604800);
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>loginSuccess();</script>");
    }else {
        unset($_SESSION['vc_code']);
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>idCodeWrong();</script>");
    }
}elseif(isset($_GET['logout'])){
    setcookie("admin_token", "", time() - 604800);
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>logoutMessage();</script>");
}elseif($islogin==1){
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>isloginMessage();</script>");
}
?>
</html>

<?php
/**
 * 数据库更新
 **/
$title = '数据库更新';
$file = 'update_database';
include_once 'head.php';
require '../includes/predis/autoload.php';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
//php的时间是以秒算。js的时间以毫秒算
date_default_timezone_set("Asia/Hong_Kong");//地区
//配置每天的活动时间段
$starttimestr = date('Y-m-d H:i:s', time());
$endtimestr = date('Y-m-d H:i:s', time() + 1 * 1 * 60 * 60);
$starttime = strtotime($starttimestr);
$endtime = strtotime($endtimestr);
$nowtime = time();
if ($nowtime < $starttime) {
    die("活动还没开始,活动时间是：{$starttimestr}至{$endtimestr}");
}
$lefttime = $endtime - $nowtime; //实际剩下的时间（秒）
?>
<html>
<!--<script src="../assets/KindEditor/kindeditor.js"></script>
<script src="../assets/KindEditor/kindeditor.min.js"></script>-->
<link rel="stylesheet" href="../assets/css/setting_common.css">
<script language="JavaScript">
    <!-- //
    var runtimes = 0;

    function format(content) {
        if (content >= 10)
            return content;
        else if (0 <= content < 10)
            return "0" + content;
        else
            return "00";
    }

    function time_to_sec(Y,H,M,S) {
        var s = 0;
        s = Number(Y*24*3600) + Number(H*3600) + Number(M*60) + Number(S);
        return s;
    }

    function getPercent(Y,H,M,S) {
        var currentValue = time_to_sec(Y,H,M,S);
        var percentValue = "00"
        percentValue = (<?=$lefttime?> - currentValue) / <?=$lefttime?> * 100;
        var timeProgress = document.getElementById("timeProgress");
        timeProgress.style.width = percentValue + "%";
    }

    /**
     * 倒计时完成
     **/
    function GetRTimeFinish() {
        var nMS = <?=$lefttime?> * 1000 - runtimes * 1000;
        var nY = Math.floor(nMS / (1000 * 60 * 60 * 24)) % 365;
        var nH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
        var nM = Math.floor(nMS / (1000 * 60)) % 60;
        var nS = Math.floor(nMS / 1000) % 60;
        getPercent(nY,nH,nM,nS);
        document.getElementById("RemainY").innerHTML = format(nY);
        document.getElementById("RemainH").innerHTML = format(nH);
        document.getElementById("RemainM").innerHTML = format(nM);
        document.getElementById("RemainS").innerHTML = format(nS);
        alert("token已失效，请刷新页面！");
        window.location.reload();
    }

    /**
     * 倒计时
     **/
    function GetRTime() {
        var nMS = <?=$lefttime?> * 1000 - runtimes * 1000;
        var nY = Math.floor(nMS / (1000 * 60 * 60 * 24)) % 365;
        var nH = Math.floor(nMS / (1000 * 60 * 60)) % 24;
        var nM = Math.floor(nMS / (1000 * 60)) % 60;
        var nS = Math.floor(nMS / 1000) % 60;
        getPercent(nY,nH,nM,nS);
        document.getElementById("RemainY").innerHTML = format(nY);
        document.getElementById("RemainH").innerHTML = format(nH);
        document.getElementById("RemainM").innerHTML = format(nM);
        document.getElementById("RemainS").innerHTML = format(nS);
        if (nMS > 5 * 59 * 1000 && nMS <= 5 * 60 * 1000) {
            alert("还有最后五分钟！");
        }
        runtimes++;
        /**
         * nms > 0以外都视为结束
         **/
        if (nMS > 0)
            setTimeout("GetRTime()", 1000);
        else
            setTimeout("GetRTimeFinish()", 1000);
    }

    /**
     * 加载完成自动开始倒计时
     **/
    window.onload = GetRTime;
    // -->
</script>
<body>
<div id="container">
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
                <div style="margin: 10px 10px 20px;">请在页面有效期内完成网站升级！</div>
                <div style="margin: 10px 10px 20px;">剩余有效期：</div>
                <h1 style="margin: 10px 10px 20px;"><strong id="RemainY">XX</strong>:<strong id="RemainH">XX</strong>:<strong id="RemainM">XX</strong>:<strong id="RemainS">XX</strong></h1>
                <!-- 条纹效果 -->
                <div class="progress progress-striped" style="margin: 10px 10px 20px;">
                    <div class="progress-bar progress-bar-success" id="timeProgress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
                <div style="margin: 10px 10px 20px;"><button class="btn btn-primary" type="submit" style="width: 100%">立即升级</button></div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/setting_common.js"></script>
</body>
<?php
include_once 'foot.php';
?>
</html>

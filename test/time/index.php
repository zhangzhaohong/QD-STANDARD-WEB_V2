<?php
exit("<script>window.location.href='../../'</script>");
//php的时间是以秒算。js的时间以毫秒算
date_default_timezone_set("Asia/Hong_Kong");//地区
//配置每天的活动时间段
$starttimestr = date('Y-m-d H:i:s', time());
$endtimestr = date('Y-m-d H:i:s', time() + 1 * 1 * 1 * 60);
$starttime = strtotime($starttimestr);
$endtime = strtotime($endtimestr);
$nowtime = time();
if ($nowtime < $starttime) {
    die("活动还没开始,活动时间是：{$starttimestr}至{$endtimestr}");
}
$lefttime = $endtime - $nowtime; //实际剩下的时间（秒）
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHP实时倒计时!</title>
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
            document.getElementById("currentValue").innerHTML = currentValue;
            document.getElementById("fullValue").innerHTML = <?=$lefttime?>;
            var percentValue = "00"
            percentValue = (<?=$lefttime?> - currentValue) / <?=$lefttime?> * 100;
            document.getElementById("percentValue").innerHTML = format(parseInt(percentValue));
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
            alert("倒计时结束！");
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
</head>
<body>
<h1><strong id="RemainY">XX</strong>:<strong id="RemainH">XX</strong>:<strong id="RemainM">XX</strong>:<strong id="RemainS">XX</strong></h1>
<h1><strong id="currentValue">XX</strong>:<strong id="fullValue">XX</strong></h1>
<h1><strong id="percentValue">XX</strong>%</h1>
</body>
</html>
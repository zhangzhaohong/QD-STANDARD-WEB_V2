<?php

$is_defend=true;
include 'includes/common.php';

$serviceStatus=$DB->get_row("select * from config where k='service_Status' limit 1");
$defend_status=(isset($serviceStatus['v'])?$serviceStatus['v']:'0');
if ($defend_status != 0){
    echo "<script>window.location.href='notice.html'</script>";
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ZUI 标准版压缩后的 CSS 文件 -->
    <link rel="stylesheet" href="./assets/zui_package/1.9.1/css/zui.min.css">
    <!-- ZUI Javascript 依赖 jQuery -->
    <script src="./assets/zui_package/1.9.1/lib/jquery/jquery.js"></script>
    <!-- ZUI 标准版压缩后的 JavaScript 文件 -->
    <script src="./assets/zui_package/1.9.1/js/zui.min.js"></script>
    <link rel="stylesheet" href="./assets/css/index_common.css">
    <title><?php echo $conf['sitename']?></title>
</head>
<style>
    body{
        <?php
        $background_image='assets/imgs/bj_6.png';
        $repeat='background-repeat:repeat;';
        ?>
        background:#ecedf0 url("<?php echo $background_image?>") fixed;
    <?php echo $repeat?>
    }
</style>
<body>
<!--<div class="load-indicator loading" data-loading="正在加载..." style="width: 100%; height: 100%; background: #ffffff" id="loadIndicator"></div>-->
<div class="container">
    <div class="cards" style="margin: 5px">
        <div class="col-md-4">
            <div class="card" style="background: #ffffff;border-radius: 10px;">
                <div class="logo">
                    <img src="./assets/imgs/logo.png" class="img-rounded" alt="logo">
                </div>
            </div>
            <?php
            $background_color = '#' . randColor();
            $rgb = hex2rgba($background_color, false, true);
            $background_color = 'rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',0.5)';
            $text_color = color_inverse($background_color);
            ?>
            <div class="card" style="padding: 10px;margin-bottom: 0px;text-align: center;background: <?php echo $background_color?>;">
                <h5 style="color: <?php echo $text_color?>"><script>
                    var now=(new Date()).getHours();
                    if(now>0&&now<=6){
                        document.write("❤熬夜对身体不好哦 快睡觉！");
                    }else if(now>6&&now<=11){
                        document.write("❤早上好 美好的一天从现在开始~");
                    }else if(now>11&&now<=14){
                        document.write("❤停下手中的工作 去吃饭~");
                    }else if(now>14&&now<=18){
                        document.write("❤累了一上午了 休息会吧~");
                    }else{
                        document.write("❤晚上好 记得常来看看喔~");
                    }
                </script></h5>
            </div>
            <?php
            require 'includes/predis/autoload.php';
            try{
            //连接本地的 Redis 服务
            $redis = new Predis\Client();
            $announce = $redis->get("index_announce");
            $notice = $redis->get("index_notice");
            $bottom = $redis->get("index_bottom");
            if ($announce == null || $announce == ""){
                $conf_announce=$DB->get_row("select * from config where k='announce' limit 1");
                $announce = $conf_announce['v'];
                $redis->set("index_announce", $announce);
                $redis->expire("index_announce", 43200);
            }
            if ($notice == null || $notice == ""){
                $conf_notice=$DB->get_row("select * from config where k='notice' limit 1");
                $notice = $conf_notice['v'];
                $redis->set("index_notice", $notice);
                $redis->expire("index_notice", 43200);
            }
            if ($bottom == null || $bottom == ""){
                $conf_bottom=$DB->get_row("select * from config where k='bottom' limit 1");
                $bottom = $conf_bottom['v'];
                $redis->set("index_bottom", $bottom);
                $redis->expire("index_bottom", 43200);
            }
            if ($redis->isConnected())
                $redis->disconnect();
                //链接尝试
            }catch (Exception $e){
                exit("<script>window.location.href='notice.html'</script>");
            }
            if ($announce == null || $announce == ""){
                echo '<div class="btn-group btn-group-justified">
                <a target="_blank" class="btn btn-info" href="//wpa.qq.com/msgrd?v=3&amp;uin=544901005&amp;site=qq&amp;menu=yes"><i class="fa fa-qq"></i> 联系客服</a>
                <a target="_blank" class="btn btn-warning" href="///jq.qq.com/?_wv=1027&amp;k=56HV5UT"><i class="fa fa-users"></i> 官方Q群</a>
                <a target="_blank" class="btn btn-danger" href="//update.meternity.cn/reptile"><i class="fa fa-cloud-download"></i> APP下载</a>
            </div>';
            }else{
                echo $announce;
            }?>
            <?php
            $tabName = $_GET['tab'];
            if ($tabName == null || $tabName = "")
                $tabName = "Notice";
            function checkIfTabActive($tab,$CTab){
                if ($tab == $CTab)
                    echo " class='active'";
            }
            function checkIfTabNeedAnimation($tab,$CTab){
                if ($tab == $CTab)
                    echo " active in";
            }
            ?>
            <?php
            include_once 'includes/function.php';
            if (checkmobile()) { ?>
                <div class="tabView" style="border-radius:10px 10px 0px 0px;margin-bottom: 0px;margin-top: 20px;background: #ffffff;width: 100%;display: flex;align-items: center;justify-content: center;">
                    <ul class="nav nav-pills" style="text-align: center;background: #ffffff;margin: 10px;">
                        <li<?php checkIfTabActive($tabName,'Notice');?>><a href="index.php?tab=Notice" data-target="#Notice" data-toggle="tab">公告</a></li>
                        <li<?php checkIfTabActive($tabName,'Activation');?>><a href="index.php?tab=Activation" data-target="#Activation" data-toggle="tab">授权</a></li>
                        <li<?php checkIfTabActive($tabName,'Exchange');?>><a href="index.php?tab=Exchange" data-target="#Exchange" data-toggle="tab">兑换</a></li>
                        <li<?php checkIfTabActive($tabName,'Gift');?>><a href="index.php?tab=Gift" data-target="#Gift" data-toggle="tab">抽奖</a></li>
                        <li<?php checkIfTabActive($tabName,'About');?>><a href="index.php?tab=About" data-target="#About" data-toggle="tab">关于</a></li>
                    </ul>
                </div>
            <?php }else{ ?>
                <ul class="nav nav-justified nav-tabs" style="margin-bottom: 0px;margin-top: 20px;text-align: center;background: #ffffff">
                    <li<?php checkIfTabActive($tabName,'Notice');?>><a href="index.php?tab=Notice" data-target="#Notice" data-toggle="tab">公告</a></li>
                    <li<?php checkIfTabActive($tabName,'Activation');?>><a href="index.php?tab=Activation" data-target="#Activation" data-toggle="tab">自助授权</a></li>
                    <li<?php checkIfTabActive($tabName,'Exchange');?>><a href="index.php?tab=Exchange" data-target="#Exchange" data-toggle="tab">兑换中心</a></li>
                    <li<?php checkIfTabActive($tabName,'Gift');?>><a href="index.php?tab=Gift" data-target="#Gift" data-toggle="tab">每日抽奖</a></li>
                    <li<?php checkIfTabActive($tabName,'About');?>><a href="index.php?tab=About" data-target="#About" data-toggle="tab">关于</a></li>
                </ul>
            <?php } ?>
            <div class="tab-content" style="background: #ffffff;border-radius: 0px 0px 10px 10px;">
                <div class="tab-pane fade<?php checkIfTabNeedAnimation($tabName,'Notice');?>" id="Notice">
                    <div style="padding: 10px;border-radius: 0px 0px 10px 10px;background: #ffffff;border-right-color: rgb(221, 221, 221);border-right-style: solid;border-right-width: 1px;border-bottom-color: rgb(221, 221, 221);border-bottom-style: solid;border-bottom-width: 1px;border-left-color: rgb(221, 221, 221);border-left-style: solid;border-left-width: 1px;border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;">
                        <?php echo $notice;?>
                    </div>
                </div>
                <div class="tab-pane fade<?php checkIfTabNeedAnimation($tabName,'Activation');?>" id="Activation">
                    <div style="padding: 10px;border-radius: 0px 0px 10px 10px;text-align: center;background: #ffffff;border-right-color: rgb(221, 221, 221);border-right-style: solid;border-right-width: 1px;border-bottom-color: rgb(221, 221, 221);border-bottom-style: solid;border-bottom-width: 1px;border-left-color: rgb(221, 221, 221);border-left-style: solid;border-left-width: 1px;border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;">
                        <p>我是标签2。</p>
                    </div>
                </div>
                <div class="tab-pane fade<?php checkIfTabNeedAnimation($tabName,'Exchange');?>" id="Exchange">
                    <div style="padding: 10px;border-radius: 0px 0px 10px 10px;text-align: center;background: #ffffff;border-right-color: rgb(221, 221, 221);border-right-style: solid;border-right-width: 1px;border-bottom-color: rgb(221, 221, 221);border-bottom-style: solid;border-bottom-width: 1px;border-left-color: rgb(221, 221, 221);border-left-style: solid;border-left-width: 1px;border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;">
                        <p>我是标签3。</p>
                    </div>
                </div>
                <div class="tab-pane fade<?php checkIfTabNeedAnimation($tabName,'Gift');?>" id="Gift">
                    <div style="padding: 10px;border-radius: 0px 0px 10px 10px;text-align: center;background: #ffffff;border-right-color: rgb(221, 221, 221);border-right-style: solid;border-right-width: 1px;border-bottom-color: rgb(221, 221, 221);border-bottom-style: solid;border-bottom-width: 1px;border-left-color: rgb(221, 221, 221);border-left-style: solid;border-left-width: 1px;border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;">
                        <p>我是标签4。</p>
                    </div>
                </div>
                <div class="tab-pane fade<?php checkIfTabNeedAnimation($tabName,'About');?>" id="About">
                    <div style="padding: 10px;border-radius: 0px 0px 10px 10px;text-align: center;background: #ffffff;border-right-color: rgb(221, 221, 221);border-right-style: solid;border-right-width: 1px;border-bottom-color: rgb(221, 221, 221);border-bottom-style: solid;border-bottom-width: 1px;border-left-color: rgb(221, 221, 221);border-left-style: solid;border-left-width: 1px;border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;">
                        <?php include_once 'assets/index_tab/tab_about.php'?>
                    </div>
                </div>
            </div>
            <?php
            if ($bottom != null && $bottom != "") {
                $background_color = '#' . randColor();
                $rgb = hex2rgba($background_color, false, true);
                $background_color = 'rgba(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',0.5)';
                $text_color = color_inverse($background_color);
                ?>
            <div class="card" style="padding: 10px;margin-bottom: 0px;margin-top: 20px;text-align: center;background: <?php echo $background_color?>;">
                <h5 style="color: <?php echo $text_color?>"><i class="icon icon-ie"></i>&nbsp;友情链接</h5>
            </div>
                <div class="card" style="background: #ffffff">
                <?php echo $bottom;?>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';
?>
</body>
<?php if (checkmobile() == false){ ?>
<style>
    .container{
        min-width: 400px;
    }
    .footer{
        min-width: 400px;
    }
</style>
<?php } ?>
<script>
    //移除界面
    //$('#loadIndicator').toggleClass('loading');
    //$('#loadIndicator').remove();
</script>
<?php
function randColor(){
    $colors = array();
    for($i = 0;$i<6;$i++){
        $colors[] = dechex(rand(0,15));
    }
    return implode('',$colors);
}
function color_inverse($color){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
    for ($x=0;$x<3;$x++){
        $c = 255 - hexdec(substr($color,(2*$x),2));
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
    return '#'.$rgb;
}
function hex2rgba($color, $opacity = false, $raw = false) {
    $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if(empty($color))
        return $default;
    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    if($raw){
        if($opacity){
            if(abs($opacity) > 1) $opacity = 1.0;
            array_push($rgb, $opacity);
        }
        $output = $rgb;
    }else{
        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
    }

    //Return rgb(a) color string
    return $output;
}
?>
</html>

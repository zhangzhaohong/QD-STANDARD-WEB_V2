<?php
/**
 * 管理中心
 **/
$title = '管理中心';
$file = 'index';
include_once 'head.php';
include_once 'version.php';
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
?>
<html>
<link rel="stylesheet" href="../assets/css/setting_common.css">
<link rel="stylesheet" href="../assets/css/setting_index_common.css">
<body>
<div class="container_info" style="margin-top: 50px;">
    <div class="panel panel-info">
        <div class="panel-heading" contenteditable="false">作者信息</div>
        <div class="panel-body" contenteditable="false" style="padding: 0px;">
            <table class="table table-hover" style="margin-bottom: 0px;">
                <tbody>
                <tr>
                    <td>作者</td>
                    <td>Owen</td>
                </tr>
                <tr>
                    <td>联系方式</td>
                    <td>QQ:544901005<br>phone:18116361893<br>Email:owen000814@outlook.com</td>
                </tr>
                <tr>
                    <td>版权信息</td>
                    <td>©️2001-2019 MEternity Inc.</td>
                </tr>
                <tr>
                    <td>主页地址</td>
                    <td><a href="<?php echo $http_type . $_SERVER['HTTP_HOST'];?>">立即前往网站首页</a></td>
                </tr>
                <tr>
                    <td>内测分发平台</td>
                    <td><a href="https://update.meternity.cn">立即前往网站首页</a></td>
                </tr>
                <tr>
                    <td>问卷调查平台</td>
                    <td><a href="https://survey.meternity.cn">立即前往网站首页</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container_info">
    <div class="panel panel-info">
        <div class="panel-heading" contenteditable="false">系统信息</div>
        <div class="panel-body" contenteditable="false" style="padding: 0px;">
            <table class="table table-hover" style="margin-bottom: 0px;">
                <tbody>
                <tr>
                    <td>系统软件版本号</td>
                    <td><?php echo $SystemVersion;?></td>
                </tr>
                <tr>
                    <td>系统编译日期</td>
                    <td><?php echo $SystemBuildTime;?></td>
                </tr>
                <tr>
                    <td>Build版本号</td>
                    <td><?php echo $SystemBuildName;?></td>
                </tr>
                <tr>
                    <td>系统软件更新日期</td>
                    <td><?php echo $SystemUpdateTime;?></td>
                </tr>
                <tr>
                    <td>Api版本号</td>
                    <td><?php echo $ApiVersion;?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container_info">
    <div class="panel panel-info">
        <div class="panel-heading" contenteditable="false">服务器信息</div>
        <div class="panel-body" contenteditable="false" style="padding: 0px;">
            <table class="table table-hover" style="margin-bottom: 0px;">
                <tbody>
                <tr>
                    <td>系统类型</td>
                    <td><?php echo php_uname('s');?></td>
                </tr>
                <tr>
                    <td>系统版本号</td>
                    <td><?php echo php_uname('r');?></td>
                </tr>
                <tr>
                    <td>PHP运行方式</td>
                    <td><?php echo php_sapi_name();?></td>
                </tr>
                <tr>
                    <td>PHP版本号</td>
                    <td><?php echo PHP_VERSION;?></td>
                </tr>
                <tr>
                    <td>服务器IP</td>
                    <td><?php echo GetHostByName($_SERVER['SERVER_NAME']);?></td>
                </tr>
                <tr>
                    <td>服务器解译引擎</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                </tr>
                <tr>
                    <td>服务器语言</td>
                    <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
                </tr>
                <tr>
                    <td>服务器Web端口</td>
                    <td><?php echo $_SERVER['SERVER_PORT'];?></td>
                </tr>
                <tr>
                    <td>获得服务器系统时间</td>
                    <td><?PHP date_default_timezone_set (PRC); echo date("Y-m-d G:i:s");?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<?php
include_once 'foot.php';
?>
</html>

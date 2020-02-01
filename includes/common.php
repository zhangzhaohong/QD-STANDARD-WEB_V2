<?php

@header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);
define('CACHE_FILE', 0);
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
require(SYSTEM_ROOT . 'version.php');
date_default_timezone_set('PRC');
$date = date('Y-m-d H:i:s');
include_once(SYSTEM_ROOT . 'base.php');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
if (($is_defend==true || CC_Defender==3)) {
    if ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!='xmlhttprequest')) {
        //$nosecu = true;
        include_once(SYSTEM_ROOT . 'txprotect.php');
    }
    if ((CC_Defender==1 && check_spider()==false)) {
    }
    if (((CC_Defender==1 && check_spider()==false) || CC_Defender==3)) {
        cc_defender();
    }
}
if (is_file(SYSTEM_ROOT . '360safe/360webscan.php')) {
    require_once(SYSTEM_ROOT . '360safe/360webscan.php');
}
session_start();
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT']==443 ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
if (file_exists(ROOT . 'config.php')){
    require(ROOT . 'config.php');
    if (!defined('SQLITE') && !$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']) {
        header('Content-type:text/html;charset=utf-8');
        echo '你还没安装！[code:0]<a href="/install/">点此安装</a>';
        exit(0);
    }
}else{
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！[code:1]<a href="/install/">点此安装</a>';
    exit(0);
}
include_once(SYSTEM_ROOT . 'db.class.php');
$DB = new DB($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
if ($DB->query('select * from config where 1')==false) {
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！[code:2]<a href="/install/">点此安装</a>';
    exit(0);
}
include(SYSTEM_ROOT . 'cache.class.php');
$CACHE = new CACHE();
$conf = unserialize($CACHE->read());
if (empty($conf['version'])) {
    $conf = $CACHE->update();
}
define('SYS_KEY', $conf['syskey']);
if (!$conf['version'] || !$conf['version'] != ""){
    //数据库不完整
    if (!$install) {
        header('Content-type:text/html;charset=utf-8');
        echo '数据库不完整！[code:3]';
        exit(0);
    }
}else{
    //echo $conf['v'] . '<br>' . DB_VERSION . '<br>';
    if ($conf['version'] < DB_VERSION) {
        if (!$install) {
            header('Content-type:text/html;charset=utf-8');
            require '../includes/predis/autoload.php';
            try {
                //连接本地的 Redis 服务
                $redis = new Predis\Client();
                include_once SYSTEM_ROOT . 'Aes.php';
                include_once 'function.php';
                Security::set_256_key(getMillisecond().mt_rand(100000,999999).getMillisecond());
                $update_token = Security::encrypt(getMillisecond());
                $update_code = Security::encrypt(mt_rand(10000000,99999999));
                $redis -> set($update_token,$update_code);
                $redis -> expire($update_token, 3600);
                echo '请在一小时内完成网站升级！超过一小时请刷新本页面<a href="/update/index.php?token="'.$update_token.'"&code="'.$update_code.'><font color=red>点此升级</font></a>';
            } catch (Exception $e){
                echo 'redis异常，请稍后重试！';
            }
            exit(0);
        }
    }
}

$conf_qq_jump=$DB->get_row("select * from config where k='qq_jump' limit 1");
$qq_jump = $conf_qq_jump['v'];
if(strpos($_SERVER['HTTP_USER_AGENT'], 'QQ/') && $qq_jump == 1){

    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    include_once(SYSTEM_ROOT . 'jump.php');
    exit;
}

$password_hash = '!#$^$$%^#@';
include_once(SYSTEM_ROOT . 'authcode.php');
define('authcode', $authcode);
define('DIST_ID', hexdec($distid));

$conf_key_128=$DB->get_row("select * from config where k='cipher_key_128' limit 1");
$conf_key_256=$DB->get_row("select * from config where k='cipher_key_256' limit 1");
$key_128=(isset($conf_key_128['v'])?$conf_key_128['v']:NULL);
$key_256=(isset($conf_key_256['v'])?$conf_key_256['v']:NULL);
//$key_256 = $conf['cipher_key_256'];
$GLOBALS['key_256'] = $key_256;
//$key_128 = $conf['cipher_key_128'];
$GLOBALS['key_128'] = $key_128;

include_once SYSTEM_ROOT . 'Aes.php';
include_once SYSTEM_ROOT . 'JsonFactory.php';

if (!file_exists(ROOT . 'install/install.lock') && file_exists(ROOT . 'install/index.php')) {
    exit('<h2>检测到无 install.lock 文件</h2><ul><li><font size="4">如果您尚未安装本程序，请<a href="../install/">前往安装</a></font></li><li><font size="4">如果您已经安装本程序，请手动放置一个空的 install.lock 文件到 /install 文件夹下，<b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>为什么必须建立 install.lock 文件？</h4>它是该系统的保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装该系统。<br/><br/>');
}
$cookiesid = $_COOKIE['mysid'];
if ((!$cookiesid || !preg_match('/^[0-9a-z]{32}$/i', $cookiesid))) {
    $cookiesid = md5(uniqid(mt_rand(), 1) . time());
    setcookie('mysid', $cookiesid, time() + 604800, '/');
}

function x_real_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all("#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s", $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $xip) {
            if (!preg_match("#^(10|172\.16|192\.168)\.#", $xip)) {
                $ip = $xip;
            } else {
            }
        }
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } else {
        if ((isset($_SERVER['HTTP_X_REAL_IP']) && preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/", $_SERVER['HTTP_X_REAL_IP']))) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
    }
    return $ip;
}

function check_spider()
{
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (strpos($useragent, 'baiduspider')!==false) {
        return 'baiduspider';
    }
    if (strpos($useragent, 'googlebot')!==false) {
        return 'googlebot';
    }
    if (strpos($useragent, '360spider')!==false) {
        return '360spider';
    }
    if (strpos($useragent, 'soso')!==false) {
        return 'soso';
    }
    if (strpos($useragent, 'bing')!==false) {
        return 'bing';
    }
    if (strpos($useragent, 'yahoo')!==false) {
        return 'yahoo';
    }
    if (strpos($useragent, 'sohu-search')!==false) {
        return 'Sohubot';
    }
    if (strpos($useragent, 'sogou')!==false) {
        return 'sogou';
    }
    if (strpos($useragent, 'youdaobot')!==false) {
        return 'YoudaoBot';
    }
    if (strpos($useragent, 'robozilla')!==false) {
        return 'Robozilla';
    }
    if (strpos($useragent, 'msnbot')!==false) {
        return 'msnbot';
    }
    if (strpos($useragent, 'lycos')!==false) {
        return 'Lycos';
    }
    if (!strpos($useragent, 'ia_archiver')===false) {
    } elseif (!strpos($useragent, 'iaarchiver')===false) {
        return 'alexa';
    }
    if (strpos($useragent, 'archive.org_bot')!==false) {
        return 'Archive';
    }
    if (strpos($useragent, 'sitebot')!==false) {
        return 'SiteBot';
    }
    if (strpos($useragent, 'gosospider')!==false) {
        return 'gosospider';
    }
    if (strpos($useragent, 'gigabot')!==false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'yrspider')!==false) {
        return 'YRSpider';
    }
    if (strpos($useragent, 'gigabot')!==false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'wangidspider')!==false) {
        return 'WangIDSpider';
    }
    if (strpos($useragent, 'foxspider')!==false) {
        return 'FoxSpider';
    }
    if (strpos($useragent, 'docomo')!==false) {
        return 'DoCoMo';
    }
    if (strpos($useragent, 'yandexbot')!==false) {
        return 'YandexBot';
    }
    if (strpos($useragent, 'sinaweibobot')!==false) {
        return 'SinaWeiboBot';
    }
    if (strpos($useragent, 'catchbot')!==false) {
        return 'CatchBot';
    }
    if (strpos($useragent, 'surveybot')!==false) {
        return 'SurveyBot';
    }
    if (strpos($useragent, 'dotbot')!==false) {
        return 'DotBot';
    }
    if (strpos($useragent, 'purebot')!==false) {
        return 'Purebot';
    }
    if (strpos($useragent, 'ccbot')!==false) {
        return 'CCBot';
    }
    if (strpos($useragent, 'mlbot')!==false) {
        return 'MLBot';
    }
    if (strpos($useragent, 'adsbot-google')!==false) {
        return 'AdsBot-Google';
    }
    if (strpos($useragent, 'ahrefsbot')!==false) {
        return 'AhrefsBot';
    }
    if (strpos($useragent, 'spbot')!==false) {
        return 'spbot';
    }
    if (strpos($useragent, 'augustbot')!==false) {
        return 'AugustBot';
    }
    return false;
}

function cc_defender()
{
    $iptoken = md5(x_real_ip() . date('Ymd')) . md5(time() . rand(11111, 99999));
    if ((!isset($_COOKIE['sec_defend']) || substr($_COOKIE['sec_defend'], 0, 32)!==substr($iptoken, 0, 32))) {
        if (!$_COOKIE['sec_defend_time']) {
            $_COOKIE['sec_defend_time'] = 0;
        }
        $sec_defend_time = $_COOKIE['sec_defend_time'] + 1;
        include_once(SYSTEM_ROOT . 'hieroglyphy.class.php');
        $x = new hieroglyphy();
        $setCookie = $x->hieroglyphyString($iptoken);
        header('Content-type:text/html;charset=utf-8');
        if ($sec_defend_time >= 10) {
            exit('浏览器不支持COOKIE或者不正常访问！');
        }
        echo '<html><head><meta http-equiv="pragma" content="no-cache"><meta http-equiv="cache-control" content="no-cache"><meta http-equiv="content-type" content="text/html;charset=utf-8"><title>正在加载中</title><script>function setCookie(name,value){var exp = new Date();exp.setTime(exp.getTime() + 60*60*1000);document.cookie = name + "="+ escape (value).replace(/\+/g, \'%2B\') + ";expires=" + exp.toGMTString() + ";path=/";}function getCookie(name){var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");if(arr=document.cookie.match(reg))return unescape(arr[2]);else return null;}var sec_defend_time=getCookie(\'sec_defend_time\')||0;sec_defend_time++;setCookie(\'sec_defend\',' . $setCookie . ');setCookie(\'sec_defend_time\',sec_defend_time);if(sec_defend_time>1)window.location.href="./index.php";else window.location.reload();</script></head><body></body></html>';
        exit(0);
    } elseif (isset($_COOKIE['sec_defend_time'])) {
        setcookie('sec_defend_time', '', time() - 604800, '/');
    }
}
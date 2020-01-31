<?php
$install = true;
require_once('../includes/common.php');
//include_once ('../includes/core.php');
@header('Content-Type: text/html; charset=UTF-8');
if (!$conf['version'] || !$conf['version'] != ""){
    //数据库不完整
    exit("<script language='javascript'>alert('网站数据库升级失败！');window.location.href='../';</script>");
}else{
    if ($conf['version'] <= 1) {
        $sqls = file_get_contents('update_101.sql');
        $version = 101;
    }/*elseif ($conf['version'] <= 100001){
        $sqls = file_get_contents('update_102.sql');
        $version = 102;
    }*/else {
        exit("<script language='javascript'>alert('网站数据库已经是最新版本了！');window.location.href='../';</script>");
        //exit('你的网站已经升级到最新版本了');
    }
}
$explode = explode(';', $sqls);
$num = count($explode);
foreach ($explode as $sql) {
    if ($sql = trim($sql)) {
        $DB->query($sql);
    }
}
//saveSetting('version', $version);
/*$setting = $DB->get_row("SELECT * FROM config WHERE k='version' limit 1");
if (!$setting['v'] || !$setting['v'] != "")
{
    echo '程序出错';
} else{
    if (!$DB->query("update config set v='$version' where k='version'"))
        echo '程序出错';
}*/
exit("<script language='javascript'>alert('网站数据库升级完成！');window.location.href='../';</script>");


<?php
$install = true;
$debugMode = false;
require_once('../includes/common.php');
require '../includes/predis/autoload.php';
$update_token = isset($_GET['token']) ? $_GET['token'] : "";
$update_code = isset($_GET['code']) ? $_GET['code'] : "";
$ActionCodeTmp = $_SESSION['ActionCode'] ? $_SESSION['ActionCode'] : "";
if ($update_token == "" || $update_code == ""){
    exit("<script language='javascript'>alert('参数缺失，请稍后重试！');window.location.href='../';</script>");
}
try {
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    $random_key = $redis -> get("RandomKeyTmp");
    $redis -> del("RandomKeyTmp");
    if ($random_key == null || $random_key == ""){
        if ($redis->isConnected())
            $redis->disconnect();
        exit("<script language='javascript'>alert('程序异常，请稍后重试！');window.location.href='../';</script>");
    } elseif ($ActionCodeTmp == ""){
        if ($redis->isConnected())
            $redis->disconnect();
        exit("<script language='javascript'>alert('授权码不存在，请稍后重试！');window.location.href='../';</script>");
    } else {
        Security::set_256_key($random_key);
        $ActionCodeTmp = Security::encrypt($ActionCodeTmp);
    }
    $ActionCode = $redis -> get("ActionCodeTmp");
    $redis -> del("ActionCodeTmp");
    if ($ActionCode == null || $ActionCode == "" || $ActionCode != $ActionCodeTmp){
        if ($redis->isConnected())
            $redis->disconnect();
        exit("<script language='javascript'>alert('授权码验证失败，请稍后重试！');window.location.href='../';</script>");
    }
    $random_code = $redis -> get($update_token);
    if ($random_code == null || $random_code == "") {
        if ($redis->isConnected())
            $redis->disconnect();
        exit("<script language='javascript'>alert('token异常，请稍后重试！');window.location.href='../';</script>");
    } elseif ($random_code == $update_code){
        /**
         * 使用过后清除key
         * 无法再次使用
         */
        $redis-> del ($update_token);
    } else {
        if ($redis->isConnected())
            $redis->disconnect();
        exit("<script language='javascript'>alert('参数校验失败，请稍后重试！');window.location.href='../';</script>");
    }
    if ($redis->isConnected())
        $redis->disconnect();
} catch (Exception $e){
    if ($redis->isConnected())
        $redis->disconnect();
    exit("<script language='javascript'>alert('redis异常，请稍后重试！');window.location.href='../';</script>");
}
/**
 * 遍历文件目录
 * 不遍历patch目录，但是最后执行完毕会删除
 * @param $file
 * @return array
 */
function list_file($file){
    //初始化数组
    $file_arr = array();
    //1、首先先读取文件夹
    $temp=scandir($file);
    //遍历文件夹
    foreach($temp as $v){
        $a=$file.'/'.$v;
        if(is_dir($a) && $a != $file.'/patch'){//如果是文件夹则执行
            if($v=='.' || $v=='..'){//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环再这里。
                continue;
            }
            //echo "<font color='red'>$a</font>","<br/>"; //把文件夹红名输出
            list_file($a);//因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
        }else{
            $file_arr[] = $a;
        }
    }
    return $file_arr;
}

/**
 * 解析version
 * @param $file_name
 * @return false|string
 */
function get_Version($file_name){
    return substr(strstr($file_name,"_"),1,stripos(strstr($file_name,"_"),".") - 1);
}

/**
 * 删除文件
 * @param $file
 * @return bool
 */
function del_UpdateFile($file){
    if (file_exists($file)){
        $status = unlink($file);
        return $status;
    }
}

function delFile($dirName,$delSelf=false){
    if(file_exists($dirName) && $handle = opendir($dirName)){
        while(false !==($item = readdir( $handle))){
            if($item != '.' && $item != '..'){
                if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                    delFile($dirName.'/'.$item);
                }else{
                    if(!unlink($dirName.'/'.$item)){
                        return false;
                    }
                }
            }
        }
        closedir($handle);
        if($delSelf){
            if(!rmdir($dirName)){
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}

//清空文件夹函数和清空文件夹后删除空文件夹函数的处理
function deldir($path){
    //如果是目录则继续
    if(is_dir($path)){
        //扫描一个文件夹内的所有文件夹和文件并返回数组
        $p = scandir($path);
        foreach($p as $val){
            //排除目录中的.和..
            if($val !="." && $val !=".."){
                //如果是目录则递归子目录，继续操作
                if(is_dir($path.$val)){
                    //子目录中操作删除文件夹和文件
                    deldir($path.$val.'/');
                    //目录清空后删除空文件夹
                    @rmdir($path.$val.'/');
                }else{
                    //如果是文件直接删除
                    unlink($path.$val);
                }
            }
        }
    }
}

/**
 * 判断更新类型
 * type:1 为php类需执行类别
 * type:2 为sql类
 * type:3 不处理
 * @param $value
 * @return int
 */
function checkFile($value){
    $type = 0;
    if ($value == null || $value == ""){
        $type = 0;
    }elseif (endsWith($value, ".php")){
        $type = 1;
    }elseif (endsWith($value, ".sql")){
        $type = 2;
    }
    return $type;
}
// Function to check the string is ends
// with given substring or not
function endsWith($string, $endString)
{
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}
// Function to check string starting
// with given substring
function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
@header('Content-Type: text/html; charset=UTF-8');
/**
 * get Data Version
 */
$version_sql = "select v from `config` where k = 'version'";
$data_version = $DB -> get_column($version_sql);
if ($data_version == null || $data_version == ""){
    //数据库不完整
    exit("<script language='javascript'>alert('网站数据库升级失败！');window.location.href='../';</script>");
}else{
    $file = "./update_file";
    $fileList = list_file($file);
    $update_num = 0;
    /**
     * 无update文件
     */
    if (count($fileList) == 0 && $debugMode == false){
        exit("<script language='javascript'>alert('未发现数据库更新文件！');window.location.href='../';</script>");
    }
    foreach ($fileList as $value)
    {
        $update_num ++;
        $version = get_Version(explode("/",$value)[2]);
        if ($data_version < $version || $update_num <= count($fileList) && count($fileList) > 0){
            if ($version != null || $version != "") {
                /**
                 * type:0 忽略
                 * type:1 php
                 * type:2 sql
                 */
                switch (checkFile($value)) {
                    case "0":
                        //jump，不操作
                        break;
                    case "1":
                        include_once $value;
                        break;
                    case "2":
                        /**
                         * get sql
                         **/
                        $sqls = file_get_contents($value);
                        /**
                         * run Sql COMMAND
                         */
                        $explode = explode(';', $sqls);
                        $num = count($explode);
                        foreach ($explode as $sql) {
                            if ($sql = trim($sql)) {
                                $DB->query($sql);
                            }
                        }
                        break;
                }
                /**
                 * save version
                 */
                if (!$DB->query("update config set v='$version' where k='version'")) {
                    exit("<script language='javascript'>alert('程序出错');window.location.href='../';</script>");
                    break;
                }
            }
            /**
             * 删除文件
             */
            if ($debugMode == false) {
                if ($update_num >= count($fileList)){
                    deldir($file.'/');
                }else {
                    if (checkFile($value) == 1 && checkFile($value) == 2) {
                        if (del_UpdateFile($value) == false) {
                            exit("<script language='javascript'>alert('删除文件错误！');window.location.href='../';</script>");
                            break;
                        }
                    } else {
                        //不处理
                    }
                }
            }
            /**
             * 全部执行完毕
             * 升级完成
             */
            if ($update_num >= count($fileList) && $debugMode == false) {
                exit("<script language='javascript'>alert('网站数据库升级完成！');window.location.href='../';</script>");
                break;
            }
        } else
            exit("<script language='javascript'>alert('网站数据库已经是最新版本了！');window.location.href='../';</script>");
    }
}


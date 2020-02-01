<?php
$install = true;
require_once('../includes/common.php');
require '../includes/predis/autoload.php';
$update_token = isset($_GET['token']) ? $_GET['token'] : "";
$update_code = isset($_GET['code']) ? $_GET['code'] : "";
if ($update_token == "" || $update_code == ""){
    exit("<script language='javascript'>alert('参数缺失，请稍后重试！');window.location.href='../';</script>");
}
try {
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    $random_code = $redis->get($update_token);
    if ($random_code == null || $random_code == "") {
        exit("<script language='javascript'>alert('token异常，请稍后重试！');window.location.href='../';</script>");
    } elseif ($random_code == $update_code){
        /**
         * 使用过后清除key
         * 无法再次使用
         */
        $redis->del($update_token);
    } else {
        exit("<script language='javascript'>alert('参数校验失败，请稍后重试！');window.location.href='../';</script>");
    }
} catch (Exception $e){
    exit("<script language='javascript'>alert('redis异常，请稍后重试！');window.location.href='../';</script>");
}
/**
 * 遍历文件目录
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
        if(is_dir($a)){//如果是文件夹则执行
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
    $sql_file = list_file($file);
    $update_num = 0;
    /**
     * 无update文件
     */
    if (count($sql_file) == 0){
        exit("<script language='javascript'>alert('未发现数据库更新文件！');window.location.href='../';</script>");
    }
    foreach ($sql_file as $value)
    {
        $update_num ++;
        $version = get_Version(explode("/",$value)[2]);
        if ($data_version < $version){
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
            /**
             * save version
             */
            if (!$DB->query("update config set v='$version' where k='version'")){
                exit("<script language='javascript'>alert('程序出错');window.location.href='../';</script>");
                break;
            }
            /**
             * 删除文件
             */
            if (del_UpdateFile($value) == false){
                exit("<script language='javascript'>alert('删除文件错误！');window.location.href='../';</script>");
                break;
            }
            /**
             * 全部执行完毕
             * 升级完成
             */
            if ($update_num >= count($sql_file)) {
                exit("<script language='javascript'>alert('网站数据库升级完成！');window.location.href='../';</script>");
                break;
            }
        } else
            exit("<script language='javascript'>alert('网站数据库已经是最新版本了！');window.location.href='../';</script>");
    }
}


<?php
//$is_defend=false;
include_once '../includes/common.php';
require '../includes/predis/autoload.php';

function getAccount(){
    //连接本地的 Redis 服务
    $redis = new Predis\Client();
    //读取IMEI是否生成过账号
    $imei = Security::public_decrypt(Security::public_decrypt($_GET['imei']));
    if ($imei == null || $imei == '')
        exit(JSON(array("code" => Security::public_encrypt("-1"),"msg" => Security::public_encrypt("数据为空或解密异常"))));
    $tmp_Account = $redis->get("Imei_tmp".$imei);
    if ($tmp_Account != '')
        return $tmp_Account;
    //生成账号
    $new_Account = mt_rand(10000000,99999999);
    while ($redis->sismember("AccountList", $new_Account) || $redis->get("Acount_tmp".$new_Account) == "tmp" || $new_Account == '10000000'){
        //写账号信息
        $new_Account = mt_rand(10000000,99999999);
    }
    //写账号总数据，写IMEI_TMP数据，有效期60分钟
    //写入imei缓存，对应key为账号，成功激活后算一次成功注册
    $redis->set("Imei_tmp".$imei, $new_Account);
    $redis->expire("Imei_tmp".$imei, 3600);
    //写入账号缓存，成功激活后账号不失效
    $redis->set("Acount_tmp".$new_Account, "tmp");
    $redis->expire("Acount_tmp".$new_Account, 3600);
    //注册成功，生成六位数激活码,验证码会存在有效期
    //$redis->set("Account_tmp".$new_Account, mt_rand(100000,999999));
    //$redis->expire("Account_tmp".$new_Account, 600);
    //下一步为激活后写入AccountList，未激活状态账号会在一定时间后失效
    //$redis->sadd("AccountList", $new_Account);
    //test 列出全部内容
    //var_dump($redis->smembers("AccountList"));
    if ($redis->isConnected())
        $redis->disconnect();
    return $new_Account;
}
$account = getAccount();
if(empty($account) || $account == null){
    exit(JSON(array("code" => Security::public_encrypt("-2"),"msg" => Security::public_encrypt("账号生成失败"))));
}else{
    exit(JSON(array("code" => Security::public_encrypt("0"),"account" => Security::public_encrypt($account))));
}
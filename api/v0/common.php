<?php

/**
 * 初始化数据库等
 * 接口key校验
 * stiei20201014war
 * zhangzhaohong
 */
include_once '../../includes/common.php';
$key = $_GET['api_key'];
if ($key != 'stiei20201014war') {
    exit(JSON(array(
        "code" => "-101",
        "msg" => "接口未授权！"
    )));
}

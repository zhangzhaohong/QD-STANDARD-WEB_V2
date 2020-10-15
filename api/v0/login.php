<?php
include_once 'login_common.php';

exit(JSON(array(
    "code" => "0",
    "msg" => "登录成功",
    "userInfo" => array(
        "userId" => $account,
        "headUrl" => $row['user_avatar'],
        "userPrivateName" => $row['private_name'],
        "userPhoneNumber" => $row['user_phoneNumber'],
        "userKey" => $row['user_key']
    )
)));
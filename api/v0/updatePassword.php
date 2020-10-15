<?php
include_once 'login_common.php';

$newPassword = $_GET['newPassword'];

if ($newPassword != "" && $newPassword != null) {
    if ($DB->query("update users set password='$newPassword' where account='{$account}'")) {
        exit(JSON(
            array(
                "code" => "0",
                "msg" => "修改成功！"
            )
        ));
    } else {
        exit(JSON(
            array(
                "code" => "-6",
                "msg" => "数据库写入失败！"
            )
        ));
    }
} else {
    exit(JSON(
        array(
            "code" => "-7",
            "msg" => "新密码不能为空！"
        )
    ));
}
<?php
include_once 'common.php';

$account = $_GET['account'];
$password = $_GET['password'];

if ($account || $password) {
    $row = $DB->get_row("SELECT * FROM users WHERE account='{$account}' limit 1");
    if ($account == "" || $password == "") {
        //账号密码不能为空
        exit(JSON(array(
            "code" => "-1",
            "msg" => "账号密码不能为空"
        )));
    } else {
        if ($row) {
            if ($row['password'] == $password) {
                $a = explode('-', $row['user_available_date']);
                $c = mktime(0, 0, 0, $a[1], $a[2], $a[0]);
                $b = time();
                if ($row['user_level'] == "禁止访问") {
                    //禁止访问
                    exit(JSON(array(
                        "code" => "-4",
                        "msg" => "账号已被封禁"
                    )));
                } else if ($b <= $c) {
                    //登录成功

                } else {
                    //账号过期
                    exit(JSON(array(
                        "code" => "-5",
                        "msg" => "账号过期"
                    )));
                }
            } else {
                //密码错误
                exit(JSON(array(
                    "code" => "-3",
                    "msg" => "密码错误"
                )));
            }

        } else {
            //账号不存在
            exit(JSON(array(
                "code" => "-2",
                "msg" => "账号不存在"
            )));
        }
    }
} else {
    //账号密码不能为空
    exit(JSON(array(
        "code" => "-1",
        "msg" => "账号密码不能为空"
    )));
}
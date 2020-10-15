<?php
include_once 'common.php';

$userName = $_GET['userName'];
$privateName = $_GET['privateName'];
$phoneNumber = $_GET['phoneNumber'];
$password = $_GET['password'];

if (
    $userName != "" && $userName != null && $privateName != "" && $privateName != null && $phoneNumber != "" && $phoneNumber != null && $password != "" && $password != null
) {
    $row = $DB->get_row("SELECT * FROM users WHERE account='{$userName}' limit 1");
    if ($row) {
        exit(JSON(array(
            "code" => "-1",
            "msg" => "原账号已存在，注册失败！"
        )));
    } else {
        $avatar = 'https://storage.tracup.com/o_1ekl8jvoc1cua189s11kl1inbpnca.png';
        $user_birthday = '2000-01-01';
        $user_email = 'NULL';
        $user_level = '0';
        $log_level = '0';
        $user_available_date = '2100-01-01';
        $user_key = Security::public_encrypt($account . $user_birthday . $password . mt_rand(1000000000, 9999999999));
        if (!$DB->query("insert into `users` (`account`,`password`,`private_name`,`user_birthday`,`user_email`,`user_key`,`user_level`,`log_level`,`user_available_date`,`user_avatar`,`user_phoneNumber`) values ('" . $userName . "','" . $password . "','" . $privateName . "','" . $user_birthday . "','" . $user_email . "','" . $user_key . "','" . $user_level . "','" . $log_level . "','" . $user_available_date . "','" . $avatar . "','" . $phoneNumber . "')"))
            exit(JSON(array(
                "code" => "-2",
                "msg" => "数据库修改失败！"
            )));
        if (!$DB->query("INSERT INTO `users_data`(`account`, `user_key`) VALUES ('" . $userName . "','" . $user_key . "')"))
            exit(JSON(array(
                "code" => "-2",
                "msg" => "数据库修改失败！"
            )));
        if (!$DB->query("INSERT INTO `users_member`(`account`, `user_key`) VALUES ('" . $userName . "','" . $user_key . "')"))
            exit(JSON(array(
                "code" => "-2",
                "msg" => "数据库修改失败！"
            )));
        exit(JSON(array(
            "code" => "0",
            "msg" => "注册成功！"
        )));;
    }
}

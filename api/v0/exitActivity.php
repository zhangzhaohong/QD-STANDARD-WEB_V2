<?php

include_once 'common.php';

$activity_id = $_GET['activityId'];
$user_key = $_GET['userKey'];

if ($activity_id || $user_key) {
    $enjoyRow = $DB->get_row("SELECT * FROM activity_stuInfo WHERE student_userKey='{$user_key}' and activity_jobId='{$activity_id}' limit 1");
    if ($enjoyRow) {
        $activityRow = $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$activity_id}' limit 1");
        if ($activityRow) {
            $sql = "DELETE FROM activity_stuInfo WHERE student_userKey='{$user_key}' and activity_jobId='{$activity_id}' limit 1";
            if (!$DB->query($sql))
                exit(JSON(
                    array(
                        "code" => "-4",
                        "msg" => "数据库错误，退出失败！"
                    )
                ));
            $stuNum = $activityRow['activity_joinedNum'] - 1;
            if ($stuNum < 0)
                $stuNum = 0;
            $DB->query("update activity_data set activity_joinedNum='$stuNum' where jobid='{$activity_id}'");
            exit(JSON(
                array(
                    "code" => "0",
                    "msg" => "退出成功！"
                )
            ));
        } else {
            exit(JSON(
                array(
                    "code" => "-3",
                    "msg" => "当前活动不存在，请重试！"
                )
            ));
        }
    } else {
        exit(JSON(
            array(
                "code" => "-2",
                "msg" => "您尚未加入该活动，不可退出！"
            )
        ));
    }
} else {
    exit(JSON(
        array(
            "code" => "-1",
            "msg" => "活动ID和userKey不可以为空！"
        )
    ));
}
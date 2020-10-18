<?php

include_once 'common.php';

$activity_id = $_GET['activityId'];
$user_key = $_GET['userKey'];

if ($activity_id || $user_key) {
    $enjoyRow = $DB->get_row("SELECT * FROM activity_stuInfo WHERE student_userKey='{$user_key}' and activity_jobId='{$activity_id}' limit 1");
    if ($enjoyRow) {
        exit(JSON(
            array(
                "code" => "-2",
                "msg" => "您已经加入该活动，不可重复加入！"
            )
        ));
    } else {
        $activityRow = $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$activity_id}' limit 1");
        if ($activityRow) {
            if ($activityRow['activity_joinedNum'] < $activityRow['activity_maxNum']) {
                $time = date('Y-m-d H:i:s');
                if (!$DB->query("INSERT INTO `activity_stuInfo`(`activity_jobId`, `student_userKey`, `operation_time`) VALUES ('" . $activity_id . "','" . $user_key . "','" . $time . "')"))
                    exit(JSON(
                        array(
                            "code" => "-5",
                            "msg" => "数据库错误，加入失败！"
                        )
                    ));
                $stuNum = $activityRow['activity_joinedNum'] + 1;
                $DB->query("update activity_data set activity_joinedNum='$stuNum' where jobid='{$activity_id}'");
                exit(JSON(
                    array(
                        "code" => "0",
                        "msg" => "加入成功！"
                    )
                ));
            } else {
                exit(JSON(
                    array(
                        "code" => "-4",
                        "msg" => "活动已满员，加入失败！"
                    )
                ));
            }
        } else {
            exit(JSON(
                array(
                    "code" => "-3",
                    "msg" => "当前活动不存在，请重试！"
                )
            ));
        }
    }
} else {
    exit(JSON(
        array(
            "code" => "-1",
            "msg" => "活动ID和userKey不可以为空！"
        )
    ));
}
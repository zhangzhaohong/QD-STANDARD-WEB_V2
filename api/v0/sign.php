<?php

include_once 'common.php';

$course_id = $_GET['courseId'];
$user_key = $_GET['userKey'];

if ($course_id || $user_key) {
    $enjoyRow = $DB->get_row("SELECT * FROM course_stuInfo WHERE student_userKey='{$user_key}' and course_jobId='{$course_id}' limit 1");
    if ($enjoyRow) {
        $signedDate = date("Ymd");
        if ($enjoyRow['signed_date'] == "" || $enjoyRow['signed_time'] != null && $enjoyRow['signed_date'] < $signedDate) {
            if ($enjoyRow['signed_time'] == "" || $enjoyRow['signed_time'] == null) {
                $signedTime = '0';
            } else {
                $signedTime = $enjoyRow['signed_time'];
            }
            $signedTime = $signedTime + 1;
            if (!$DB->query("update course_stuInfo set signed_time='$signedTime', signed_date='$signedDate' where course_jobid='{$course_id}'")) {
                exit(JSON(array(
                    "code" => "-3",
                    "msg" => "数据库写入异常，签到失败！"
                )));
            }
            $userRows = $DB->get_row("select * from users where user_key='{$user_key}' limit 1");
            if ($userRows) {
                if ($userRows['signed_times'] == "" || $userRows['signed_times'] == null) {
                    $signed_times = 0;
                } else {
                    $signed_times = $userRows['signed_times'];
                }
            } else {
                $signed_times = 0;
            }
            $signed_times = $signed_times + 1;
            $DB->query("update users set signed_times='$signed_times' where user_key='{$user_key}'");
            exit(JSON(array(
                "code" => "0",
                "msg" => "签到成功！"
            )));
        } else {
            exit(JSON(array(
                "code" => "-4",
                "msg" => "今天您已经签到，请明日再来！"
            )));
        }
    } else {
        exit(JSON(array(
            "code" => "-2",
            "msg" => "未查询到相关信息！"
        )));
    }
} else {
    exit(JSON(array(
        "code" => "-1",
        "msg" => "课程ID和userKey不可为空！"
    )));
}
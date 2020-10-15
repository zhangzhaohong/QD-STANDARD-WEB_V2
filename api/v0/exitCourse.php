<?php

include_once 'common.php';

$course_id = $_GET['courseId'];
$user_key = $_GET['userKey'];

if ($course_id || $user_key) {
    $enjoyRow = $DB->get_row("SELECT * FROM course_stuInfo WHERE student_userKey='{$user_key}' and course_jobId='{$course_id}' limit 1");
    if ($enjoyRow) {
        $courseRow = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$course_id}' limit 1");
        if ($courseRow) {
            $sql = "DELETE FROM course_stuInfo WHERE student_userKey='{$user_key}' and course_jobId='{$course_id}' limit 1";
            if (!$DB->query($sql))
                exit(JSON(
                    array(
                        "code" => "-4",
                        "msg" => "数据库错误，退出失败！"
                    )
                ));
            $stuNum = $courseRow['course_studentNum'] - 1;
            if ($stuNum < 0)
                $stuNum = 0;
            $DB->query("update course_data set course_studentNum='$stuNum' where jobid='{$course_id}'");
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
                    "msg" => "当前课程不存在，请重试！"
                )
            ));
        }
    } else {
        exit(JSON(
            array(
                "code" => "-2",
                "msg" => "您尚未加入该课程，不可退出！"
            )
        ));
    }
} else {
    exit(JSON(
        array(
            "code" => "-1",
            "msg" => "课程ID和userKey不可以为空！"
        )
    ));
}
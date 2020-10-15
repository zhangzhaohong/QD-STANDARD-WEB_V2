<?php

include_once 'common.php';

$course_id = $_GET['courseId'];
$user_key = $_GET['userKey'];

if ($course_id || $user_key) {
    $enjoyRow = $DB->get_row("SELECT * FROM course_stuInfo WHERE student_userKey='{$user_key}' and course_jobId='{$course_id}' limit 1");
    if ($enjoyRow) {
        exit(JSON(
            array(
                "code" => "-2",
                "msg" => "您已经加入该课程，不可重复加入！"
            )
        ));
    } else {
        $courseRow = $DB->get_row("SELECT * FROM course_data WHERE jobid='{$course_id}' limit 1");
        if ($courseRow) {
            if ($courseRow['course_studentNum'] < $courseRow['course_total']) {
                $time = date('Y-m-d H:i:s');
                if (!$DB->query("INSERT INTO `course_stuInfo`(`course_jobId`, `student_userKey`, `operation_time`) VALUES ('" . $course_id . "','" . $user_key . "','" . $time . "')"))
                    exit(JSON(
                        array(
                            "code" => "-5",
                            "msg" => "数据库错误，加入失败！"
                        )
                    ));
                $stuNum = $courseRow['course_studentNum'] + 1;
                $DB->query("update course_data set course_studentNum='$stuNum' where jobid='{$course_id}'");
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
                        "msg" => "课程已满员，加入失败！"
                    )
                ));
            }
        } else {
            exit(JSON(
                array(
                    "code" => "-3",
                    "msg" => "当前课程不存在，请重试！"
                )
            ));
        }
    }
} else {
    exit(JSON(
        array(
            "code" => "-1",
            "msg" => "课程ID和userKey不可以为空！"
        )
    ));
}
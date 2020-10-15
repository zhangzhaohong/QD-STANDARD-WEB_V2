<?php
include_once 'common.php';

$userKey = $_GET['userKey'];

$row = $DB->get_row("SELECT * FROM users WHERE user_key='{$userKey}' limit 1");

function getTime($week, $startHour, $endHour)
{
    if ($week == '0') {
        $week = '周一';
    } else if ($week == '1') {
        $week = '周二';
    } else if ($week == '2') {
        $week = '周三';
    } else if ($week == '3') {
        $week = '周四';
    } else if ($week == '4') {
        $week = '周五';
    } else if ($week == '5') {
        $week = '周六';
    } else if ($week == '6') {
        $week = '周日';
    }
    return $week . "  " . $startHour . " - " . $endHour;
}

if ($row) {
    $data = array();
    $sql = "1";
    $rs = $DB->query("SELECT * FROM course_data WHERE {$sql} order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        if ($res['course_type'] == "") {
            $courseType = "必修";
        } else if ($res['course_type'] == "0") {
            $courseType = "必修";
        } else {
            $courseType = "选修";
        }
        $enjoyRow = $DB->get_row("SELECT * FROM course_stuInfo WHERE student_userKey='{$userKey}' and course_jobId='{$res['jobid']}' limit 1");
        if ($enjoyRow) {
            $enjoyStatus = "1";
        } else {
            $enjoyStatus = "0";
        }
        $data[] = array(
            "course_id" => $res['jobid'],
            "course_title" => $res['course_title'],
            "course_type" => $courseType,
            "course_time" => getTime($res['course_time_week'], $res['course_time_startHour'], $res['course_time_endHour']),
            "course_place" => $res['course_place'],
            "course_college" => $res['course_college'],
            "course_length" => $res['course_length'],
            "course_total" => $res['course_total'],
            "course_studentNum" => $res['course_studentNum'],
            "enjoy_status" => $enjoyStatus
        );
    }
    exit(JSON(
        array(
            "code" => "0",
            "msg" => "获取成功！",
            "courseList" => $data
        )
    ));
} else {
    exit(JSON(
        array(
            "code" => "-1",
            "msg" => "当前UserKey非法！"
        )
    ));
}
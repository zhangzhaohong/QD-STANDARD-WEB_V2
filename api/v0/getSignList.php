<?php

include_once 'common.php';

$user_key = $_GET['userKey'];

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

if ($user_key) {
    $data = array();
    $sql = "student_userKey='{$user_key}'";
    $rs = $DB->query("SELECT * FROM course_stuInfo WHERE {$sql} order by jobid desc");
    while ($res = $DB->fetch($rs)) {
        $rows = $DB->get_row("select * from course_data where jobid='{$res['course_jobId']}' limit 1");
        if ($rows) {
            if ($res['signed_time'] <= $rows['course_length']) {
                if ($res['signed_date'] == "" || $res['signed_date'] == null) {
                    $haveSigned = '0';
                } else if ($res['signed_date'] >= date("Ymd")) {
                    $haveSigned = '1';
                } else {
                    $haveSigned = '0';
                }
                if ($res['signed_time'] == "" || $res['signed_time'] == null) {
                    $signedTime = '0';
                } else {
                    $signedTime = $res['signed_time'];
                }
                $data[] = array(
                    "course_id" => $rows['jobid'],
                    "course_title" => $rows['course_title'],
                    "course_time" => getTime($rows['course_time_week'], $rows['course_time_startHour'], $rows['course_time_endHour']),
                    "course_place" => $rows['course_place'],
                    "course_length" => $rows['course_length'],
                    "signed_time" => $signedTime,
                    "have_signed" => $haveSigned
                );
            }
        }
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
    exit(JSON(array(
        "code" => "0",
        "msg" => "签到列表获取成功！",
        "signList" => $data,
        "signed_times" => $signed_times
    )));
} else {
    exit(JSON(array(
        "code" => "-1",
        "msg" => "UserKey非法！"
    )));
}

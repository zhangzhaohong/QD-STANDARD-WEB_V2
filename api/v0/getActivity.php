<?php

include_once 'common.php';

$activity_id = $_GET['activityId'];
$user_key = $_GET['userKey'];

function dealText($str)
{
    $str = trim($str); //清除字符串两边的空格
    $str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str);
    $str = preg_replace("/\r/","",$str);
    $str = preg_replace("/\n/","",$str);
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/  /","",$str);  //匹配html中的空格
    return trim($str); //返回字符串
}

if ($activity_id || $user_key) {
    $rowActivity =  $DB->get_row("SELECT * FROM activity_data WHERE jobid='{$activity_id}' limit 1");
    if ($rowActivity) {
        $enjoyRow = $DB->get_row("SELECT * FROM activity_stuInfo WHERE student_userKey='{$user_key}' and activity_jobId='{$activity_id}' limit 1");
        if ($enjoyRow) {
            $isJoined = '1';
        } else {
            $isJoined = '0';
        }
        $data = array(
            "activity_title" => $rowActivity['activity_title'],
            "activity_content" => dealText($rowActivity['activity_content']),
            "activity_pic" => $rowActivity['activity_pic'],
            "activity_vid" => $rowActivity['activity_vid'],
            "activity_joinedNum" => $rowActivity['activity_joinedNum'],
            "activity_maxNum" => $rowActivity['activity_maxNum'],
            "isJoined" => $isJoined
        );
        exit(JSON(array(
            "code" => "0",
            "msg" => "获取成功",
            "activityInfo" => $data
        )));
    } else {
        exit(JSON(array(
            "code" => "-2",
            "msg" => "课程信息不存在！"
        )));
    }
} else {
    exit(JSON(array(
        "code" => "-1",
        "msg" => "活动ID和用户userKey不可以为空！"
    )));
}
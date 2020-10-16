<?php

include_once 'common.php';

$data = array();

$rs = $DB->query("SELECT * FROM activity_data WHERE 1 order by jobid desc");
while ($res = $DB->fetch($rs)) {
    $data[] = array(
        "activity_id" => $res['jobid'],
        "activity_title" => $res['activity_title'],
        "activity_joinedNum" => $res['activity_joinedNum'],
        "activity_maxNum" => $res['activity_maxNum']
    );
}

exit(JSON(array(
    "code" => "0",
    "msg" => "活动列表获取成功！",
    "activityList" => $data
)));
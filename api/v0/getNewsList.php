<?php

include_once 'common.php';

$data = array();

$rs = $DB->query("SELECT * FROM news_data WHERE 1 order by jobid desc");
while ($res = $DB->fetch($rs)) {
    $data[] = array(
        "title" => $res['title'],
        "date" => $res['date'],
        "status" => $res['status']
    );
}

exit(JSON(array(
    "code" => "0",
    "msg" => "新闻列表获取成功！",
    "newsList" => $data
)));
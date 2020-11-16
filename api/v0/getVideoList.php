<?php
include_once 'common.php';

$sql = "file_type=0";
$data = array();

$rs = $DB->query("SELECT * FROM live_data WHERE {$sql} order by jobid desc");
while ($res = $DB->fetch($rs)) {
    $data[] = array(
        "cover" => $res['cover'],
        "file" => $res['file'],
        "content" => $res['content']
    );
}

exit(JSON(array(
    "code" => "0",
    "data" => $data
)));
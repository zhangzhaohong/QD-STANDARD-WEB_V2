<?php

include_once 'common.php';

$data = array();

$rs = $DB->query("SELECT * FROM menu_data WHERE 1 order by jobid desc");
while ($res = $DB->fetch($rs)) {
    $data[] = array(
        "title" => $res['title'],
        "price" => $res['price'],
        "unit" => $res['unit'],
        "description" => $res['description']
    );
}

exit(JSON(array(
    "code" => "0",
    "msg" => "菜单列表获取成功！",
    "menuList" => $data
)));
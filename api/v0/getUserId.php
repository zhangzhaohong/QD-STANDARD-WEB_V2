<?php
include("common.php");

$sql = "select * from users order by jobid desc limit 1";//获取persons中的数据，并按id倒叙排列，取其中两条;
$rs = $DB->query($sql);
$row = $DB->fetch($rs);
$rows = $DB->get_row("SELECT * FROM yonhu WHERE z='10000001' limit 1");
if (empty($row) || $row["account"] < 10000001) {
    exit(JSON(array(
        "code" => "0",
        "userId" => "10000001"))
    );
} else {
    $account = $row["account"] + 1;
    exit(JSON(array(
        "code" => "0",
        "userId" => $account))
    );
}
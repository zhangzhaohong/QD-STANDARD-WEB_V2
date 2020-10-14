<?php
include_once 'common.php';

$data = array();

function editArray($maxNum)
{
    for ($x = 1; $x <= $maxNum; $x++) {
        $random_data = array(mt_rand(0, 1000), mt_rand(0, 1000), mt_rand(0, 1000));
        $array_data = array(
            "roadId" => $x,
            "redLightDuration" => $random_data[0],
            "yellowLightDuration" => $random_data[1],
            "greenLightDuration" => $random_data[2]
        );
        $data[] = $array_data;
    }
    exit(JSON(array(
        "code" => "0",
        "status" => $data
    )));
}

editArray(10);

<?php
include_once 'common.php';

$data = array();

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejra11kj8v56sug641dar1jqgd.jpeg",
    "file" => "",
    "content" => "图片1"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejra11kj1fbf125l1eqrvqr1ggue.jpeg",
    "file" => "",
    "content" => "图片2"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejra11kjt4i1p5sg86brb1o4vf.jpeg",
    "file" => "",
    "content" => "图片3"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejra11kj1thd1s3q124f11og14prg.jpeg",
    "file" => "",
    "content" => "图片4"
);

$data[] = $array_data;

exit(JSON(array(
    "code" => "0",
    "data" => $data
)));
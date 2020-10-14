<?php
include_once 'common.php';

$data = array();

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejprhgik1k3u1fp3div2agcpsb.jpeg",
    "file" => "https://storage.tracup.com/o_1ejpb0d8i1ive10rngdo1ckr1g2518.mp4",
    "content" => "视频1"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejprhgik1f2gilc1u882nd93mc.jpeg",
    "file" => "https://storage.tracup.com/o_1ejpb0d8i86e4r9sf518vc3l119.mp4",
    "content" => "视频2"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejpjn2hr1m1q4ep182f42th4a.jpeg",
    "file" => "https://storage.tracup.com/o_1ejpjnhn81n2a40ic1f4l1u9ef.mp4",
    "content" => "视频3"
);

$data[] = $array_data;

$array_data = array(
    "cover" => "https://storage.tracup.com/o_1ejpbjg0v1lo610dp9v6181ue24.jpeg",
    "file" => "https://storage.tracup.com/o_1ejpb0d8i1meg7njpiafs8qps1b.mp4",
    "content" => "视频4"
);

$data[] = $array_data;

exit(JSON(array(
    "code" => "0",
    "data" => $data
)));
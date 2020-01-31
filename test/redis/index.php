<?php
exit("<script>window.location.href='../../'</script>");
require '../../includes/predis/autoload.php';
//连接本地的 Redis 服务
$redis = new Predis\Client();
//$redis->sadd("testA", array("test1","test2","test3"));
//var_dump($redis->smembers("testA"));
//$redis->expire("testA", 60);
var_dump($redis->smembers("testA"));
if ($redis->sismember("testA", "test1"))
    echo 'Data exist.';
else
    echo 'Data not exist.';
echo '<br>';
echo "Connection to server successfully";
//查看服务是否运行
echo "Server is running: " . $redis->ping();
if ($redis->sismember("AccountList", "12446014"))
    echo 'Data exist.';
else
    echo 'Data not exist.';
echo '<br>';
if ($redis->sismember("AccountList", "10000000"))
    echo 'Data exist.';
else
    echo 'Data not exist.';
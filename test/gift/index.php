<?php
exit("<script>window.location.href='../../'</script>");
include_once 'function.php';
$prize_arr = array(
    '0' => array('id'=>1,'prize'=>'平板电脑','v'=>1),
    '1' => array('id'=>2,'prize'=>'数码相机','v'=>5),
    '2' => array('id'=>3,'prize'=>'音箱设备','v'=>10),
    '3' => array('id'=>4,'prize'=>'4G优盘','v'=>12),
    '4' => array('id'=>5,'prize'=>'10Q币','v'=>22),
    '5' => array('id'=>6,'prize'=>'下次没准就能中哦','v'=>50),
);

foreach ($prize_arr as $key => $val) {
    $arr[$val['id']] = $val['v']; //将$prize_arr放入数组下标为$prize_arr的id元素，值为v元素的数组中
}

$rid = get_rand($arr); //根据概率获取奖项id

$res['yes'] = $prize_arr[$rid-1]['prize']; //获取中奖项

unset($prize_arr[$rid-1]); //将中奖项从数组中剔除，剩下未中奖项
shuffle($prize_arr); //打乱数组顺序
for($i=0;$i<count($prize_arr);$i++){
    $pr[] = $prize_arr[$i]['prize'];
}
$res['no'] = $pr;
include_once '../../includes/JsonFactory.php';
echo JSON($res);
?>
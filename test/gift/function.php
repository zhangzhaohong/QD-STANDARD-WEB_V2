<?php
function get_rand($proArr) {
    $result = '';

    //概率数组的总概率精度
    $proSum = array_sum($proArr); //计算数组中元素的和

    //概率数组循环
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) { //如果这个随机数小于等于数组中的一个元素，则返回数组的下标
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }

    unset ($proArr);

    return $result;
}
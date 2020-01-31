<?php
include_once '../../includes/NodeManager/Node.php';
/**
 * 链表实现栈
 * Class LinklistStack
 * @package app\models
 */
class LinklistStack extends Linklist
{
    /**
     * @param $value
     */
    public function push( $value ){
        $this->addFirst($value);
    }

    /**
     * @return mixed
     */
    public function pop(){
        $r = $this->head->next->val;
        $this->delete(0);
        return $r;
    }
}
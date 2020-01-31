<?php
class Node
{
    public $val;
    public $next;



    public function __construct( $val = null, $next = null )
    {
        $this->val  = $val;
        $this->next = $next;
    }


}
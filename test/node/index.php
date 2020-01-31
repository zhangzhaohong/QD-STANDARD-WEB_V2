<?php
exit("<script>window.location.href='../../'</script>");
include_once '../../includes/NodeManager/LinkList.php';
include_once '../../includes/NodeManager/LinkListQueue.php';
include_once '../../includes/NodeManager/LinklistStack.php';
$node = new Linklist();
$node->addFirst(1);
$node->addFirst(100);
$node->addFirst(168);
//$node->add(1, 7);
//$node->add(2, 10);
//$node->edit(1, 8);
//var_dump($node->select(1));
//$node->delete(1);
$node->addLast(99);
var_dump($node->iscontain(2));
var_export($node);
//var_export($node->tostring());

echo '<br>'.$node->tostring();

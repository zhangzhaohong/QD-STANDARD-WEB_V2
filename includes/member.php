<?php
if(!defined('IN_CRONLITE'))exit();
include_once 'function.php';
$clientip=real_ip();
$islogin=0;
$islogin2=0;

if(isset($_COOKIE["admin_token"]))
{
	$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	if($session==$sid) {
		$islogin=1;
	}
}
if(isset($_COOKIE["user_token"]))
{
	$token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	if($userrow = $DB->get_row("select * from shua_site where user='$user' limit 1")){
		$session=md5($userrow['user'].$userrow['pwd'].$password_hash);
		if($session==$sid) {
			$islogin2=1;
		}
	}
}
?>
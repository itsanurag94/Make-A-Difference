<?php
session_start();

if($_SESSION['SESS_USER_TYPE'] == 0)
{
	require_once('auth.php');
	$role = 0;
}	
else if($_SESSION['SESS_USER_TYPE'] == 1)
{
	require_once('auth_govt.php');
	$role = 1;
}

unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_EMAIL']);
unset($_SESSION['SESS_PASSWORD']);
unset($_SESSION['SESS_MEMBER_ID']);
session_destroy();


if($role==0){
	header("Location: login.php");
}
else if($role==1){
	header("Location: login_govt.php");
}
exit();
?>

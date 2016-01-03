<?php
session_start();

require_once('connection.php');

if($_SESSION['SESS_USER_TYPE'] == 0)
	require_once('auth.php');
else if($_SESSION['SESS_USER_TYPE'] == 1)
	require_once('auth_govt.php');

$email = $_SESSION['SESS_EMAIL'];
$user_type = $_SESSION['SESS_USER_TYPE'];

$password_entered = $_POST['password'];
$password_entered=md5($password_entered);

if($user_type==0)
$query="SELECT password FROM Citizen_reg where email='".$email."' and password='".$password_entered."'";

if($user_type==1)
$query="SELECT password FROM Govt_reg where email='".$email."' and password='".$password_entered."'";

$result=mysqli_query($link, $query);
if($result) 
	{
		$num_rows=mysqli_num_rows($result);
		if( $num_rows > 0)
		{
			header("location: create_new_password.php");
		}
		else
			header("location: change_password.php");
	}

?>
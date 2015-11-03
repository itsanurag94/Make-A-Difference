<?php
echo "Password updated successfully";
session_start();
require_once('connection_1.php');

$email_id = $_SESSION['SESS_EMAIL'];
echo $email_id;
	
$password1 = $_POST['password'];
$password2 = $_POST['re-password'];

if($password1==$password2)
{
	echo "Here";
	$newpassword=md5($password2);
	$sql = "Update user_reg SET password='$newpassword' where email='$email_id'";
	mysql_query($sql);
//	echo "Password updated successfully";
//	mysql_query($newpassd);
	echo "Password updated successfully";
//	sleep(5);
//	if(session_destroy()) // Destroying All Sessions
//	{
	header("Location: successfully_changed.php"); // Redirecting To Home Page
//	}
}
else
{
	header("location: Create_new_password.php");
}
?>
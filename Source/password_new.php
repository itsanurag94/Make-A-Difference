<?php
session_start();
require_once('connection.php');

if($_SESSION['SESS_USER_TYPE'] == 0)
	require_once('auth.php');
else if($_SESSION['SESS_USER_TYPE'] == 1)
	require_once('auth_govt.php');

$email = $_SESSION['SESS_EMAIL'];
echo $email;
$user_type = $_SESSION['SESS_USER_TYPE'];
echo $user_type;
$entered_password_1 = $_POST['new_password'];
$reentered_password_2 = $_POST['reenter_new_password'];

echo $entered_password_1;
echo $reentered_password_2;

if($entered_password_1==$reentered_password_2)
{
	$new_password=md5($entered_password_1);
	if($user_type==0)
	$query = "UPDATE Citizen_reg SET password='$new_password' where email='$email'";
	if($user_type==1)
	$query = "UPDATE Govt_reg SET password='$new_password' where email='$email'";
	mysqli_query($link, $query);
	echo "Password updated successfully";
	header("Location: logout.php"); // Redirecting To Home Page
}
else
{
	header("location: Create_new_password.php");
}
?>

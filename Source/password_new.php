<?php
session_start();
require_once('connection.php');

if($_SESSION['SESS_USER_TYPE'] == 0)
	require_once('auth.php');
else if($_SESSION['SESS_USER_TYPE'] == 1)
	require_once('auth_govt.php');

$email = $_SESSION['SESS_EMAIL'];
$role = $_SESSION['SESS_USER_TYPE'];

$entered_password = $_POST['new_password'];
$reentered_password = $_POST['reenter_new_password'];

if($entered_password == $reentered_password)
{
	$new_password=md5($entered_password);
	if($role==0)
		$query = "UPDATE Citizen_reg SET password='$new_password' where email='$email'";
	if($role==1)
		$query = "UPDATE Govt_reg SET password='$new_password' where email='$email'";
	$result = mysqli_query($link, $query);
	if($result)
		header("location: logout.php"); // Redirecting To Home Page
}
else
	header("location: Create_new_password.php");
?>
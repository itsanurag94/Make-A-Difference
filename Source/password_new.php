<?php
//echo "Password updated successfully";
session_start();
require_once('connection.php');

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
	echo "Here";
	$new_password=md5($entered_password_1);
	if($user_type==0)
	$query = "Update user_reg SET password='$new_password' where email='$email'";
	if($user_type==1)
	$query = "Update govt_reg SET password='$new_password' where email='$email'";
	mysqli_query($link, $query);
	echo "Password updated successfully";
	header("Location: new_index.php"); // Redirecting To Home Page
}
else
{
	header("location: Create_new_password.php");
}
?>

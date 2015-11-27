<?php
echo "Hello";
session_start();

require_once('connection.php');

$email = $_SESSION['SESS_EMAIL'];
$user_type = $_SESSION['SESS_USER_TYPE'];
//echo $user_type;
echo "<br>";

$password_entered = $_POST['password'];
echo $_POST['password'];
$password_entered=md5($password_entered);

echo $password_entered;
echo "<br>";

if($user_type==0)
$query="SELECT password FROM user_reg where email='".$email."' and password='".$password_entered."'";

if($user_type==1)
$query="SELECT password FROM govt_reg where email='".$email."' and password='".$password_entered."'";

$result=mysqli_query($link, $query);
if($result) 
	{
		echo "Here";
		$num_rows=mysqli_num_rows($result);
		if( $num_rows > 0)
		{
			//$passd=mysql_fetch_assoc($result);
			//$current_password=$passd['password'];
			header("location: Create_new_password.php");
		}
		else
			header("location: change_password.php");
	}

?>


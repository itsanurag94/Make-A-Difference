<?php
session_start();
require_once('connection_1.php');
$email_id = $_SESSION['SESS_EMAIL'];
echo $email_id;
//echo md5('123');
//echo $email_id;
echo "<br>";

$password = $_POST['password'];
echo $_POST['password'];
$password=md5($password);

echo $password;
echo "<br>";

$passwd="SELECT password FROM user_reg where email='$email_id' and password='$password'";
$result=mysql_query($passwd);
if($result) 
	{
		if(mysql_num_rows($result) > 0)
		{
			//$passd=mysql_fetch_assoc($result);
			//$current_password=$passd['password'];
			header("location: Create_new_password.php");
		}
		else
			header("location: change_password.php");
	}


//echo $current_password;
//echo "<br>";
//if ($current_password==$password)
//{
	
//}
//else
//echo "Error";

?>

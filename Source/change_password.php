<?php 
	session_start();
	if($_SESSION['SESS_USER_TYPE'] == 0)
		require_once('auth.php');
	else if($_SESSION['SESS_USER_TYPE'] == 1)
		require_once('auth_govt.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
	<form action="check_current_password.php" method="post">
	Enter the current password: <input type="password" name="password" id="password" /><br>
	<input type="submit" value="Change Password">
	</form>
</body>

</html>
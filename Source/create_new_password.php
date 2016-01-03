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
	<form action="password_new.php" method="post">
	Enter the new password: <input type="password" name="new_password" id="new_password" /><br>
	Re-nter the new password: <input type="password" name="reenter_new_password" id="reenter_new_password" /><br>
	<input type="submit" value="Update Password">
	</form>
</body>
</html>



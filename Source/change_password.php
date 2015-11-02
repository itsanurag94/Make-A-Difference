<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
	<h2>
	Hi!! 
	<? php
	echo $email_id; 
	?>
	</h2>
	<form action="check_current_password.php" method="post">
	Enter the current password: <input type="password" name="password" id="password" /><br>
	<input type="submit" value="Change Password">
	</form>
</body>

</html>

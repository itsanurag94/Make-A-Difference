<?php
	//Start session
	session_start();
 
	require_once('connection.php');

	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	$email = mysqli_real_escape_string($link, $_POST['govt_email']);
	$pswd = mysqli_real_escape_string($link, $_POST['govt_pswd']);
	if($email == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($pswd == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) 
	{
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();

		header("location: index.php");
		exit();
	}
 	
 	$pswd = md5($pswd);
	
	$query="SELECT * FROM Govt_reg WHERE email='$email' AND password='$pswd'";
	$result=mysqli_query($link, $query);
 
	$num_rows = mysqli_num_rows($result);
	if($result) {
		if($num_rows > 0)
	    {
			$govt = mysqli_fetch_assoc($result);
			if($govt['active'] == 0)
		    {
				echo "Your account is not yet activated.";
				header("location: index.php");
				exit();
			}

			session_regenerate_id();
			$_SESSION['SESS_MEMBER_ID'] = $govt['gID'];
			$_SESSION['SESS_EMAIL'] = $govt['email'];
			$_SESSION['SESS_PASSWORD'] = $govt['password'];
			$_SESSION['SESS_USER_TYPE'] = 1;
			session_write_close();
			header("location: govt_home.php");
			exit();
		}
		else 
		{
			$errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) 
			{
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
	}
	else 
	{
		die("Query failed");
	}
?>
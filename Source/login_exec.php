<?php
	//Start session
	session_start();
 
	//Include database connection details
	$mysql_hostname = "localhost";
	$mysql_user = "root";
	$mysql_password = "Aravind";
	$mysql_database = "mad";
	$prefix = "";

	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
	mysql_select_db($mysql_database, $bd) or die("Could not select database");
 
	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
 
	//Sanitize the POST values
	$email = clean($_POST['email']);
	$password = clean($_POST['pswd']);
 
	//Input Validations
	if($email == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
 	
 	$password = md5($password);
	//Create query
	$qry="SELECT * FROM user_reg WHERE email='$email' AND password='$password'";
	$result=mysql_query($qry);
 

	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			
			$user = mysql_fetch_assoc($result);
			if($user['active'] == 0) {
				echo "Your account is not yet activated.";
				header("location: index.php");
				exit();
			}

//			$user = mysql_fetch_assoc($result);
			session_regenerate_id();
			$_SESSION['SESS_MEMBER_ID'] = $user['user_id'];
			$_SESSION['SESS_EMAIL'] = $user['email'];
			$_SESSION['SESS_LAST_NAME'] = $user['password'];
			session_write_close();
			header("location: home.php");
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}
?>
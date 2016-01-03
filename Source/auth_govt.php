<?php
	//This helps in returning to the Login page if not logged in.
	//Start session
	session_start();
	//Check whether the session variable SESS_EMAIL is present or not
	if( (!isset($_SESSION['SESS_EMAIL']) || (trim($_SESSION['SESS_EMAIL']) == '')) || $_SESSION['SESS_USER_TYPE'] = 0 ) {
		header("location: login_govt.php");
		exit();
	}
?>
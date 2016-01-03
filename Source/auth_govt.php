<?php
	//This helps in returning to the Login page if not logged in as Citizen.
	session_start();
	if( (!isset($_SESSION['SESS_EMAIL']) || (trim($_SESSION['SESS_EMAIL']) == '')) || $_SESSION['SESS_USER_TYPE'] = 0 ) {
		header("location: login_govt.php");
		exit();
	}
?>
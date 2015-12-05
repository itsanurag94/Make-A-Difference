<?php
	session_start();

	require_once('connection.php');
	include_once 'common.php';
	require_once('auth.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> -->
	<link href="homepage.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<?php

	$email = $_SESSION['SESS_EMAIL'];

	$query="SELECT district, pin_code FROM Citizen where email = '".$email."'";
	$result = mysqli_query($link, $query);
	$citizen = mysqli_fetch_assoc($result);
	$district = $citizen['district'];
	$pin_code = $citizen['pin_code'];


	$query="SELECT * FROM Problem where pin_code = '$pin_code'";
	$result=mysqli_query($link, $query);
	$num_rows = mysqli_num_rows($result);

	$query_1="SELECT dep_name FROM Govt where pin_code = '$pin_code'";
	$result_1=mysqli_query($link, $query_1);
	$dep_name = mysqli_fetch_assoc($result_1);

	if ( $num_rows > 0)
	{
		echo "<br>";

 		while($problem = mysqli_fetch_assoc($result)) 
   		{
   		 	echo "<div class='Problem'>";
        	echo "<div class='view_problem'><br>Title: ".$problem["title"]." &nbsp &nbsp &nbsp  Description: " . $problem["description"]. "<br><br></div>";
        	echo "<div class='view_problem1'><br>Department: ".$dep_name["dep_name"]."&nbsp &nbsp District: " . $problem["district"]. "<br></div>";
        	echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
        	echo "<div class='bluebutton'><form action='problem.php?pID=".$problem["pID"]."' method='post'><input class='bluebutton submitbotton' type='submit' value='View Problem' /></form></div>";
   			echo "</div>";
   		}
   	}
?>
</body>
</html>

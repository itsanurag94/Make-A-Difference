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

	$query="SELECT district FROM users where email = '".$email."'";
	$result = mysqli_query($link, $query);
	$citizen = mysqli_fetch_assoc($result);
	$location = $citizen["district"];

	$query="SELECT * FROM Problems where location = '$location'";
	$result=mysqli_query($link, $query);
	$num_rows = mysqli_num_rows($result);

	if ( $num_rows > 0) 
	{
		echo "<br>";

    // output data of each row
   		 while($problem = mysqli_fetch_assoc($result)) 
   		 {
   		 	echo "<div class='Problem'>";
        	echo "<div class='view_problem'><br>Title: ".$problem["title"]." &nbsp &nbsp &nbsp  Department: " . $problem["description"]. "<br><br></div>";
        	echo "<div class='view_problem1'><br>Description: ".$problem["To_Whom"]."&nbsp &nbsp District: " . $problem["location"]. "<br></div>";
        	echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
        	echo "<div class='bluebutton'><form action='problem.php?pID=".$problem["pID"]."' method='post'><input class='bluebutton submitbotton' type='submit' value='View Problem' /></form></div>";
   			echo "</div>";
   		 }
   	}

?>
</body>
</html>
<?php
	session_start();

	require_once('connection.php');
	include_once 'common.php';
	require_once('auth_govt.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

<body style="text-align:center;">

<b>View problems nearby</b>

<?php

$email = $_SESSION['SESS_EMAIL'];
echo $email;
$query="SELECT district, d_name FROM govt_reg where email = '".$email."'";
$result = mysqli_query($link, $query);
$govt = mysqli_fetch_assoc($result);
$location = $govt["district"];
$department = $govt["d_name"];

//echo $location;
$query="SELECT * FROM Problems where location = '$location' and description='$department'";
$result=mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) 
{
		echo "<br>";
	    while($problem = mysqli_fetch_assoc($result)) 
   		 {
   		 	$votes=$problem['votes'];
   			$query_1 = "SELECT COUNT(*) as count FROM users where distrcit = ".$location." ";
   			$result_1 = mysqli_query($link, $query_1);
   			$number_users = mysqli_fetch_assoc($result_1);
   			//$number_of_users = $number_users['']
   			echo $number_users;
        	echo "<br>Title: <a href='problem.php?pID=".$problem["pID"]."'>".$problem["title"]." </a>  To_whom: " . $problem["to_whom"]. "  Description" . $problem["description"]. "  Location: ".$problem["location"]."<br>";
   		 }
}

?>

</body>
</html>
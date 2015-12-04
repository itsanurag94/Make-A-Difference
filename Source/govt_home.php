<?php
	session_start();
	require_once('connection.php');
	include_once 'common.php';
	require_once('auth.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

<body style="text-align:center;">
<a href="logout.php" align="right" class="style1">Logout </a><br><br>
<a href="change_password.php" align="right" class="style1">Change Password</a>
<br><br>

<b>View problems nearby</b>

<?php

$email = $_SESSION['SESS_EMAIL'];

echo "<br>";
echo $email;
$query="SELECT district, d_name FROM govt_dept where email = '".$email."'";
$result = mysqli_query($link, $query);
$govt = mysqli_fetch_assoc($result);
$location = $govt["district"];
$department = $govt["d_name"];

//echo $location;
$query="SELECT * FROM Problems where location = '$location' and To_Whom='$department'";
$result=mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);
//echo $num_rows;
echo "$num_rows";
if ($num_rows > 0)
	{
		echo "<br>";
    // output data of each row
   		 while($problem = mysqli_fetch_assoc($result)) 
   		 {
   		 	$votes=$problem['votes'];
   			$query_1 = "SELECT email FROM users where district = '".$location."' ";
   			$result_1 = mysqli_query($link, $query_1);
   			$number_users = mysqli_num_rows($result_1);
   	//		$number_of_users = $number_users['count'];
   	//		echo $number_users;
   			if($votes > $number_users/2)
        	echo "<br>Title: <a href='problem.php?pID=".$problem["pID"]."'>".$problem["title"]." </a>  To_whom: " . $problem["description"]. " <br> Description ". $problem["To_Whom"]." <br> Location: ".$problem["location"]." <br><br>";
   		 }
   	}
?>

</body>
</html>
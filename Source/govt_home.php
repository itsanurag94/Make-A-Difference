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
$gID = $_SESSION['SESS_MEMBER_ID'];

/*
$query = "SELECT gID FROM Govt where email = '".$email."'";
$result = mysqli_query($link, $query);
$govt = mysqli_fetch_assoc($result);
$dep_name = $govt["dep_name"];
$district = $govt["district"];
$state = $govt["state"];
*/
echo $_SESSION['SESS_MEMBER_ID'];
$query="SELECT * FROM Problem where to_whom='1'";
$result=mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);
//echo $_SESSION['SESS_MEMBER_ID'];

if ($num_rows > 0)
	{
		echo "<br>";
    // output data of each row
   		 while($problem = mysqli_fetch_assoc($result)) 
   		 {
   		 	$votes=$problem['votes'];
   			$query_1 = "SELECT cID FROM Citizen where district = '".$problem['district']."' and state = '".$problem['state']."' ";
   			$result_1 = mysqli_query($link, $query_1);
   			$number_users = mysqli_num_rows($result_1);
     //   echo $number_users;
   	//		$number_of_users = $number_users['count'];
   	//		echo $number_users;
   			if($votes > $number_users/2)
        	echo "<br>Title: <a href='problem.php?pID=".$problem["pID"]."'>".$problem["title"]." </a>  Description ".$problem["description"]." <br><br>";
   		 }
   	}
?>

</body>
</html>
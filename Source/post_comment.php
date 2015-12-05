<?php
session_start();
//echo $_SESSION['SESS_EMAIL'];
require_once('auth.php');
require_once('connection.php');
if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pid=$_GET['pID'];
	$email = $_SESSION['SESS_EMAIL'];

	$comment = mysqli_real_escape_string($link, $_POST['comment']);
//	echo $comment;
	$query = "select cID,f_name from Citizen where email='$email'";
	$result = mysqli_query($link, $query);
	$citizen_details = mysqli_fetch_assoc($result);
	$f_name=$citizen_details['f_name'];
	$cID = $citizen_details['cID'];
	$query = "INSERT INTO Problem_comment VALUES ('','$pid','$cID','$comment','0','$f_name')";
	
	if(mysqli_query($link, $query))
	{
//		echo "Hello";
		header("location: problem.php?pID=".$pid."");
	}
}

?>
<?php
session_start();
$email = $_SESSION['SESS_EMAIL'];

require_once('connection.php');
if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pid=$_GET['pID'];
	$email = $_SESSION['SESS_EMAIL'];
//	echo $pid;
	$comment = mysqli_real_escape_string($link, $_POST['comment']);
//	echo $comment;
	$query = "select f_name from users where email='$email'";
	$result = mysqli_query($link, $query);
	$f_name_1 = mysqli_fetch_assoc($result);
	$f_name=$f_name_1['$f_name'];
	$query = "INSERT INTO Comments VALUES ('','$pid','$comment','$email','0','$f_name')";
	
	if(mysqli_query($link, $query))
	{
//		echo "Hello";
		header("location: problem.php?pID=".$pid."");
	}
}

?>
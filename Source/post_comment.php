<?php
session_start();
require_once('auth.php');
require_once('connection.php');
if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pID=$_GET['pID'];
	$cID = $_SESSION['SESS_MEMBER_ID'];
	$comment = mysqli_real_escape_string($link, $_POST['comment']);

	$query = "INSERT INTO Problem_comment VALUES ('','$pID','$cID','$comment','0')";
	
	if(mysqli_query($link, $query))
	{
		header('Location: ' . $_SERVER["HTTP_REFERER"] );
		exit;
		//header("location:javascript://history.go(-1)");
		//header("location: problem.php?pID=".$pid."");
	}
}
?>
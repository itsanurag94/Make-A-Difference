<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pID=$_GET['pID'];

	$comment_ID = $comment_id['comment_ID'];

	$query_1 = "DELETE from Problem where pID='$pID'";
	$result_1 = mysqli_query($link, $query_1);

	$query_2 = "DELETE from Problem_media where pID='$pID'";
	$result_2 = mysqli_query($link, $query_2);

	$query_4 = "DELETE from Problem_notified where pID='$pID'";
	$result_4 = mysqli_query($link, $query_4);

	$query_5 = "DELETE from Problem_responded where pID='$pID'";
	$result_5 = mysqli_query($link, $query_5);

	$query_6 = "DELETE from Problem_solved where pID='$pID'";
	$result_6 = mysqli_query($link, $query_6);

	$query_7 = "DELETE from Problem_status where pID='$pID'";
	$result_7 = mysqli_query($link, $query_7);

	$query_3 = "DELETE from Problem_comment where pID='$pID'";
	$result_3 = mysqli_query($link, $query_3);

	$query = "SELECT comment_ID from Response_citizen_comment where pID='$pID'";
	$result = mysqli_query($link, $query);
	$num_rows = mysqli_num_rows($result);

	if($num_rows > 0)
	{
	while($comment_id = mysql_fetch_assoc($result))
	{
	$query_8 = "DELETE from Response_citizen_comment where comment_ID='$comment_ID'";
	$result_8 = mysqli_query($link, $query_8);

//	$query = "DELETE from Response_govt_comment where pID='$pID'";
//	$result = mysqli_query($link, $query);
	$query_9 = "DELETE from Citizen_voted_comment where comment_ID='$comment_ID'";
	$result_9 = mysqli_query($link, $query_9);
	}
	}
	$query_10 = "DELETE from Citizen_voted_problem where pID='$pID'";
	$result_10 = mysqli_query($link, $query_10);
	
	header("location:home_new.php");
}

?>

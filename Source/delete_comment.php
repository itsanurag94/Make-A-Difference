<?php

session_start();
require_once('connection.php');

if(isset($_GET['comment_ID']) && !empty($_GET['comment_ID']))
{
	$comment_id = $_GET['comment_ID'];

	$query = "SELECT pID from Problem_comment where comment_ID='$comment_id'";
	$result = mysqli_query($link, $query);
	$problem_id = mysqli_fetch_assoc($result);
	$pID = $problem_id['pID'];
	echo $pID;

	$query_1 = "DELETE from Response_citizen_comment where comment_ID='$comment_id'";
	$result_1 = mysqli_query($link, $query_1);
	
	$query_2 = "DELETE from Problem_comment where comment_ID='$comment_id'";
	$result_2 = mysqli_query($link, $query_2);

	$query_3 = "DELETE from Citizen_voted_comment where comment_ID='$comment_id'";
	$result_3 = mysqli_query($link, $query_3);

	header("location: problem.php?pID=$pID");
}

?>

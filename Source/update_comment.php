<?php

session_start();
require_once('connection.php');

if(isset($_GET['comment_id']) && !empty($_GET['comment_id']))
{
	$comment_id = $_GET['comment_id'];
	$new_comment = $_POST['new_comment'];
	$query = "UPDATE Problem_comment set comment='$new_comment' where comment_ID='$comment_id'";
	$result = mysqli_query($link, $query);

	$query_1 = "SELECT pID from Problem_comment where comment_ID='$comment_id'";
	$result_1 = mysqli_query($link, $query_1);
	$problem_id = mysql_fetch_assoc($result_1);
	$pid = $problem_id['pID'];

	$result = mysqli_query($link, $query);
	if($result)
		header("location : problem.php?pID=$pid'");
}
<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pID=$_GET['pID'];
	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Citizen_voted_comment where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Govt_voted_comment where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Citizen_voted_problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Govt_response_media where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_comment where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_media where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_notified where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_responded where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_solved where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem_status where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Response_citizen_comment where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Response_govt_comment where pID='$pID'";
	$result = mysqli_query($link, $query);

	header("location: home.php");
}

?>
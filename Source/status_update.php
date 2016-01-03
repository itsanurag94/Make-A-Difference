<?php
require_once('auth.php');
require_once('connection.php');
session_start();
$email = $_SESSION['SESS_EMAIL'];

if(isset($_GET['pID']) && !empty($_GET['pID']) && isset($_GET['status']) && !empty($_GET['status']))
{
	$pID = mysqli_escape_string($link,$_GET['pID']);
	$status = mysqli_escape_string($link,$_GET['status']);

	if($status == 3)
	{
		$query = "UPDATE Problem_status set status = 'taken_up', date_taken_up=now() where pID='$pID'";
	}
	if($status == 4)
	{
		$query = "UPDATE Problem_status set status = 'notified_pincode', date_notified_pincode=now() where pID='$pID'";
	}
	if($status == 5)
	{
		$query = "UPDATE Problem_status set status = 'notified_local', date_notified_local=now() where pID='$pID'";
	}
	if($status == 6)
	{
		$query = "UPDATE Problem_status set status = 'solved', date_solved=now() where pID='$pID'";
	}

	$result = mysqli_query($link, $query);
	if($result)
	{
		header('Location: ' . $_SERVER["HTTP_REFERER"] );
	    exit;
	}
}
?>
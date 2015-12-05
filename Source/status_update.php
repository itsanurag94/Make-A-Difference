<?php
require_once('auth.php');
require_once('connection.php');
session_start();
$email = $_SESSION['SESS_EMAIL'];

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
$pID = $_GET['pID'];
echo $pID;
$query2 = "SELECT status from Problem_status where pID='$pID'";
$result2 = mysqli_query($link, $query2);
$Problem_status = mysqli_fetch_assoc($result2);
$problem_status = $Problem_status['status'];
echo $problem_Status;
/*
if($problem_status == 'taken_up')
{
	$query_1 = "UPDATE Problem_status set status='notified_local', date_notified_local=now() where pID='$pID'";
	$result_1 = mysqli_query($link, $query_1);
	if($result_1)
		header("location: problem.php?pID=$pID");
}*/
}
?>
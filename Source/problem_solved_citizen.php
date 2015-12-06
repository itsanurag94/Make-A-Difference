<?php
require_once('auth.php');
require_once('connection.php');
session_start();

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
$pID = mysqli_escape_string($link, $_GET['pID']);

$query2 = "SELECT status from Problem_status where pID='$pID'";
$result2 = mysqli_query($link, $query2);
$Problem_status = mysqli_fetch_assoc($result2);
$problem_status = $Problem_status['status'];

if($problem_status == 'notified_local')
{
	$query_1 = "UPDATE Problem_status set status='solved_citizen', date_solved_creator=now() where pID='$pID'";
	$result_1 = mysqli_query($link, $query_1);
		header("location: problem.php?pID=$pID");
	
}
if($problem_status == 'solved_govt')
{
	$query_1 = "UPDATE Problem_status set status='solved', date_solved=now() where pID='$pID'";
	$result_1 = mysqli_query($link, $query_1);
		header("location: problem.php?pID=$pID");
	
}
}

?>
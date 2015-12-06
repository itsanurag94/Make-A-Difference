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
	$query_1 = "UPDATE Problem_status set status='solved', date_solved=now() where pID='$pID'";
	$result_1 = mysqli_query($link, $query_1);
		header("location: problem.php?pID=$pID");
	
}

$query_2 = "SELECT * FROM Problem_solved where pID='$pID'";
$result_2 = mysqli_query($link, $query_2);
$num_rows = mysqli_num_rows($result_2);
echo $num_rows;

if($problem_status == 'solved')
{
	if($num_rows == 0)
	{
	$query_1 = "INSERT INTO Problem_solved(pID, verified_by_citizen, date_verified_by_citizen) values('$pID', '1', now())";
	$result_1 = mysqli_query($link, $query_1);
		header("location: problem.php?pID=$pID");
	}

	else
	{
		$query_1 = "UPDATE Problem_solved set verified_by_citizen='1', date_verified_by_citizen=now() where pID='$pID'";
		$result_1 = mysqli_query($link, $query_1);
		header("location: problem.php?pID=$pID");
	}
	
}
}

?>
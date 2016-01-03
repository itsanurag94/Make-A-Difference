<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    $pID = mysqli_escape_string($link, $_GET['pID']);
    $email = $_SESSION['SESS_EMAIL'];
    $cID = $_SESSION['SESS_MEMBER_ID'];
 
    $query = "SELECT * FROM Problem WHERE pID='$pID'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

	if($num_rows>0)
	{
	    $problem = mysqli_fetch_assoc($result);
		$votes = $problem['votes'];
		$votes = $votes - 1;

		$query = "UPDATE Problem SET votes='$votes' where pID='".$pID."'";
		$result = mysqli_query($link, $query);
		if($result){}

		$query = "DELETE FROM Citizen_voted_problem where cID='$cID' and pID='$pID'";
		$result = mysqli_query($link, $query);
		if($result)
		{
			header("location: problem.php?pID=".$pID."");
		}
	}
}

?>
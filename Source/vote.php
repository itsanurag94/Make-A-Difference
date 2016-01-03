<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    // Verify data
    $pID = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
    
    $email = $_SESSION['SESS_EMAIL'];
    $cID = $_SESSION['SESS_MEMBER_ID'];

    $query = "INSERT INTO Citizen_voted_problem VALUES('$cID', '$pID')";
    $result = mysqli_query($link, $query);

    $query = "SELECT votes FROM Problem WHERE pID='$pID'";
    $result = mysqli_query($link, $query);
		
    $problem = mysqli_fetch_assoc($result);
	$votes = $problem['votes'];
	$votes = $votes + 1;


	$query1 = "SELECT email FROM Citizen where pin_code = '".$problem['pin_code']."' ";
		$result1 = mysqli_query($link, $query1);
		$number_users = mysqli_num_rows($result1);

		if($votes > $number_users/2)
		{

			//send a notification to Govt.

			$query2 = "INSERT INTO Problem_notified VALUES('$pID',now()) ";
			$result2 = mysqli_query($link, $query2);
			if($result2){
			}

			$query2 = "SELECT date_notified FROM Problem_notified where pID='$pID'";
		$result2 = mysqli_query($link, $query2);
			if($result2)
			{
				$problem_notified = mysqli_fetch_assoc($result2);
				$date_notified = $problem_notified['date_notified'];
			}

			$query2 = "UPDATE Problem_status SET status = 'notified', date_notified = '$date_notified' where pID = '$pID'";
			$result2 = mysqli_query($link, $query2);
			if($result2){}
		}

	$query = "UPDATE Problem SET votes='$votes' where pID='".$pID."'";
	$result = mysqli_query($link, $query);
	if($result)
	{
		header("location: problem.php?pID=".$pID."");
	}
}

?>
<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    // Verify data
    $pID = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
    
    $vote_downvote=$_SESSION['SESS_VOTE_DOWNVOTE'];
    $email = $_SESSION['SESS_EMAIL'];
    $cID = $_SESSION['SESS_MEMBER_ID'];
 
    echo $vote_downvote;

    if($vote_downvote==0)
    {
	    $query = "INSERT INTO Citizen_voted_problem VALUES('$cID', '$pID')";
	    $result = mysqli_query($link, $query);

	    $query = "SELECT votes FROM Problem WHERE pID='$pID'";
	    $result = mysqli_query($link, $query);
			
		    $problem = mysqli_fetch_assoc($result);
			$votes = $problem['votes'];
			$votes = $votes + 1;


			$query_1 = "SELECT email FROM Citizen where pin_code = '".$problem['pin_code']."' ";
	   		$result_1 = mysqli_query($link, $query_1);
	   		$number_users = mysqli_num_rows($result_1);

	   		if($votes > $number_users/2)
	   		{

	   			//send a notification to Govt.

	   			$query_2 = "INSERT INTO Problem_notified VALUES('$pID',now()) ";
	   			$result_2 = mysqli_query($link, $query_2);
	   			if($result_2){
	   			}

	   			$query_2 = "SELECT date_notified FROM Problem_notified where pID='$pID'";
				$result_2 = mysqli_query($link, $query_2);
	   			if($result_2)
	   			{
	   				$problem_notified = mysqli_fetch_assoc($result_2);
	   				$date_notified = $problem_notified['date_notified'];
	   			}

	   			echo $date_notified;

	   			$query_2 = "UPDATE Problem_status SET status = 'notified', date_notified = '$date_notified' where pID = '$pID'";
	   			$result_2 = mysqli_query($link, $query_2);
	   			if($result_2){}
	   		}

			$query = "UPDATE Problem SET votes='$votes' where pID='".$pID."'";
			$result = mysqli_query($link, $query);
			if($result)
			{
				header("location: problem.php?pID=".$pID."");
			}
	}

	if($vote_downvote==1)
    {
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

}

?>
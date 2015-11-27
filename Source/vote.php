<?php

session_start();
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID'])){
    // Verify data

    $pid = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
    $vote_downvote=$_SESSION['SESS_VOTE_DOWNVOTE'];
    $email = $_SESSION['SESS_EMAIL'];
 //    echo $email;
 //   echo $vote_downvote;
    
   // if(!$result)
   // {
   // 	echo "Query to insert into user_voted failed";
   // }

    if($vote_downvote==0)
    {
    $query = "INSERT INTO user_voted value('$email', '$pid')";
    $result = mysqli_query($link, $query);
    $query = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

	if($num_rows>0)
	{
	//	echo "Here";
	    $problem = mysqli_fetch_assoc($result);
		$votes = $problem['votes'];
		$votes = $votes + 1;

		$query = "UPDATE Problems SET votes='$votes' where pID='".$pid."'";

		$result = mysqli_query($link, $query);
		if($result)
		{
			header("location: problem.php?pID=".$pid."");
		}
	}
	}

	if($vote_downvote==1)
    {
    $query = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);
    echo $num_rows;
	if($num_rows>0)
	{
	    $problem = mysqli_fetch_assoc($result);
		$votes = $problem['votes'];
		$votes = $votes - 1;
		echo $votes;

		$query = "UPDATE Problems SET votes='$votes' where pID='".$pid."'";
		$result = mysqli_query($link, $query);

		$query = "DELETE FROM user_voted where pID='".$pid."' and email='$email'";
		$result = mysqli_query($link, $query);
		if($result)
		{
			header("location: problem.php?pID=".$pid."");
		}
	}
	}

}

?>
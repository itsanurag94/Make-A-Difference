<?php

session_start();
require_once('auth.php');
require_once('connection.php');

if(isset($_GET['comment_id']) && !empty($_GET['comment_id'])){
    // Verify data

    $cid = mysqli_escape_string($link, $_GET['comment_id']); // Set pid variable
    $email = $_SESSION['SESS_EMAIL'];

    $query = "SELECT * FROM users WHERE email='".$email."'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    $uid = $user['uid'];
  
    $query_1 = " SELECT * from Citizen_voted_comment where comment_id = '".$cid."' and uid = '".$uid."'";
    $result_1 = mysqli_query($link, $query_1);
    $num_rows_2 = mysqli_num_rows($result_1);

    if($num_rows_2 == '0')
    {
    	$query = "SELECT * FROM Comments WHERE comment_id='".$cid."'";
    	$result = mysqli_query($link, $query);
  
		$problem = mysqli_fetch_assoc($result);
		$likes = $problem['likes'];
		$problem_id = $problem['pID'];
		$likes = $likes + 1;

	//	echo $problem_id;
	//	echo $uid;

		$query_1 = " INSERT INTO Citizen_voted_comment VALUES ('$cid','$problem_id','$uid') ";
		$result_1 = mysqli_query($link, $query_1);

		$query_2 = "UPDATE Comments SET likes='".$likes."' where comment_id='".$cid."'";
		$result_2 = mysqli_query($link, $query_2);

		if($result_1)
		{
		//	echo "Hello";
			header("location: problem.php?pID=".$problem_id."");
		}
	}

	else
    {
    //	echo "Hello 2";
    	$query_3 = "SELECT * FROM Comments WHERE comment_id = '".$cid."'";
    	$result_3 = mysqli_query($link, $query_3);
   
	    $comment_likes = mysqli_fetch_assoc($result_3);
		$likes = $comment_likes['likes'];
		$problem_id = $comment_likes['pID'];
		$likes = $likes - 1;

		$query_4 = "UPDATE Comments SET likes='$likes' where comment_id = '".$cid."'";
		$result_4 = mysqli_query($link, $query_4);

		$query_5 = "DELETE FROM Citizen_voted_comment where comment_id = '".$cid."' and uid='".$uid."'";
		$result_5 = mysqli_query($link, $query_5);
		
		if($result_5)
		{
			header("location: problem.php?pID=".$problem_id."");
		}
	}

}

?>
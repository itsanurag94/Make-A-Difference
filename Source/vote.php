<?php
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID'])){
    // Verify data

    $pid = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
    $query = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

	if($num_rows>0) {
	    $problem = mysqli_fetch_assoc($result);
		$votes = $problem['votes'];
		$votes = $votes + 1;

		$query = "UPDATE Problems SET votes='$votes' where pID='".$pid."'";

		$result = mysqli_query($link, $query);
		if($result){
			header("location: problem.php?pID=".$pid."");
		}
	}

}



?>
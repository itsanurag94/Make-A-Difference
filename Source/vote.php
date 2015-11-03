<?php
require_once('connection_1.php');

if(isset($_GET['pID']) && !empty($_GET['pID'])){
    // Verify data

    $pid = $_GET['pID']; // Set pID variable
    $search = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysql_query($search);
    $matches = mysql_num_rows($result);
if($matches>0) {
    $problem = mysql_fetch_assoc($result);
	$votes = $problem['votes'];
	$votes = $votes + 1;
	$update_votes = "UPDATE Problems SET votes='$votes' where pID='".$pid."'";

	$result = mysql_query($update_votes);
	//header("location: problem.php?pID=".$pid."");
	}

}



?>
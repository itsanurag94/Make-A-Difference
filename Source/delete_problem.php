<?php

session_start();
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
	$pID=$_GET['pID'];
	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);

	$query = "DELETE from Problem where pID='$pID'";
	$result = mysqli_query($link, $query);
}

?>
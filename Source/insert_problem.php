<?php

include_once 'common.php';

$link = mysqli_connect("localhost", "root", "Aravind", "mad");
 
// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$title = mysqli_real_escape_string($link, $_POST['title']);
$to_whom = mysqli_real_escape_string($link, $_POST['to_whom']);
$description = mysqli_real_escape_string($link, $_POST['description']); 
$location = mysqli_real_escape_string($link, $_POST['location']);

// attempt insert query execution

$sql = "INSERT INTO Problems VALUES ('','$title', '$to_whom', '$description', '$location')";
if(mysqli_query($link, $sql))
{
//	echo "$location";
  header("location: home.php");
}  
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
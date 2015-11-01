<?php
/*
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "Aravind";
$mysql_database = "mad";
$prefix = "";
*/
$link = mysqli_connect("localhost", "root", "Aravind", "mad");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
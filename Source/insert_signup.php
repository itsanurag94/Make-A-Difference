<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "Aravind", "mad");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$f_name = mysqli_real_escape_string($link, $_POST['f_name']);
$l_name = mysqli_real_escape_string($link, $_POST['l_name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$pswd = mysqli_real_escape_string($link, $_POST['pswd']);
$confirm_pswd = mysqli_real_escape_string($link, $_POST['confirm_pswd']);
$mob = mysqli_real_escape_string($link, $_POST['mob']);
$dob = mysqli_real_escape_string($link, $_POST['dob']);
$address_line1 = mysqli_real_escape_string($link, $_POST['address_line1']);
$address_line2 = mysqli_real_escape_string($link, $_POST['address_line2']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$district = mysqli_real_escape_string($link, $_POST['district']);
$state = mysqli_real_escape_string($link, $_POST['state']);
$pin_code = mysqli_real_escape_string($link, $_POST['pin_code']);
 

if($pswd==$confirm_pswd){
	$pswd = md5($pswd);
}
else{
	echo "Passwords do not match";
}

// attempt insert query execution
$sql = "INSERT INTO users VALUES ('','$f_name', '$l_name', '$email', '$mob', '$dob', '$address_line1', '$address_line2', '$city', '$district', '$state', '$pin_code')";


if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "INSERT INTO user_reg VALUES('$email', '$pswd')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
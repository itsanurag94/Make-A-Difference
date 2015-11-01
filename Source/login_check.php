<?php

$link = mysqli_connect("localhost", "root", "Aravind", "mad");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($link, $_POST['email']);
$pswd = mysqli_real_escape_string($link, $_POST['pswd']);

$pswd = md5($pswd);


$sql = "SELECT * FROM user_reg";
$result = $link->query($sql)
if($result->num_rows>0){
   while ($row= $result->fetch_assoc())

   echo $row["email"];
   echo $row["password"];
}
/*
if ($result->password == $pswd) {
    // correct login
   echo "Logged In";
    }
} else {
    echo "Incorrect Log In";
}
*/
mysqli_close($link);

?>
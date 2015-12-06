<?php
session_start();
require_once('auth.php');
require_once('connection.php');

$email = $_SESSION['SESS_EMAIL'];

$query= "SELECT * FROM Citizen WHERE email='$email'";
$result = mysqli_query($link, $query);
$citizen = mysqli_fetch_assoc($result);

echo "First_Name   :  ";
echo $citizen['f_name'];
echo "<br><br><br>";
echo "Last Name   :  ";
echo $citizen['l_name'];
echo "<br><br><br>";
echo "Email  :  ";
echo $citizen['email'];
echo "<br><br><br>";
echo "Date of birth   :  ";
echo $citizen['dob'];
echo "<br><br><br>";
echo "Address  :  ";
echo $citizen['Address_line1'];
echo $citizen['Address_line2'];
echo "<br><br><br>";
echo "District   :  ";
echo $citizen['district'];
echo "<br><br><br>";
echo "State   :  ";
echo $citizen['district'];
echo " - ";
echo $citizen['pin_code'];

?>
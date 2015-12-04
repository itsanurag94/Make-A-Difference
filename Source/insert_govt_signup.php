<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once('connection.php');
require('phpmailer/class.phpmailer.php');

if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pswd']) && !empty($_POST['pswd']) AND isset($_POST['confirm_pswd']) && !empty($_POST['confirm_pswd']) AND isset($_POST['district']) && !empty($_POST['district']))
{
 
// Escape user inputs for security
$dep_name = mysqli_real_escape_string($link, $_POST['d_name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$pswd = mysqli_real_escape_string($link, $_POST['pswd']);
$confirm_pswd = mysqli_real_escape_string($link, $_POST['confirm_pswd']);
$contact_num = mysqli_real_escape_string($link, $_POST['contact_no']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$district = mysqli_real_escape_string($link, $_POST['district']);
$state = mysqli_real_escape_string($link, $_POST['state']);
$pin_code = mysqli_real_escape_string($link, $_POST['pin_code']);
}

else 
{
	echo "Hello";
//	header("location: govt_signup.php");
} 
//email validation

if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    // Return Error - Invalid Email
    $msg = 'The email you have entered is invalid, please try again.';
    echo $msg;
//    header("location: govt_signup.php");
}


if($pswd==$confirm_pswd)
{
	$hash = md5($pswd);
}
else
{
//	echo "Passwords do not match";
	header("location: govt_signup.php");
	exit;
}

$query="SELECT * from Govt_reg where email='$email'";
$result=mysqli_query($link,$query);
$num_rows=mysqli_num_rows($result);

if($num_rows>0)
{
	echo "Email already registered with us. Try again";
	//header("location: govt_signup.php");
	echo "<br>Click here to sign up again: <a href='govt_signup.php'></a>";
	exit;
}

$query = "INSERT INTO Govt_reg (gID, email, password, active) VALUES('','$email', '$hash', '0')";

if(mysqli_query($link, $query))
{
//    echo "Records added successfully.";
} 
else
{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
}

$query = "SELECT gID FROM Govt_reg where email = '$email'";
$result = mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);

if($result)
{
	if ($num_rows > 0)
	{
		$govt = mysqli_fetch_assoc($result);
		$gID = $govt['gID'];
	}
}


$query = "INSERT INTO Govt VALUES ('$gID','$dep_name', '$email', '$contact_num', '$city', '$district', '$state', '$pin_code')";

if(mysqli_query($link, $query)){

//send verification mail
	//random hash to be included in verification url
	$hash_random = md5(rand(0,1000));

	$to      = $email; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$body = '
	 
	Thanks for signing up!
	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
	 
	------------------------
	Username: '.$email.'
	Password: '.$pswd.'
	------------------------
	 
	Please click this link to activate your account:
	localhost/mad/verify.php?email='.$email.'&hash='.$hash_random.'
	 
	'; // Our message above including the link
	                     
//	$headers = 'From:noreply@makeadifference.com' . "\r\n"; // Set from headers
	
	define('GUSER', 'makeadifferencetransformers@gmail.com'); // GMail username
	define('GPWD', 'makeadifference'); // GMail password
	
	
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$Mail->From = 'makeadifferencetransformers@gmail.com';
	$Mail->FromName = 'MakeADifference';
//	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if($mail->Send()) {
		echo "You have successfully registered! Please click on the verification link sent to your registered email id."; 
	} else {
		echo "Mail error: ".$mail->ErrorInfo;
	}

	exit();
} else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
?>

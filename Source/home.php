
<?php
	session_start();

	require_once('connection.php');
	include_once 'common.php';
	require_once('auth.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

<body style="text-align:center;">

<a href="logout.php" align="right" class="style1">Logout </a><br>
<a href="change_password.php" align="right" class="style1">Change Password</a>

<div id="languages">
	<a href="index.php?lang=en"><img src="images/en.png" /></a>
	<a href="index.php?lang=de"><img src="images/de.jpg" /></a>
	<a href="index.php?lang=es"><img src="images/es.png" /></a>
</div>

<b>Create Event</b><br><br>
	<form action="insert_problem.php" method="post" ENCTYPE="multipart/form-data">
		<input type="text" value="<?php echo $lang['HEADER_TITLE']; ?>" name="title" id="title"><br><br>
		<input type="text" value="<?php echo $lang['MENU_ABOUT_US']; ?>" name = "to_whom" id="to_whom"><br><br>
		<input type="text" value="<?php echo $lang['SLOGAN']; ?>" name = "description" id="description"><br><br>
		<input type="text" value="<?php echo $lang['MENU_HOME']; ?>" name = "location" id="location"><br><br>
		<P>Please browse and double-click the file to upload. Your filename must have one of the following extensions: .doc, .pdf, .ppt, .pps, .xls, .csv, .rtf, .txt, .htm, .html, .jpg, .gif, .png</p>
 	    <P>File name: <br><INPUT class="inputform" TYPE="file" name="userfile" style="width:250px;"></p>
<!--        <P><INPUT class="inputform" TYPE="submit" VALUE="Upload File"></p>    -->
		<INPUT class="inputform" TYPE=hidden name="MAX_FILE_SIZE" value="513024">
		<INPUT class="inputform" TYPE=hidden name="users_ID" value="<?print($users_ID);?>">
		<input type="submit" value="<?php echo $lang['MENU_OUR_PRODUCTS']; ?>"><br><br>
	</form>



<b>View problems nearby</b>

<?php

$email = $_SESSION['SESS_EMAIL'];

$query="SELECT district FROM users where email = '".$email."'";
$result = mysqli_query($link, $query);
$citizen = mysqli_fetch_assoc($result);
$location = $citizen["district"];

$query="SELECT * FROM Problems where location = '$location'";
$result=mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);

if ( $num_rows > 0) 
	{
		echo "<br>";

    // output data of each row
   		 while($problem = mysqli_fetch_assoc($result)) 
   		 {
        	echo "<br>Title: <a href='problem.php?pID=".$problem["pID"]."'>".$problem["title"]." </a>  To_whom: " . $problem["to_whom"]. "  Description" . $problem["description"]. "  Location: ".$problem["location"]."<br>";
   		 }
   	}



?>

</body>
</html>

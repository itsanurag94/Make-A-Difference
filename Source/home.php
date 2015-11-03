
<?php
	session_start();
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

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "Aravind";
$mysql_database = "mad";
$prefix = "";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

$email = $_SESSION['SESS_EMAIL'];

$qry="SELECT district FROM users where email = '".$email."'";
$result = mysql_query($qry);


$row = mysql_fetch_assoc($result);
$location = $row["district"];

$qry="SELECT * FROM Problems where location = '$location'";
$result=mysql_query($qry);


if (mysql_num_rows($result) > 0) 
	{
		echo "<br>";

    // output data of each row
   		 while($row = mysql_fetch_assoc($result)) 
   		 {
        	echo "<br>Title: <a href='problem.php?pID=".$row["pID"]."'>".$row["title"]." </a>  To_whom: " . $row["to_whom"]. "  Description" . $row["description"]. "  Location: ".$row["location"]."<br>";
   		 }
   	}



?>

</body>
</html>

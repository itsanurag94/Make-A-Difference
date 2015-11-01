
<?php
	include_once 'common.php';
//	require_once('auth.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

<body style="text-align:center;">

<a href="logout.php" align="right" class="style1">Logout </p>

<div id="languages">
	<a href="index.php?lang=en"><img src="images/en.png" /></a>
	<a href="index.php?lang=de"><img src="images/de.jpg" /></a>
	<a href="index.php?lang=es"><img src="images/es.png" /></a>
</div>

<b>Create Event</b><br><br>
	<form action="insert_problem.php" method="post">
		<input type="text" value="<?php echo $lang['HEADER_TITLE']; ?>" name="title" id="title"><br><br>
		<input type="text" value="<?php echo $lang['MENU_ABOUT_US']; ?>" name = "to_whom" id="to_whom"><br><br>
		<input type="text" value="<?php echo $lang['SLOGAN']; ?>" name = "description" id="description"><br><br>
		<input type="text" value="<?php echo $lang['MENU_HOME']; ?>" name = "location" id="location"><br><br>
		<input type="submit" value="<?php echo $lang['MENU_OUR_PRODUCTS']; ?>"><br><br>
	</form>



<b>View problems nearby</b>

<?php
require_once('connection.php');

$email = $_SESSION['SESS_EMAIL'];

$qry="SELECT district FROM users where email = '$email'";
$result=mysql_query($qry);

$row=mysql_fetch_assoc($result);
$location = $row["district"];


$qry="SELECT title, to_whom, description, location FROM Problems where location = '$location'";
$result=mysql_query($qry);

if (mysql_num_rows($result) > 0) 
	{
		echo "<br>";

    // output data of each row
   		 while($row = mysql_fetch_assoc($result)) 
   		 {

        	echo "<br>Title: " . $row["title"]. "  To_whom: " . $row["to_whom"]. "  Description" . $row["description"]. "  Location: ".$row["location"]."<br>";
   		 }
   	}



?>

</body>
</html>

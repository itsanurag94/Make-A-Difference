
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
		<link href="homepage.css" rel="stylesheet" type="text/css" media="all" />
	</head>

<body style="text-align:center; background:white; ">
		
		<div class="account_manage">
		<div class="change_password">
		<form action="change_password.php">
			<button class="Change_password">Change password</button>
		</form>
		</div>
		&nbsp;
		&nbsp;
		&nbsp;
		<div class="logout">
		<form action="logout.php">
			<button class="Logout">Logout</button>
		</form>
		</div>
		</div>
<!--
<div id="languages">
	<a href="index.php?lang=en"><img src="images/en.png" /></a>
	<a href="index.php?lang=de"><img src="images/de.jpg" /></a>
	<a href="index.php?lang=es"><img src="images/es.png" /></a>
</div>
-->
<div class="Main" >
	<br>
	<h1>Post Problems</h1>
	<br><br>
	<form action="insert_problem.php" method="post" ENCTYPE="multipart/form-data">
		<div class="input-sign details">
		<input type="text" placeholder="Title" name="title" id="title"><br><br>
		</div>
		<div class="input-sign details">
		<select id='Departments' value='Departments' name='Departments'>
			<option value="">Select</option>
			<option value='Water' selected="Water"> Water </option>
			<option value='Power' name="Power">Power </option>
			<option value='Roads' name="PWD"> PWD </option>
		</select>
		</div>   
		<div class="input-sign details">
		<input type="text" placeholder="Description" name = "description" id="description"><br><br>
		</div>
		<P></p>
 	    <P>File name: <br><INPUT class="inputform" TYPE="file" name="userfile" style="width:250px;"></p>
<!--        <P><INPUT class="inputform" TYPE="submit" VALUE="Upload File"></p>    -->
		<div class="input-sign details">
		<INPUT class="inputform" TYPE=hidden name="MAX_FILE_SIZE" value="513024">
		</div>
		<div class="input-sign details">
		<INPUT class="inputform" TYPE=hidden name="users_ID" value="<?print($users_ID);?>">
		</div>
		<div class="submit">
		<input class="bluebutton submitbotton" type="submit" value="<?php echo $lang['MENU_OUR_PRODUCTS']; ?>"><br><br>
		</div>
	</form>
</div>

<div class="submit">
<form action="view_problem.php">
	<input class="bluebutton submitbotton" type="submit" value="View Problems in your location"><br><br>
</form>
</div>

</body>
</html>

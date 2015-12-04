<!DOCTYPE HTML>
<html>
<head>
<title>Login form and sign up</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'> -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">

.facebook-before 
{
background-color: #0064ab;
border-radius: 3px 0px 0px 3px;
-moz-border-radius: 3px 0px 0px 3px;
-webkit-border-radius: 3px 0px 0px 3px;
color: #f4f4f4;
display: block;
float: left;
height: 50px;
line-height: 50px;
text-align: center;
width: 50px;
margin-left: 110px;
}
.facebook 
{
background-color: #0079ce;
border: none;
border-radius: 0px 3px 3px 0px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
color: #f4f4f4;
cursor: pointer;
height: 50px;
text-transform: uppercase;
width: 250px;
}
.twitter-before 
{
background-color: #189bcb;
border-radius: 3px 0px 0px 3px;
-moz-border-radius: 3px 0px 0px 3px;
-webkit-border-radius: 3px 0px 0px 3px;
color: #f4f4f4;
display: block;
float: left;
height: 50px;
line-height: 50px;
text-align: center;
width: 50px;
margin-left: 110px;
}
.twitter 
{
background-color: #1bb2e9;
border: none;
border-radius: 0px 3px 3px 0px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
color: #f4f4f4;
cursor: pointer;
height: 50px;
text-transform: uppercase;
width: 250px;
}
.citizen_signup 
{
background-color: grey;
border: none;
border-radius: 0px 3px 3px 0px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
color: black;
cursor: pointer;
height: 50px;
text-transform: uppercase;
width: 250px;
margin-left: 130px;
margin-top: 160px;
}
.govt_signup 
{
background-color: grey;
border: none;
border-radius: 0px 3px 3px 0px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
color: black;
cursor: pointer;
height: 50px;
text-transform: uppercase;
width: 250px;
margin-left: 530px;
margin-top: 10px;
}
</style>
</head>
<body>
	<div style="margin-top:50px;">
	<!--start member-login -->
	<h1 style="text-align:center; font-size:40px; color:#C04551;"> Welcome to MaD! Together, we will make difference. </h1>
		<div class="member-login" style="float:left; margin-left:50px;">
				<form class="login"  action="govt_login_execute.php" method="post" >
					<?php
					if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
					{
					echo '<ul class="err">';
					foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					echo '<li>',$msg,'</li>'; 
					}
					echo '</ul>';
					unset($_SESSION['ERRMSG_ARR']);
					}
					?>
					<div class="formtitle">Government Login</div>
					<div class="input">
						<input type="text" placeholder="Email" name="govt_email" id="govt_email" /> 
					</div>
					<div class="input">
						<input type="password"  placeholder="Password" name="govt_pswd" id="govt_pswd" />
					</div>
					<div class="buttons">
						<a href="#">Forgot password?</a>
						<input class="bluebutton" type="submit" value="Login" />
						<div class="clear"> </div>
					</div>
				</form>
		</div>
		
		<div class="member-login" style="float:right;margin-right:50px;">
				<form class="login"  action="login_execute.php" method="post" >
					<?php
					if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
					{
					echo '<ul class="err">';
					foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					echo '<li>',$msg,'</li>'; 
					}
					echo '</ul>';
					unset($_SESSION['ERRMSG_ARR']);
					}
					?>
					<div class="formtitle">Citizen Login</div>
					<div class="input">
						<input type="text" placeholder="Email"  name="email" id="email"/> 
					</div>
					<div class="input">
						<input type="password"  placeholder="Password" name="pswd" id="pswd"/>
					</div>
					<div class="buttons">
						<a href="#">Forgot password?</a>
						<input class="bluebutton" type="submit" value="Login" />
						<div class="clear"> </div>
					</div>
				</form>
		</div>

		</div> <!-- end login -->
		<div style="margin-top:120px;">
		<p>
			<a class="facebook-before"></a>
			<button class="facebook">Login Using Facbook</button>
		</p>
		<p>
			<a class="twitter-before"></a>
			<button class="twitter">Login Using Twitter</button>
		</p>
		</div>
		<div>
		<form action="new_signup.php">
		<button class="citizen_signup">Citizen Signup</button>
		</form>
		<form action="new_govt_signup.php">
		<button class="govt_signup">Government Signup</button>
		</form>
		</div>
		</div>
	<!--		<p class="copy_right" style="float:bottom;">&#169; 2014 Template by<a href="iiits.ac.in" target="_blank">&nbsp;MaD Team</a> </p> -->
</body>
</html>
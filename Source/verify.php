<?php
    //Start session
    session_start();    
    //Unset the variables stored in session
    unset($_SESSION['SESS_MEMBER_ID']);
    unset($_SESSION['SESS_EMAIL']);
    unset($_SESSION['SESS_PASSWORD']);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Make a contribution, see the difference</title>
<style type="text/css">
body {
    background-color: #585858;
    background-image:url("http://creativevantage.org/wp-content/uploads/2013/09/Make-a-Difference.jpg");
    background-size: 63% 100%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    color: orange;
    font-family: 'Open Sans', Arial, Helvetica, sans-serif;
    font-size: 16px;
    line-height: 1.5em;
}
a { text-decoration: none; }
h1 { font-size: 1em; }
h1, p {
margin-bottom: 10px;
}
strong {
font-weight: bold;
}
.uppercase { text-transform: uppercase; }

/* ---------- LOGIN ---------- */
#login {
margin: 50px auto;
width: 300px;
float:right;
margin-right: 135px;
text-align: center;
}
form fieldset input[type="text"], input[type="password"] {
background-color: #e5e5e5;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 14px;
height: 50px;
outline: none;
padding: 0px 10px;
width: 280px;
-webkit-appearance:none;
}
form fieldset input[type="submit"] {
background-color: #008dde;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #f4f4f4;
cursor: pointer;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
height: 50px;
text-transform: uppercase;
width: 300px;
-webkit-appearance:none;
}
form fieldset a {
color: #5a5656;
font-size: 10px;
}
form fieldset a:hover { text-decoration: underline; }
.btn-round {
background-color: orange;
border-radius: 50%;
-moz-border-radius: 50%;
-webkit-border-radius: 50%;
color: black;
display: block;
font-size: 12px;
height: 50px;
line-height: 50px;
margin: 30px 125px;
text-align: center;
text-transform: uppercase;
width: 50px;
}
.facebook-before {
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
}
.facebook {
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
.twitter-before {
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
}
.twitter {
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
.Footer{
    position: margin-bottom;
}
</style>
</head>
<body>
<div class="Background">
</div>

<div id="login">

<h1 style="font-color:orange;"><strong>Welcome to MaD.</strong> Please login.</h1>

<?php

mysql_connect("localhost", "root", "Aravind") or die(mysql_error()); // Connect to database server(localhost) with username and password.
mysql_select_db("mad") or die(mysql_error()); // Select registration database.


//require_once('connection.php');

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysql_escape_string($_GET['email']); // Set email variable
    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
                 

    $search = mysql_query("SELECT email, password, active FROM user_reg WHERE email='".$email."' AND active='0'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);
    
    if($match > 0){
        // We have a match, activate the account
        mysql_query("UPDATE user_reg SET active='1' WHERE email='".$email."' AND active='0'") or die(mysql_error());
        echo '<div >Your account has been activated, you can now login</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div >The url is either invalid or you already have activated your account.</div>';
    }
                 
}else{
    // Invalid approach
    echo '<div >Invalid approach, please use the link that has been send to your email.</div>';
}

?>


</div> <!-- end login -->
</body>
</html>
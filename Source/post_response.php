<!DOCTYPE html>
<html>
<head>
	<title>Problem</title>
    <meta charset="utf-8">
    <link href="homepage.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>

<div class="account_manage" style="align:center; margin-left:490px;">
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
<br>
<br>

<?php

require_once('connection.php');
session_start();

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    $pid = mysqli_escape_string($link, $_GET['pID']);
    $pID = $_GET['pID'];
    //echo $pid;
    $response = mysqli_real_escape_string($link, $_POST['Response']);
    echo $response;
    $query = "INSERT INTO Problem_responded (pID, response, likes) VALUES ('$pID','$response','0')";
    if(mysqli_query($link, $query))
    {
         //echo "We have receive your valuable suggestions.";
         //echo "<br>";
         $_SESSION['Responded']='disabled';
         header("location: problem.php?pID=$pID");
    }
    else
    {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

?>
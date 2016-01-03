<?php
session_start();
require_once('auth_govt.php');
require_once('connection.php');

if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    $pID = mysqli_escape_string($link, $_GET['pID']);
    $response = mysqli_real_escape_string($link, $_POST['response']);

    $query = "INSERT INTO Problem_responded VALUES ('$pID','$response', now(), '0')";
    if(mysqli_query($link, $query))
    {   
        header('Location: ' . $_SERVER["HTTP_REFERER"] );
        exit;
    }
    else
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}
?>
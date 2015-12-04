<?php
require_once('auth.php');
session_start();
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_EMAIL']);
unset($_SESSION['SESS_PASSWORD']);
session_destroy();
header("Location: index.php");
exit;
?>

<?php
session_start();
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_EMAIL']);
unset($_SESSION['SESS_PASSWORD']);
session_destroy();
header("Location: new_index.php");
exit;
?>

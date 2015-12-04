<?php

require_once('connection.php');
session_start();
$email = $_SESSION['SESS_EMAIL'];
$title = mysqli_real_escape_string($link, $_POST['title']);
$to_whom = mysqli_real_escape_string($link, $_POST['to_whom']);
$description = mysqli_real_escape_string($link, $_POST['description']); 
//$location = mysqli_real_escape_string($link, $_POST['location']);

$query = "Select district, pin_code from users where email='".$email."'";
$result = mysqli_query($link, $query);
$district = mysqli_fetch_assoc($result); 
$location = $district['district'];
$pin_code = $district['pin_code'];
// attempt insert query execution

$okext = array(".doc", ".pdf", ".ppt", ".pps", ".xls", ".csv", ".rtf", ".txt", ".htm", ".html", ".jpg", ".gif", ".png", ".svg");

//echo "Hello";
//check for oversize files or empty uploads 
$thesize = $_FILES['userfile']['size']; 

if (($thesize > 513024))
{ 
print(' 
<html> 
<head> 
<TITLE>File Upload 2</TITLE> 
</head> 
<body style="background:#FFFFFF"> 
<p>&nbsp;</p> 
<p align=center>Error... No file, or file too large.<br> 
If your file is too large, please post it somewhere on your company\'s website, then use a URL link to it instead.</p> 
<p>&nbsp;</p> 
<p align=center><a href="javascript:window.close();">Close Window</a></p> 
</body> 
</html> 
'); 
exit; 
} 

//read the file from the temp location 
$filename=$_FILES['userfile']['tmp_name']; 
$fd = fopen ($filename, "r"); 
$contents = fread ($fd, filesize($filename)); 
fclose($fd); 

//set the path for your saving directory 
$respath = "/var/www/html/Source/problem_images/";    //include trailing slash 

//check for valid file extension 
$resext = ""; 
$extarray = explode(".", $_FILES['userfile']['name']); 

    if(count($extarray)>1) 
    { 
    $extpos = count($extarray)-1; 
    $resext = ".".$extarray[$extpos]; 
    } 
//$files[] = resize($w, $h);
if (!(in_array($resext, $okext)) && $thesize > 0 ){ 
print(' 
<html> 
<head> 
<LINK href="./inc/dladmin.css" type=text/css rel=stylesheet> 
<TITLE>File Upload 2</TITLE> 

</head> 
<body style="background:#FFFFFF"> 
<p>&nbsp;</p> 
<p align=center>Error... Invalid filename extension.<br> 
Your filename must have one of the following extensions: .doc, .pdf, .ppt, .pps, .xls, .csv, .rtf, .txt, .htm, .html, .jpg, .gif, .png</p> 
<p>&nbsp;</p> 
<p align=center><a href="javascript:window.close();">Close Window</a></p> 
</body> 
</html> 
'); 
exit; 
} 

$resname = $respath.$_FILES['userfile']['name']; 


$resname1 = $_FILES['userfile']['name'];


$resw = fopen($resname, "w"); 
    fwrite($resw, $contents); 
    fclose($resw);

echo $resname1;


$query = "INSERT INTO Problems VALUES ('','$title', '$to_whom', '$description', '$location','$resname1', '$email','','0',now(),'$pin_code')";
if(mysqli_query($link, $query))
{
  //echo "We have receive your valuable suggestions.";
  //echo "<br>";
  header("location: home.php");
}  
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Problem</title>
</head>
<body>

<?php

require_once('connection_1.php');

if(isset($_GET['pID']) && !empty($_GET['pID'])){
    // Verify data

    $pid = $_GET['pID']; // Set pID variable
    $img_url = "http://127.0.1.1/mad/problem_images/";
   
    $search = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysql_query($search);
    $matches = mysql_num_rows($result);
    $problem = mysql_fetch_assoc($result);


    if($matches>0) {

    	echo $resname1;
    	echo "<br>";
    	$title = $problem['title'];
    	$to_whom = $problem['to_whom'];
    	$description = $problem['description'];
    	$location = $problem['location'];
    	$votes = $problem['votes'];
    	$img_path = $problem['img_path'];

		echo $title;
		echo "<br>";
		echo $to_whom;
		echo "<br>";
		echo $description;
		echo "<br>";
		echo $location;
		echo "<br>";
		echo $votes;
		echo "<br>";
		
		if($img_path !== 'NULL')
  		{
  			echo '<img src="'.$img_url.$problem['img_path'].'" />'; 
		}
		}
    }

?>

<form action="vote.php?pID=<?php echo $_GET['pID']; ?>" method="post">
<button onclick="this.disabled=true;document.getElementById('downvote').disabled=false;" type="submit" class="positive" name="vote" id="vote">Vote</button>
<button onclick="this.disabled=true;document.getElementById('vote').disabled=false;" type="submit" class="negative" name="downvote" id="downvote" disabled>Downvote</button>
</form>

</body>
</html>
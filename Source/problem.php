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
$email = $_SESSION['SESS_EMAIL'];
echo "<div class='Welcome_Message'>";
echo "Welcome ".$email."";
echo "<br>";
echo "<br>";
echo "</div>";
if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    // Verify data

    $pid = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
    $query2 = "SELECT * FROM user_voted WHERE pID='$pid' and email='$email'";
    $result2 = mysqli_query($link,$query2);
    $num_rows_2 = mysqli_num_rows($result2);
    $query = "SELECT * FROM Problems WHERE pID='$pid'";
    $result = mysqli_query($link, $query);
    
    $num_rows = mysqli_num_rows($result);
    $problem = mysqli_fetch_assoc($result);
    
    if($num_rows>0) 
    {
        echo $resname1;
        echo "<br>";
        $title = $problem['title'];
        $description = $problem['description'];
        $to_whom = $problem['To_Whom'];
        $location = $problem['location'];
        $votes = $problem['votes'];
        $img_path = $problem['img_path'];

        echo "<div class='Problem_title'>";
        echo  $title;
        echo "</div>";
        echo "<br>";
        echo "<div class='Problem_towhom'>";
        echo $to_whom;
        echo "</div>";
        echo "<br>";
        echo "<div class='Problem_description'>";
        echo $description;
        echo "</div>";
        echo "<br>";
        echo "<div class='Problem_location'>";
        echo $location;
        echo "</div>";
        echo "<br>";
        echo "<div class='Problem_votes'>";
        echo $votes;
        echo "</div>";
        echo "<br>";
    
 //       if($img_path !== 'NULL')
 //       {
 //           echo '<img src="'.$img_url.$problem['img_path'].'" />'; 
 //       }
    }
}
?>
<!--
<form action="vote.php?pID=<?php echo $_GET['pID']; ?>" method="post">
<input class="inputform" TYPE=hidden name="users_ID" value="<?print($users_ID);?>"> <br>
<button onclick="this.disabled=true;document.getElementById('downvote').disabled=false;" type="submit" class="positive" name="vote" id="vote">Vote</button>
<button onclick="this.disabled=true;document.getElementById('vote').disabled=false;" type="submit" class="negative" name="downvote" id="downvote" disabled>Downvote</button>
</form>-->

<?php

    echo "<h4>Comments</h4>";
    $pid = $_GET['pID'];
    $query1 = "SELECT comment, f_name FROM Comments WHERE pID='$pid'";
    $result1 = mysqli_query($link, $query1);
    $num_rows_1 = mysqli_num_rows($result1);
    if($num_rows_1>0)
    {
        while ($comments=mysqli_fetch_assoc($result1)) 
        {
        echo $comments['f_name'];
        echo "<br>";
        echo $comments['comment'];
        echo "<br>";
        }
    }
    $email = $_SESSION['SESS_EMAIL'];
    $query = "SELECT * from user_voted where pID = '$pid' and email = '$email' ";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows>0)
    {
        $_SESSION['SESS_VOTE_DOWNVOTE']=1;
        $vote_button = "disabled";
        $downvote_button = "enabled";
    } 
    else
    {
        $_SESSION['SESS_VOTE_DOWNVOTE']=0;
        $vote_button = "enabled";
        $downvote_button = "disabled";
    }

?>

<br>

<form action="vote.php?pID=<?php echo $_GET['pID']; ?>" method="post">

<button type="submit" class="positive" name="vote" id="vote" 
<?php echo $vote_button;?>
>Vote</button>

<button type="submit" class="negative" name="downvote" id="downvote" 
<?php echo $downvote_button;?>
>Downvote</button>
<br><br>
</form>

<form action="post_comment.php?pID=<?php echo $_GET['pID']; ?>" method="post">
<input class="test" value="Write a comment" name="comment" id="comment"><br><br>
<input type="submit" value="Post comment" id="post_comment"><br>
</form>

</body>
</html>
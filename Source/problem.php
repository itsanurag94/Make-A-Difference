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

    $query = "SELECT * FROM user_voted WHERE pID='$pid' and email='$email'";
    $result = mysqli_query($link,$query);
    $num_rows = mysqli_num_rows($result);

    $query1 = "SELECT * FROM Problems WHERE pID='$pid'";
    $result1 = mysqli_query($link, $query1);
    $problem = mysqli_fetch_assoc($result1);
    $num_rows_1 = mysqli_num_rows($result1);
  
    $query2 = "SELECT * FROM Problem_responded WHERE pID='$pid'";
    $result2 = mysqli_query($link, $query2);
    $response_date = mysqli_fetch_assoc($result2);

    $query3 = "SELECT * FROM Problem_notified WHERE pID='$pid'";
    $result3 = mysqli_query($link, $query3);
    $notified_date = mysqli_fetch_assoc($result3);
    
    if($num_rows_1>0) 
    {
    //    echo $resname1;
        echo "<br>";
        $title = $problem['title'];
        $description = $problem['description'];
        $to_whom = $problem['To_Whom'];
        $location = $problem['location'];
        $votes = $problem['votes'];
        $img_path = $problem['img_path'];
        $date_time = $problem['date_created'];
        $date_respond_date=$response_date['date_responded'];
        $notification_date=$notified_date['date_notified'];
     //   $date_time = '01-12-2015';
        $img_url=localhost;

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
         echo "<div class='Problem_votes'>";
        if($img_path !== 'NULL')
        {
           echo "<img src='/Source/problem_images/".$problem['img_path']."' height='100px' width='100px' />"; 
        }
        echo "<br>";
        echo "Number of votes      :            ";
        echo $votes;
        echo "<br>";
        echo "<br>";

        echo "Problem Posted:  ";
        echo $date_time;
        echo "<br>";

        echo "Problem Notified:  ";
        echo $notification_date;
        echo "<br>";

        echo "Problem Responded:  ";
        echo $date_respond_date;
        echo "<br>";
    }
}

//echo $_SESSION['SESS_USER_TYPE'];
if($_SESSION['SESS_USER_TYPE']==1)
{
	$query = "SELECT * FROM Problem_responded WHERE pID=".$problem["pID"]."";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows>0)
    {
    	$query1 = "SELECT * FROM Problem_responded WHERE pID=".$problem["pID"]."";
    	$result1 = mysqli_query($link, $query1);
    	$response = mysqli_fetch_assoc($result1);
    	$response = $response['response'];
    	$response_likes = $response['likes'];
        echo "<br> <br>";
        echo "Response from the government       :                 ";

  //      echo "<br>";
    //    echo "<div class='Problem_votes'>";
    	echo $response;
    	echo "<br>";
   // 	echo $response_likes;
    	echo "<br>";
   //     echo "</div>";
    }
    else
    {
			echo 
			"</form>
			<form action='post_response.php?pID=".$problem["pID"]."' method='post' >
			<input class='test' value='Write a Response' name='Response' id='Response'><br><br>
			<input type='submit' value='Post Response' id='post_comment'><br>
			</form>";
	}
}

if($_SESSION['SESS_USER_TYPE']==0)
{
    $query = "SELECT * FROM Problem_responded WHERE pID=".$problem["pID"]."";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows>0)
    {
        $query1 = "SELECT * FROM Problem_responded WHERE pID=".$problem["pID"]."";
        $result1 = mysqli_query($link, $query1);
        $response = mysqli_fetch_assoc($result1);
        $response = $response['response'];
        $response_likes = $response['likes'];
        echo "<br>";
    //    echo "<div class='Problem_votes'>";
        echo $response;
        echo "<br>";
   //   echo $response_likes;
        echo "<br>";
   //     echo "</div>";
    }
    else
    {
        echo "<br>";
        echo "Problem yet not taken up by the government";
    }
}
?>
<?php
    echo "<br>";
    echo "<h4>Comments</h4>";
    $pid = $_GET['pID'];
    $query1 = "SELECT comment_id, comment, f_name, likes FROM Comments WHERE pID='".$pid."'";
    $result1 = mysqli_query($link, $query1);
    $num_rows_1 = mysqli_num_rows($result1);

    if($num_rows_1>0)
    {
        while ($comments=mysqli_fetch_assoc($result1)) 
        {
        echo "<br>";
        echo "<br>";

        echo $comments['f_name'];
        echo "      :           ";
        echo $comments['comment'];
        echo "<br>";
        $cid = $comments['comment_id'];
        $email = $_SESSION['SESS_EMAIL'];
        echo "Votes   :     ";
        echo $comments['likes'];
        echo "<br>";


      ///////////////////////////////////////////////////            Citizen Comment       /////////////////////////////////////////////////////////////////////////

        if($_SESSION['SESS_USER_TYPE']=='0')
        {
        $query = " SELECT * from users where email = '$email' ";
        $result = mysqli_query($link, $query);
        $num_rows = mysqli_num_rows($result);
        $user_id = mysqli_fetch_assoc($result);
        $uid = $user_id['uid'];
        //echo $cid;

        $query_1 = " SELECT * from Citizen_voted_comment where comment_id = '".$cid."' and uid = '".$uid."'";
        $result_1 = mysqli_query($link, $query_1);
        $num_rows_2 = mysqli_num_rows($result_1);
    //    echo $num_rows_2;
        $comment_vote = mysqli_fetch_assoc($result_1);
        $comment_votes = $user_id['pID'];

        if ($num_rows_2>0)
        {
        $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=1;
        echo "<form action='vote_comment.php?comment_id=".$cid."' method='post'>
        <button type='submit' class='positive' name='vote' id='vote' disabled>Upvote</button>
        <br>
        <button type='submit
        ' class='negative' name='downvote' id='downvote' enabled>Downvote</button>
        <br>
        </form>";
        }

        else
        {
        $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=0;
        echo "<form action='vote_comment.php?comment_id=".$cid."' method='post'>
        <button type='submit' class='positive' name='vote' id='vote' enabled>Upvote</button>
        <br>
        <button type='submit' class='negative' name='downvote' id='downvote' disabled>Downvote</button>
        <br>
        </form>";
        }
        }

        /////////////////////////////////////////////////////             Government Comment     //////////////////////////////////////////////////////////////////

      //  $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=0;
        if($_SESSION['SESS_USER_TYPE']=='1')
        {
        $query_2 = " SELECT * from govt_dept where email = '$email' ";
        $result_2 = mysqli_query($link, $query_2);
        $num_rows_3 = mysqli_num_rows($result_2);
        $user_id = mysqli_fetch_assoc($result_2);
        $gID = $user_id['gID'];
     //   echo $cid;

        $query_4 = " SELECT * from Govt_voted_comment where comment_id = '".$cid."' and gID = '".$gID."'";
        $result_4 = mysqli_query($link, $query_4);
        $num_rows_4 = mysqli_num_rows($result_4);
     //   echo $num_rows_4;
        $comment_vote = mysqli_fetch_assoc($result_4);
        $comment_votes = $user_id['pID'];
      //  echo $_SESSION['SESS_Comment_VOTE_DOWNVOTE'];

        if ($num_rows_4 > 0)
        {
        $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=1;
        echo $_SESSION['Comment_VOTE_DOWNVOTE'];
        echo "<form action='govt_vote_comment.php?comment_id=".$cid."' method='post'>
        <button type='submit' class='positive' name='vote' id='vote' disabled>Upvote</button>
        <br>
        <button type='submit
        ' class='negative' name='downvote' id='downvote' enabled>Downvote</button>
        <br>
        </form>";
        }

        else
        {
        $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=0;
        echo $_SESSION['Comment_VOTE_DOWNVOTE'];
        echo "<form action='govt_vote_comment.php?comment_id=".$cid."' method='post'>
        <button type='submit' class='positive' name='vote' id='vote' enabled>Upvote</button>
        <br>
        <button type='submit' class='negative' name='downvote' id='downvote' disabled>Downvote</button>
        <br>
        </form>";
        }
        }


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    }

    $email = $_SESSION['SESS_EMAIL'];
    $query = "SELECT * from Citizen_voted_problem where pID = '$pid' and email = '$email' ";
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
    echo "</div>";
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
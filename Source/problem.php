<?php
require_once('auth.php');
?>

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
//$cID = $_SESSION['SESS_MEMBER_ID'];

echo "<div class='Welcome_Message'>";
echo "Welcome ".$email."";
echo "<br>";
echo "<br>";
echo "</div>";
if(isset($_GET['pID']) && !empty($_GET['pID']))
{
    // Verify data
    $pID = mysqli_escape_string($link, $_GET['pID']); // Set pid variable

    $query = "SELECT * FROM Citizen_voted_problem WHERE pID='$pID' and cID='$cID'";
    $result = mysqli_query($link,$query);
    $num_rows = mysqli_num_rows($result);

    $query1 = "SELECT * FROM Problem WHERE pID='$pID'";
    $result1 = mysqli_query($link, $query1);
    $problem = mysqli_fetch_assoc($result1);
    $num_rows_1 = mysqli_num_rows($result1);
  
    $query2 = "SELECT * FROM Problem_responded WHERE pID='$pID'";
    $result2 = mysqli_query($link, $query2);
    $problem_responded = mysqli_fetch_assoc($result2);
    $response_rows = mysqli_num_rows($result2);

    $query3 = "SELECT * FROM Problem_status WHERE pID='$pID'";
    $result3 = mysqli_query($link, $query3);
    $Problem_status = mysqli_fetch_assoc($result3);

    $query4= "SELECT cID FROM Citizen WHERE email='$email'";
    $result4 = mysqli_query($link, $query4);
    $citizen = mysqli_fetch_assoc($result4);
    $cID=$citizen['cID'];
    $cid=$problem['cID'];

    if($cid == $cID)
    {
    echo "<form action='delete_problem.php?pID=$pID' method='post'>
          <input type='submit' value='Delete problem' id='post_comment'><br>
          </form>";
    }

    if($num_rows_1>0) 
    {
    //    echo $resname1;
        echo "<br>";
        $title = $problem['title'];
        $description = $problem['description'];
        $gID = $problem['to_whom'];
        $city = $problem['city'];
        $district = $problem['district'];
        $state = $problem['state'];
        $pin_code = $problem['pin_code'];
        $date_created = $problem['date_created'];
        $votes = $problem['votes'];

        $query = "SELECT media_path FROM Problem_media where pID = '$pID'";
        $result = mysqli_query($link,$query);
        if($result)
        {
            //if more than one media, run through loop
            $problem_media = mysqli_fetch_assoc($result);
            $img_path = $problem_media['media_path'];    
        }
       
        $date_respond_date=$Problem_responded['date_responded'];
        $creation_date=$Problem_status['date_created'];
        $notification_date=$Problem_status['date_notified'];
        $notification_taken_up_date=$Problem_status['date_taken_up'];
        $notification_pincode_date=$Problem_status['date_notified_pincode'];
        $notification_local_date=$Problem_status['date_notified_local'];
        $notification_solved_date=$Problem_status['date_solved'];
     //   $date_created = '01-12-2015';
        $img_url=localhost;

        $query = "SELECT dep_name FROM Govt where gID = '$gID'";
        $result = mysqli_query($link,$query);
        if($result)
        {
            $govt = mysqli_fetch_assoc($result);
            $to_whom = $govt['dep_name'];    
        }

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

        if($img_path != '')
        {
           echo "<img src='/Source/problem_images/".$problem['img_path']."' height='100px' width='100px' />"; 
        }
        echo "<br>";
        echo "Number of votes      :            ";
        echo $votes;
        echo "<br>";
        echo "<br>";

        echo "Problem Posted:  ";
        echo $date_created;
        echo "<br>";

       if($response_rows > 0)
        {
        echo "Problem Responded:  ";
        echo $date_respond_date;
        echo "<br>";
        }

        if($notification_date != 'NULL')
        {
        echo "Problem Notified     :  ";
        echo $notification_date;
        echo "<br>";
        }

        if($notification_taken_up_date != 'NULL')
        {
        echo "Problem Taken up     :  ";
        echo $notification_taken_up_date;
        echo "<br>";
        }

        if($notification_pincode_date != 'NULL')
        {
        echo "Problem Notified to local administration    :  ";
        echo $notification_pincode_date;
        echo "<br>";
        }

        if($notification_local_date != 'NULL')
        {
        echo "Problem Notified to local person incharge     :  ";
        echo $notification_local_date;
        echo "<br>";
        }

        if($notification_solved_date != 'NULL')
        {
        echo "Problem Solved     :  ";
        echo $notification_solved_date;
        echo "<br>";
        } 
    }
}
//echo $_SESSION['SESS_USER_TYPE'];
if($_SESSION['SESS_USER_TYPE']==1)
{
	$query = "SELECT * FROM Problem_responded WHERE pID='$pID'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows>0)
    {
    	$query1 = "SELECT * FROM Problem_responded WHERE pID='$pID'";
    	$result1 = mysqli_query($link, $query1);
    	$problem_responded = mysqli_fetch_assoc($result1);
    	$response = $problem_responded['response'];
    	$response_likes = $problem_responded['likes'];
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
			"<form action='post_response.php?pID=".$pID."' method='post' >
			<input class='test' placeholder='Write a Response' name='Response' id='Response'><br><br>
			<input type='submit' value='Post Response' id='post_comment'><br>
			</form>";
	}
    if($Problem_status['status']=='notified')
    {
   //     echo "Problem has been notified to the government <br><br> ";
        echo "<form action='status_update.php?pID=$pID' method='post' >
        <input type='submit' value='Take Up' name='taken_up' id='taken_up'><br>
        </form>";
        echo "<form action='status_update.php?pID=".$pID." method='post' >
        <input type='submit' value='Decline' name='Decline' id='Decline'><br>
        </form>";
    }
    if($Problem_status['status']=='Decline')
        echo "Problem has been cited as not so serious";

    if($Problem_status['status']=='taken_up')
    {
        echo 
        "<form action='status_update.php?pID=$pID' method='post' >
        <input type='submit' value='Notify to local administration' name='notified_pincode' id='notified_pincode'><br>
        </form>";
    }
    if($Problem_status['status']=='notified_pincode')
    {
    //    echo "Problem has been taken up by the government <br>";
        echo 
        "<form action='status_update.php?pID=".$pID."' method='post' >
        <input type='submit' value='Notified to local person' name='notified_local' id='notified_local'><br>
        </form>";
    }
    if($Problem_status['status']=='notified_local')
    {
   //     echo "Problem has been notified to the local administration.<br>";
        echo 
        "<form action='status_update.php?pID=".$pID."' method='post' >
        <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
        </form>";
    }
}

if($_SESSION['SESS_USER_TYPE']==0)
{
    $query = "SELECT * FROM Problem_responded WHERE pID='$pID'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows>0)
    {
        $query1 = "SELECT * FROM Problem_responded WHERE pID='$pID'";
        $result1 = mysqli_query($link, $query1);
        $problem_responded = mysqli_fetch_assoc($result1);
        $response = $problem_responded['response'];
        $response_likes = $problem_responded['likes'];
        echo "<br>";
    //    echo "<div class='Problem_votes'>";
        echo $response;
        echo "<br>";
   //   echo $response_likes;
        echo "<br>";
   //     echo "</div>";
    }
}

    if($Problem_status['status']=='created')
    {
        echo "Problem yet not notified to the government due to insufficient number of votes. <br><br> ";
    }
    if($Problem_status['status']=='notified')
    {
        echo "Problem has been notified to the government <br><br> ";
    }
    if($Problem_status['status']=='Decline')
        echo "Problem has been cited as not so serious";

    if($Problem_status['status']=='taken_up')
    {
        echo "Problem has been taken up by the government <br>";
    }
    if($Problem_status['status']=='notified_pincode')
    {
        echo "Problem has been notified to the local administration. <br>";
    }
    if($Problem_status['status']=='notified_local')
    {
        echo "Problem has been notified to the local person in charge and the problem will be resolved soon.<br>";
    }
    if($Problem_status['status']=='solved')
    {
        echo "Problem has been solved by the local administration.<br>";
      /*  if($_SESSION['SESS_USER_TYPE']==1)
        {
        echo 
        "<form action='problem_solved.php?pID=".$pID."' method='post' >
        <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
        </form>"
        }
        if($_SESSION['SESS_USER_TYPE']==0)
        {
        echo 
        "<form action='problem_solved.php?pID=".$pID."' method='post' >
        <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
        </form>"
        }*/
    }


$query = "SELECT comment_ID, cID, comment, likes FROM Problem_comment WHERE pID='$pID'";
$result = mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);
//$cID = mysqli_fetch_assoc($result);

if($num_rows>0)
{
    echo "<br>";
    echo "<h4>Comments</h4>";
    while ($problem_comment=mysqli_fetch_assoc($result)) 
    {
    echo "<br>";
    echo "<br>";
    $cid = $problem_comment['cID'];
    $query1 = "SELECT f_name, l_name FROM Citizen WHERE cID='$cid'";
    $result1 = mysqli_query($link, $query1);
    $citizen=mysqli_fetch_assoc($result1);

    echo $citizen['f_name'] ;
    echo " ";
    echo $citizen['l_name'];
    echo "      :           ";
    echo $problem_comment['comment'];
    echo "<br>";
    $comment_id = $problem_comment['comment_ID'];
    echo "Votes   :     ";
    echo $problem_comment['likes'];
    echo "<br>";
    if($cID == $cid)
        echo "<form action='update_comment.php?pID=$pID' method='post'>
            <input type='submit' value='Edit comment' id='post_comment'><br>
            </form>";

  ///////////////////////////////////////////////////            Citizen Comment       /////////////////////////////////////////////////////////////////////////

    if($_SESSION['SESS_USER_TYPE']=='0')
    {
    $query_1 = " SELECT * from Citizen_voted_comment where comment_id = '".$comment_id."' and cID = '".$cID."'";
    $result_1 = mysqli_query($link, $query_1);
    $num_rows_2 = mysqli_num_rows($result_1);
    $comment_vote = mysqli_fetch_assoc($result_1);
 //   $comment_votes = $user_id['pID'];

    if ($num_rows_2>'0')
    {
    $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=1;
    echo "<form action='vote_comment.php?comment_id=".$comment_id."' method='post'>
    <button type='submit' class='positive' name='vote' id='vote' disabled>Upvote</button>
    <br>
    <button type='submit' class='negative' name='downvote' id='downvote' enabled>Downvote</button>
    <br>
    </form>";
    }

    else
    {
    $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=0;
    echo "<form action='vote_comment.php?comment_id=".$comment_id."' method='post'>
    <button type='submit' class='positive' name='vote' id='vote' enabled>Upvote</button>
    <br>
    <button type='submit' class='negative' name='downvote' id='downvote' disabled>Downvote</button>
    <br>
    </form>";
    }
    }

/*    /////////////////////////////////////////////////////             Government Comment     //////////////////////////////////////////////////////////////////

  //  $_SESSION['SESS_Comment_VOTE_DOWNVOTE']=0;
    else if($_SESSION['SESS_USER_TYPE']=='1')
    {
    $query_2 = " SELECT * from Govt where email = '$email' ";
    $result_2 = mysqli_query($link, $query_2);
    $num_rows_3 = mysqli_num_rows($result_2);
    $user_id = mysqli_fetch_assoc($result_2);
    $gID = $user_id['gID'];

    $query_4 = " SELECT * from Govt_voted_comment where comment_id = '".$comment_id."' and gID = '".$gID."'";
    $result_4 = mysqli_query($link, $query_4);
    $num_rows_4 = mysqli_num_rows($result_4);
    $comment_vote = mysqli_fetch_assoc($result_4);
 //   $comment_votes = $user_id['pID'];
    echo $num_rows_4;
    if($num_rows_4 > '0')
    {
    echo "Here";
    echo "<form action='govt_vote_comment.php?comment_id=".$comment_id."' method='post'>
    <button type='submit' class='positive' name='vote' id='vote' disabled>Upvote</button>
    <br>
    <button type='submit
    ' class='negative' name='downvote' id='downvote' enabled>Downvote</button>
    <br>
    </form>";
    }

    else if($num_rows=='0')
    {
    echo "Here_2";
    echo "<form action='govt_vote_comment.php?comment_id=".$comment_id."' method='post'>
    <button type='submit' class='positive' name='vote' id='vote' enabled>Upvote</button>
    <br>
    <button type='submit' class='negative' name='downvote' id='downvote' disabled>Downvote</button>
    <br>
    </form>";
    }
    }
*/
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}

if($_SESSION['SESS_USER_TYPE']=='0')
{
$query = "SELECT * from Citizen_voted_problem where pID = '$pID' and cID = '$cID' ";
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

echo "<br>";

echo "<form action='vote.php?pID=$pID' method='POST'>
<button type='submit' class='positive' name='vote' id='vote' $vote_button>Vote</button>

<button type='submit' class='negative' name='downvote' id='downvote' 
$downvote_button>Downvote</button>
<br><br>
</form>";

echo "<form action='post_comment.php?pID=$pID' method='post'>
<input class='test' placeholder='Write a comment' name='comment' id='comment'><br><br>
<input type='submit' value='Post comment' id='post_comment'><br>
</form>";

}
?>

</body>
</html>

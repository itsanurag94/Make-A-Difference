<?php
session_start();
require_once('auth.php');
require_once('connection.php');
$cID = $_SESSION['SESS_MEMBER_ID'];
$email = $_SESSION['SESS_EMAIL'];
$role = $_SESSION['SESS_USER_TYPE'];
//$cID = $_SESSION['SESS_MEMBER_ID'];
if(!isset($_GET['pID']) || empty($_GET['pID']))
{
    echo "Error: pID not set";
}

$pID = mysqli_escape_string($link, $_GET['pID']); // Set pid variable
$query = "SELECT pID from Problem where pID='$pID'";
$result = mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);
if($num_rows==0)
{
    header("location:home_new.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Problem</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="homepage.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="css/problem.css" rel="stylesheet" type="text/css" />

  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  <script type="text/javascript" src="js/home.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">MaD</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><?php if($role==0) echo'<a href="home_new.php">'; else echo'<a href="govt_home.php">';?>Home</a></li>
        <li><a href="my_problems.php">My Problems</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> My Profile <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="my_profile.php">View Profile</a></li>
              <li><a href="change_password.php">Change Password</a></li>
              <li><a href="#">Account Settings</a></li>
            </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php

$query1 = "SELECT * FROM Problem WHERE pID='$pID'";
$result1 = mysqli_query($link, $query1);
$problem = mysqli_fetch_assoc($result1);
$num_rows_1 = mysqli_num_rows($result1);
$title = $problem['title'];
$date_created = $problem['date_created'];
$votes = $problem['votes'];
$to_whom = $problem['to_whom'];
$description = $problem['description'];
$creator_id=$problem['cID'];

$query = "SELECT dep_name, district from Govt where gID = '$to_whom'";
$result = mysqli_query($link, $query);
if($result)
{
    $govt = mysqli_fetch_assoc($result);
    $dep_name = $govt['dep_name'];
    $district = $govt['district'];
}


$query = "SELECT * FROM Citizen_voted_problem WHERE pID='$pID' and cID='$cID'";
$result = mysqli_query($link,$query);
$num_rows = mysqli_num_rows($result);
$citizen_voted = 0;
if($num_rows>0)
{
    $citizen_voted=1;
}
$query3 = "SELECT * FROM Problem_status WHERE pID='$pID'";
$result3 = mysqli_query($link, $query3);
$problem_status = mysqli_fetch_assoc($result3);
$status = $problem_status['status'];
$date_created = $problem_status['date_created'];
$date_notified = $problem_status['date_notified'];
$date_taken_up = $problem_status['date_taken_up'];
$date_declined = $problem_status['date_declined'];
$date_notified_pincode = $problem_status['date_notified_pincode'];
$date_notified_local = $problem_status['date_notified_local'];
$date_solved = $problem_status['date_solved'];

?>

<div class="container-fluid">
<div class="row content">
    <div class="col-md-8 ">
        <div>
          <div class="container-fluid">
            <h3 style="color:#5bc0de"><?php echo $title;?></h3>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="dummy"></div>
            <p class="thumbnail">Date Added<br><br>
            <button class="btn"><?php echo $date_created;?></button></p>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="dummy"></div>
            <p class="thumbnail">Votes<br><br>
            <button class="btn"><?php echo $votes;?></button></p>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="dummy"></div>
            <p class="thumbnail">Department<br><br>
            <button class="btn"><?php echo $dep_name;?></button></p>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="dummy"></div>
            <p class="thumbnail">Location<br><br>
            <button class="btn"><?php echo $district;?></button></p>
        </div>
        <div class="text-left"> 
          <h3>Description</h3>
          <p><?php echo $description; ?></p>
          <hr>
        </div>

        <h3>Timeline</h3>
        <div class="stepwizard">
        <div class="stepwizard-row">
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_created != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_created != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Created</p>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_notified != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_notified != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Notified to Government</p>
            </div>
            </div>
            <div class="col-md-1 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_taken_up != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_taken_up != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Taken Up</p>
            </div> 
            </div>
            <div class="col-md-3 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_notified_pincode != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_notified_pincode != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Notified to Municipal/Panchayat Authority</p>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_notified_local != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_notified_local != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Notified to Local authority</p>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <a type="button" class="btn btn-outline  btn-circle <?php if($date_solved != NULL)echo "active btn-success"; else echo "btn-default"; ?>"><?php if($date_solved != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></a>
                <p>Solved</p>
            </div>
            </div> 
        </div>
        </div>

        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_created!=NULL) echo date('d-M-Y', strtotime($date_created)); else echo "NA"; ?></button>
        </div>
        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_notified!=NULL) echo date('d-M-Y', strtotime($date_notified)); else echo "NA"; ?></button>
        </div>
        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_taken_up!=NULL) echo date('d-M-Y', strtotime($date_taken_up)); else echo "NA"; ?></button>
        </div>
        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_notified_pincode!=NULL)echo date('d-M-Y', strtotime($date_notified_pincode)); else echo "NA"; ?></button>
        </div>
        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_notified_local!=NULL)echo date('d-M-Y', strtotime($date_notified_local)); else echo "NA"; ?></button>
        </div>
        <div class="col-md-2 ">
            <button type="button" class="btn btn-info"><?php if($date_solved!=NULL)echo date('d-M-Y', strtotime($date_solved)); else echo "NA"; ?></button>
        </div> 
        
    </div>



    <div class="col-sm-4 container-fluid text-center"><br>
        <div class = "container-fluid">
          <a href="vote.php?pID=<?php echo $pID; ?>" role="button" class="btn btn-info
          <?php
          if($citizen_voted=='1' || $creator_id == $cID || $role == 1)
          {
            echo "disabled";
          }
          ?>
          ">Vote</a>
          
          <a href="downvote.php?pID=<?php echo $pID; ?>" role="button" class="btn btn-info
          <?php
          if($citizen_voted=='0' || $creator_id == $cID || $role == 1)
          {
            echo "disabled";
          }
          ?>
          ">Downvote</a>
          
          <a href="#" role="button" class="btn btn-info 
          <?php
          if($creator_id != $cID || $status != 'created' || $role == 1)
            echo "disabled";
          ?>
          ">Edit</a>
          
          <!-- Modal (pop-up to confirm delete event)-->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                        </div>
                    
                        <div class="modal-body">
                            <p>You are about to delete this problem, this procedure is irreversible.</p>
                            <p>Do you want to proceed?</p>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger btn-ok">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

          <a href="" data-href="delete_problem.php?pID=<?php echo $pID; ?>" data-toggle="modal" data-target="#confirm-delete" role="button" class="btn btn-info btn-danger
          <?php
          if($creator_id != $cID || $status != 'created' || $role == 1)
          {
     //       echo "hello";
            echo "disabled";
          } ?>
          ">Delete</a>
          <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
          </script>
        </div>
        <div>
            <span class="help-block"></span>
        </div>
        <div class="container">
            <div class="col-lg-4 col-sm-3 text-center">
            <div class="well">
                <h4>Comments</h4>
            <div class="input-group">
                <form class="form" action="post_comment.php?pID=<?php echo $pID; ?>" role="form">
                <input type="text" name="comment" id="userComment" class="form-control input-sm chat-input" placeholder="Write your comment here..." />
                <span class="input-group-btn" onclick="addComment()">     
                    <a href="#" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Add Comment</a>
                </span>
                </form>
            </div>
            <hr data-brackets-id="12673">
            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
                <strong class="pull-left primary-font">James</strong>
                <small class="pull-right text-muted">
                   <span class="glyphicon glyphicon-time"></span>7 mins ago</small>
                </br>
                <li class="ui-state-default">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </li>
                </br>
                 <strong class="pull-left primary-font">Taylor</strong>
                <small class="pull-right text-muted">
                   <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                </br>
                <li class="ui-state-default">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                
            </ul>
            </div>
        </div>
    </div>
</div>
</div>


<?php

if(!isset($_GET['pID']) || empty($_GET['pID']))
{
    echo "Error: pID not set";
}

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

$query4= "SELECT cID FROM Citizen WHERE email='$email'";
$result4 = mysqli_query($link, $query4);
$citizen = mysqli_fetch_assoc($result4);
$cID=$citizen['cID'];


if($num_rows_1>0) 
{
//    echo $resname1;
    echo "<br>";
    
    $query = "SELECT media_path FROM Problem_media where pID = '$pID'";
    $result = mysqli_query($link,$query);
    if($result)
    {
        //if more than one media, run through loop
        $problem_media = mysqli_fetch_assoc($result);
        $img_path = $problem_media['media_path'];    
    }
   
    $date_respond_date=$Problem_responded['date_responded'];
 
    //$img_url=localhost;

    $query = "SELECT dep_name FROM Govt where gID = '$gID'";
    $result = mysqli_query($link,$query);
    if($result)
    {
        $govt = mysqli_fetch_assoc($result);
        $to_whom = $govt['dep_name'];    
    }

    if($img_path != '')
    {
       echo "<img src='/mad/problem_images/".$problem['img_path']."' height='100px' width='100px' />"; 
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
/*        echo "<br> <br>";
        echo "Response from the government       :                 ";

  //      echo "<br>";
    //    echo "<div class='Problem_votes'>";
    	echo $response;
    	echo "<br>";
   // 	echo $response_likes;
    	echo "<br>";
   //     echo "</div>";
*/    }
    else
    {
/*			echo 
			"<form action='post_response.php?pID=".$pID."' method='post' >
			<input class='test' placeholder='Write a Response' name='Response' id='Response'><br><br>
			<input type='submit' value='Post Response' id='post_comment'><br>
			</form>";
*/	}
/*    if($problem_status['status']=='notified')
    {
   //     echo "Problem has been notified to the government <br><br> ";
        echo "<form action='status_update.php?pID=$pID' method='post' >
        <input type='submit' value='Take Up' name='taken_up' id='taken_up'><br>
        </form>";
        echo "<form action='status_update.php?pID=".$pID." method='post' >
        <input type='submit' value='Decline' name='Decline' id='Decline'><br>
        </form>";
    }
    if($problem_status['status']=='Decline')
        echo "Problem has been cited as not so serious";

    if($problem_status['status']=='taken_up')
    {
        echo 
        "<form action='status_update.php?pID=$pID' method='post' >
        <input type='submit' value='Notify to local administration' name='notified_pincode' id='notified_pincode'><br>
        </form>";
    }
    if($problem_status['status']=='notified_pincode')
    {
    //    echo "Problem has been taken up by the government <br>";
        echo 
        "<form action='status_update.php?pID=".$pID."' method='post' >
        <input type='submit' value='Notified to local person' name='notified_local' id='notified_local'><br>
        </form>";
    }
  
}

if($_SESSION['SESS_USER_TYPE']==1 && $problem_status['status']=='notified_local')
{
    echo 
    "<form action='problem_solved.php?pID=".$pID."' method='post' >
    <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
    </form>";
}
if($_SESSION['SESS_USER_TYPE']==1 && $problem_status['status']=='solved_citizen')
{
    echo 
    "<form action='problem_solved.php?pID=".$pID."' method='post' >
    <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
    </form>";
}
if($_SESSION['SESS_USER_TYPE']==0 && $problem_status['status']=='notified_local' && $creator_id == $cID)
{
    echo 
    "<form action='problem_solved_citizen.php?pID=".$pID."' method='post' >
    <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
    </form>";
}

if($_SESSION['SESS_USER_TYPE']==0 && $problem_status['status']=='solved_govt' && $creator_id == $cID)
{
   echo 
   "<form action='problem_solved_citizen.php?pID=".$pID."' method='post' >
   <input type='submit' value='Problem has been solved' name='solved' id='solved'><br>
   </form>";
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
/*        echo "<br>";
        echo $response;
        echo "<br>";
        echo "<br>";
    }
        */
}

$query = "SELECT comment_ID, cID, comment, likes FROM Problem_comment WHERE pID='$pID'";
$result = mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);

if($num_rows>0)
{
 //   echo "<br>";
//    echo "<h4>Comments</h4>";
    while ($problem_comment=mysqli_fetch_assoc($result)) 
    {
    echo "<br>";
    echo "<br>";
    $cid = $problem_comment['cID'];
    $query1 = "SELECT f_name, l_name FROM Citizen WHERE cID='$cid'";
    $result1 = mysqli_query($link, $query1);
    $citizen=mysqli_fetch_assoc($result1);
/*
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
    if($cid == $cID)
    {
    echo "<form action='delete_comment.php?comment_ID=$comment_id' method='post'>
          <input type='submit' value='Delete comment' id='post_comment'><br>
          </form>";
    }
*/
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

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}
/*
if($_SESSION['SESS_USER_TYPE']=='0')
{

echo "<form action='post_comment.php?pID=$pID' method='post'>
<input class='test' placeholder='Write a comment' name='comment' id='comment' ><br><br>
<input type='submit' value='Post comment' id='post_comment'><br>
</form>";

}
*/
?>

</body>
</html>

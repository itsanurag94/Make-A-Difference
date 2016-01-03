<?php
session_start();
if($_SESSION['SESS_USER_TYPE'] == 0)
  require_once('auth.php');
else if($_SESSION['SESS_USER_TYPE'] == 1)
  require_once('auth_govt.php');

require_once('connection.php');
$cID = $_SESSION['SESS_MEMBER_ID'];
$email = $_SESSION['SESS_EMAIL'];
$role = $_SESSION['SESS_USER_TYPE'];

if(!isset($_GET['pID']) || empty($_GET['pID']))
{
    echo "Error: pID not set";
}

$pID = mysqli_escape_string($link, $_GET['pID']); // Set pid variable

//if such a problem corresponding to the pID doesn't exist
$query = "SELECT pID from Problem where pID='$pID'";
$result = mysqli_query($link, $query);
$num_rows = mysqli_num_rows($result);
if($num_rows==0)
{
    header("location:home.php");
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
        <li><?php if($role==0) echo'<a href="home.php">'; else echo'<a href="govt_home.php">';?>Home</a></li>
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

$query = "SELECT * FROM Problem WHERE pID='$pID'";
$result = mysqli_query($link, $query);
$problem = mysqli_fetch_assoc($result);

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
  <!-- Problem Details -->
        <div>
          <div class="container-fluid">
            <h3 style="color:#5bc0de"><?php echo $title;?></h3>
          </div>
        </div>
        
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="dummy"></div>
            <p class="thumbnail">Date Added<br><br>
            <button class="btn"><?php echo date('d-M-Y', strtotime($date_created));?></button></p>
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

  <!-- Timeline Section -->
        <h3>Timeline</h3>
        <div class="stepwizard">
        <div class="stepwizard-row">
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <button class="btn btn-outline  btn-circle <?php if($date_created != NULL)echo "btn-success"; else echo "btn-default"; ?>" disabled><?php if($date_created != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Created</p>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
                <button class="btn btn-outline  btn-circle <?php if($date_notified != NULL)echo " btn-success"; else echo "btn-default"; ?>" disabled><?php if($date_notified != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Notified to Government</p>
            </div>
            </div>
            <div class="col-md-1 ">
            <div class="stepwizard-step">
              <form action="status_update.php?pID=<?php echo $pID; ?>&status=3" method="post">
                <button class="btn btn-outline  btn-circle <?php if($date_taken_up != NULL)echo " btn-success"; else echo "btn-default"; ?>" <?php if($role == 0 || $date_taken_up != NULL) echo " disabled";?>><?php if($date_taken_up != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Taken Up</p>
              </form>
            </div> 
            </div>
            <div class="col-md-3 ">
            <div class="stepwizard-step">
              <form action="status_update.php?pID=<?php echo $pID; ?>&status=4" method="post">
                <button class="btn btn-outline  btn-circle <?php if($date_notified_pincode != NULL)echo " btn-success"; else echo "btn-default"; ?>" <?php if($role == 0 || $date_notified_pincode != NULL) echo " disabled";?>><?php if($date_notified_pincode != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Notified to Municipal/Panchayat Authority</p>
              </form>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
              <form action="status_update.php?pID=<?php echo $pID; ?>&status=5" method="post">
                <button class="btn btn-outline  btn-circle <?php if($date_notified_local != NULL)echo " btn-success"; else echo "btn-default"; ?>" <?php if($role == 0 || $date_notified_local != NULL) echo " disabled";?>><?php if($date_notified_local != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Notified to Local authority</p>
              </form>
            </div>
            </div>
            <div class="col-md-2 ">
            <div class="stepwizard-step">
              <form action="status_update.php?pID=<?php echo $pID; ?>&status=6" method="post">
                <button class="btn btn-outline  btn-circle <?php if($date_solved != NULL) echo " btn-success"; else echo "btn-default"; ?>" <?php if($role == 0 || $date_solved != NULL) echo " disabled";?>><?php if($date_solved != NULL)echo '<i class="glyphicon glyphicon-ok"></i>'; ?></button>
                <p>Solved</p>
              </form>
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
  
  <!--Government Response to Problem-->
        <?php
          $query = "SELECT * FROM Problem_responded WHERE pID='$pID'";
          $result = mysqli_query($link, $query);
          $num_rows = mysqli_num_rows($result);

          if($num_rows>0)
          {
              $query = "SELECT * FROM Problem_responded WHERE pID='$pID'";
              $result = mysqli_query($link, $query);
              $problem_responded = mysqli_fetch_assoc($result);
              $response = $problem_responded['response'];
              $response_date = $problem_responded['date_responded'];
          }      
        ?>
        <div class="container">
            <div class="col-lg-4 col-sm-3 text-left">
            <div class="well">
                <h4 class="text-center">Response</h4>
            <div class="input-group">
                <form class="form" action="post_response.php?pID=<?php echo $pID; ?>" method="post">
                <input type="text" name="response" id="response" class="form-control input-sm chat-input" placeholder="Write your response here..." />
                <span class="input-group-btn">     
                    <button class="btn btn-primary btn-sm
                    <?php
                    if($num_rows>0 || $role == 0)
                    {
                      echo "disabled";
                    } ?>
                    "><span class="glyphicon glyphicon-comment"></span> Post Response</button>
                </span>
                </form>
            </div>                
            <strong class="pull-left primary-font"><?php if($response_date!=NULL) echo date('d-M-Y', strtotime($response_date)); ?></strong>
            </br>
            <p><?php echo $response; ?>. </p>
            </br>
            </div>
            </div>
        </div>

        <div>
            <span class="help-block"></span>
        </div>
  <!--Comments Section on Problem-->
        <div class="container">
            <div class="col-lg-4 col-sm-3 text-center">
            <div class="well">
                <h4>Comments</h4>
            <div class="input-group">
                <form class="form" action="post_comment.php?pID=<?php echo $pID; ?>" method="post">
                <input type="text" name="comment" id="comment" class="form-control input-sm chat-input" placeholder="Write your comment here..." />
                <span class="input-group-btn">     
                    <button class="btn btn-primary btn-sm
                    <?php
                    if($role == 1)
                    {
                      echo "disabled";
                    } ?>
                    "><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
                </span>
                </form>
            </div>
            <?php
              $query="SELECT cID, comment FROM Problem_comment where pID = '$pID'";
              $result = mysqli_query($link, $query);
              if($result)
              {
                $num_rows = mysqli_num_rows($result);  
              }
            ?>            
              
            <hr data-brackets-id="12673">
            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
              <?php if($num_rows>0) { ?>
                <?php while($problem_comment = mysqli_fetch_assoc($result)) : ?>
                <?php
                  $comment = $problem_comment['comment'];
                  $comment_cID = $problem_comment['cID'];  
                  $query1 = "SELECT f_name from Citizen where cID='$comment_cID'";
                  $result1 = mysqli_query($link, $query1);
                  $comment_citizen_details = mysqli_fetch_assoc($result1);
                  $comment_f_name=$comment_citizen_details['f_name'];
                ?>               
                <strong class="pull-left primary-font"><?php echo $comment_f_name; ?></strong>
                </br>
                <li class="ui-state-default"><?php echo $comment; ?>. </li>
                </br>
                <?php endwhile; ?>
              <?php } ?>  
            </ul>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
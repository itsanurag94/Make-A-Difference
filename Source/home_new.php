<?php
require_once('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Make A Difference</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="css/home.css" rel="stylesheet" type="text/css" />
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
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">My Problems</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> My Profile <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">View Profile</a></li>
              <li><a href="#">Change Password</a></li>
              <li><a href="#">Account Settings</a></li>
            </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid">
  <div class="row content">
    <div class="col-md-8 ">
      <form action="#" method="get" id="searchForm" class="input-group">            
        <div class="input-group-btn search-panel">
            <select name="search_param" id="search_param" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <option value="all">Problem</option>
                <option value="username">Location</option>
                <option value="email">Department</option>
            </select>
        </div>
        <input type="text" class="form-control" name="x" placeholder="Search term...">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
               <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
      </form><!-- end form -->
    
      <table class="table table-striped custab">
      <thead>
        <tr>
            <th>Title</th>
            <th>Department</th>
            <th>Votes</th>
            <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
        require_once('connection.php');
        session_start();
        $email = $_SESSION['SESS_EMAIL'];

        $query="SELECT district, pin_code FROM Citizen where email = '$email'";
        $result = mysqli_query($link, $query);
        if($result)
        {
          $citizen = mysqli_fetch_assoc($result);
          $district = $citizen['district'];
          $pin_code = $citizen['pin_code'];  
        }

        $query="SELECT * FROM Problem where pin_code = '$pin_code'";
        $result=mysqli_query($link, $query);
        if($result)
        {
          $num_rows = mysqli_num_rows($result);  
        }
        ?>
                
        <?php if($num_rows > 0) { ?>

          <?php while($problem = mysqli_fetch_assoc($result)) : ?>
            <?php
            $to_whom = $problem['to_whom'];
            $pID = $problem['pID'];
            $query="SELECT dep_name FROM Govt where gID = '$to_whom'";  
            $result1=mysqli_query($link, $query);
            $govt = mysqli_fetch_assoc($result1);
            
            echo '<tr>';
            echo '<td> '.$problem['title'].'</td>';
            echo '<td> '.$govt['dep_name'].'</td>';
            echo '<td> '.$problem['votes'].'</td>';
            ?>
            <td class="text-center"><a class='btn btn-info btn-md' href="problem.php?pID=<?php echo $pID;?>"><span class="glyphicon glyphicon-edit"></span> View</a></td>
            </tr>
          <?php endwhile; ?>
        <?php } ?>
      </tbody>
      </table>
    </div>


    <div class="col-md-4">
            
    </div>

  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>
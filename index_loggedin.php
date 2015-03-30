<?php
include 'connect.php';
if(isset($_SESSION)) {
  $user = $_SESSION['username'];
};

session_start();

if (!isset($_SESSION['is_logged_in'])) {
    $filePath = explode('/', $_SERVER['PHP_SELF'], -1);
    $filePath = implode('/', $filePath);
    $redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
    header("Location: {$redirect}/index.php", true);
}
             
?>
<!-- End PHP code -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>Avoid Drunk Driving</title>

    <!-- Bootstrap core CSS -->
    <link href="./CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./CSS/jumbotron.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

        </div>
        <div id="navbar" class="navbar-collapse collapse">
         
          <form class="navbar-form navbar-right" action="logout.php">
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>

        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main area to show welcome message and search for destination -->
    <div class="jumbotron">
      <div class="container">

        <h2>Avoid Drunk Driving through Safe Parking</h2>
          <?php
          if(isset($_SESSION)) {
            $user = $_SESSION['username'];
            echo "<p>Welcome " . $user . "! You are logged in!</p>";
          };
        ?>
        <p>Enter the name of your destination here to search for information for parking.</p>
        <form class="form-inline" method="GET" action="index_loggedin.php">
          <div class="form-group">
          <input type="text" placeholder="Destination" name="destination" class="form-control" required>
          </div>    
        <br><br>
        <button class="btn btn-lg btn-primary btn-lg" type="submit" name="search">Search</button>
        </form>
        <br><br>
        <p>Click below to view all of the destinations entered so far.</p>
        <a class="btn btn-primary" href="viewDestinations.php">View Destinations</a>
        <br><br>
        <p>Do you want to add a destination?</p>
        <a class="btn btn-primary btn-lg" href="destinationCreation.php" role="button">Click Here</a>
      
      </div> 
    </div>
    <div class="container"> 
      <div class="row"> 

        <?php
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
          if(isset($_GET['search'])) {
          $exit_flag = false;
            
            if($_GET['destination'] == null){
              echo "Destination name required!";
              echo '<br>';
              $exit_flag = true;
            }//End IF
            if (strlen ($_GET['destination']) > 255){
              echo 'Destination name must be 255 characters or less!';
              echo '<br>';
              $exit_flag = true;
            }//End IF
            if($exit_flag){
              echo 'Invalid input or missing parameter(s), exiting program.  Please try again.';
              exit();
            }//End IF
            
            if(!($stmt=$mysqli->prepare("SELECT id, destination, address, instructions FROM destinations WHERE destination = ?"))){ 
              echo "Prepare failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;          
            }//End IF
                
            if(!($stmt->bind_param("s",$_GET['destination']))){
              echo "Bind failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
            }//End IF
                        
            if(!($stmt->execute())){
              echo "Execute failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
            }//End IF
            
            $stmt->store_result();
            //checks to see if no results were returned by search
            if ($stmt->num_rows == 0) {
              echo "Search returned no hits. Search again.";
              $stmt->close();
              exit();
            } 
            
            if(!($stmt->bind_result($id,$destination,$address,$instructions))){
              echo "Bind failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
            }//End IF
            //Sets up table to display results
            echo "<legend>Destination Table</legend>
      
                <table class='table table-bordered'>  
                <tr>
                  <td>Destination</td>
                  <td>Address</td>
                  <td>Parking Instructions</td>
                </tr>";  
            //prints out rows of results            
            while($stmt->fetch()){    
              echo "<tr><td>".$destination."</td>";
              echo "<td>".$address."</td>";
              echo "<td>".$instructions."</td>";
            }//End WHILE
            
            $stmt->close();
            echo "</table>";
          }
        }  
        ?>    
        </div>
      </div>
    </div> <!-- /container -->
  </body>
</html>
<?php
session_start();
include 'connect.php';
?><!-- End PHP code -->
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
          
          <form class="navbar-form navbar-left" action="index_loggedin.php">
            <button type="submit" class="btn btn-primary">Home</button>
          </form>

          <form class="navbar-form navbar-right" action="register.php">
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        
          <form class="navbar-form navbar-right" method="POST" action="login.php">
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>

        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main area to show welcome message and search for destination -->
    <div class="jumbotron">
      <div class="container">
        <h2>Destinations</h2>
        <p>If you couldn't find a destination you were looking for through search, here is a list of all of the destinations entered so far. If you would like to create a destination, please log in or register.</p>
      </div> 
    </div>

    <!-- Main area to show populated destination table -->
    <div class="container"> 
      <div class="row"> 
        <legend>Destination Table</legend>
        <table class="table table-bordered">  
          <tr>
            <td>Destination</td>
            <td>Address</td>
            <td>Parking Instructions</td>
          </tr>  

          <?php
           
            //Returning table from database
            if(!($stmt=$mysqli->prepare("SELECT id, destination, address, instructions FROM destinations"))){
    
              echo "Prepare failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
              
            }//End IF
            
            if(!($stmt->execute())){
            
              echo "Execute failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
            }//End IF
            if(!($stmt->bind_result($id,$destination,$address,$instructions))){
              echo "Bind failed: ".$mysqli->connect_errno." ".$mysqli->connect_error;
            }//End IF
            
            while($stmt->fetch()){
              
              echo "<tr><td>".$destination."</td>";
              echo "<td>".$address."</td>";
              echo "<td>".$instructions."</td>";
            }//End WHILE
            $stmt->close();
            
          ?>
        </table>
      </div> <!-- /row -->
    </div> <!-- /container -->

  </body>
</html>


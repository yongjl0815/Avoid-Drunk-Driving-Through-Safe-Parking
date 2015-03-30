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

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="./CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./CSS/destination.css" rel="stylesheet">

  </head>

	<body>

	  <div class="container">

	    <form action="index_loggedin.php">
	    	<button class="btn btn-lg btn-success" type="submit">Back</button>
	    </form>

<?php	
//Inserting new data into database
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['add'])) {
		$exit_flag = false;
		
		if($_POST['destination'] == null){

			echo "Destination required!";
			echo '<br>';
			$exit_flag = true;
		}//End IF

		if($_POST['address'] == null){

			echo "Address required!";
			echo '<br>';
			$exit_flag = true;
		}//End IF	
		
		if($_POST['directions'] == null){

			echo "Parking Directions required!";
			echo '<br>';
			$exit_flag = true;
		}//End IF
		
		if (strlen ($_POST['destination']) > 255){

			echo 'Destination name must be 255 characters or less!';
			echo '<br>';
			$exit_flag = true;
		}//End IF
		
		if (strlen ($_POST['address']) > 255){
			echo 'Address must be 255 characters or less!';
			echo '<br>';
			$exit_flag = true;
		}//End IF
		
		if($exit_flag){

			echo 'Invalid input or missing parameter(s), exiting program.  Please try again.';
			exit();
		}//End IF
		

		
		if(!($stmt = $mysqli->prepare("INSERT INTO destinations(destination, address, instructions) VALUES(?,?,?)"))){
		
			echo "Prepare failed: ".$stmt->errno." ".$stmt->error;
		}//End IF

		
		
		if(!($stmt->bind_param("sss", $_POST['destination'], $_POST['address'], $_POST['directions']))){


			echo "Bind failed: ".$stmt->errno." ".$stmt->error;
		}//End IF
		
			
		if(!($stmt->execute())) {
			
			echo "Execute failed: ".$stmt->errno." ".$stmt->error;
		}//End IF
		
		else {

			echo "<h3>Added <i>".$_POST['destination']."</i> to the Destinations database.</h3>";
		
		}//End ELSE

			$stmt->close();
	}
}
?>

      <form class="form-signin" method="POST" action="destinationCreation.php">
        <h2 class="form-signin-heading">Add a destination here:</h2>
        
        <label for="inputDeset" class="">Destination</label>
        <input type="text" id="destInput" name="destination" class="form-control" placeholder="Destination" required autofocus>
        
        <label for="inputAddress" class="">Address</label>
        <textarea id="inputAddress" name="address" class="form-control" placeholder="Address" required></textarea>
        
        <label for="inputDir" class="">Parking Directions</label>
        <textarea id="inputDir" name="directions" class="form-control" placeholder="Directions" required></textarea>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="add">Add Destination</button>
      </form>

    </div> <!-- /container -->
	</body>
</html>


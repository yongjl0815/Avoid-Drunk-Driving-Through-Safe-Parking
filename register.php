<?php
session_start();
?>
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
    <link href="./CSS/register.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

	    <form method="GET" action="index.php">
	    	<button class="btn btn-lg btn-success" type="submit">Back</button>
	    </form>

<?php
include_once('connect.php');

  if(isset($_POST['submit'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $email = $_POST['email'];
    
    if($username=='' || $password==''){
      echo 'Enter your username and/or password';
      exit();
    }
    if($email=='' ){
      echo 'Enter your email';
      exit();
    }
    $query = $mysqli->query ("SELECT * FROM users WHERE username='$username'");
    
    if(mysqli_num_rows($query)>0){
      echo '<h1>This username is already in use.</h1>';
      exit();
    }

    $sql = $mysqli->prepare("INSERT INTO users (username, password, fname, lname, email) VALUES ('$username', '$password', '$fname', '$lname', '$email')");
    $sql->bind_param("sssss", $username, $password, $fname, $lname, $email);
      $sql->execute();
      $sql->close();
      echo '<h1>Registration Successful. Now go back to main page and login.</h1>';
  }
?>

      <form class="form-signin" method="POST" action="register.php">
        <h2 class="form-signin-heading">Please register here</h2>
        
        <label for="inputUsername" class="register">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        
        <label for="inputPassword" class="register">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

        <label for="inputFName" class="register">First Name</label>
        <input type="text" id="inputFName" name="fname" class="form-control" placeholder="First name" required>        

        <label for="inputLName" class="register">Last Name</label>
        <input type="text" id="inputLName" name="lname" class="form-control" placeholder="Last name" required>        

        <label for="inputEmail" class="register">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>

<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script type='text/javascript'>
    $(document).ready(function() {

    $('#login').click(function(event) {
      event.preventDefault();

      var username = $('#inputUsername').val();
      var password = $('#inputPassword').val();

      if (username == '' || password == '') {
          alert('Please enter username and password');
        } else {

        $.ajax({
        type: 'POST',
        url: 'testuser.php',
        data: 'username=' + username + '&password=' + password,
        success: function(data) {
          var result = $.trim(data);
          if (result === 'login') {
              window.location = 'index_loggedin.php';
          } else {
              alert('Invalid Login Details');
          }
        }
      });
      }
    });
  });
</script>

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="./CSS/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./CSS/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

	    <form action="index.php">
	    	<button class="btn btn-lg btn-success" type="submit">Back</button>
	    </form>

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please sign in here</h2>
        
        <label for="inputUsername" class="register">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
        
        <label for="inputPassword" class="register">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="login">Sign In</button>
      </form>

	    <form class="form-signin" action="register.php">
	    	<h2>Not Registered? Please register!</h2>
	    	<button class="btn btn-lg btn-primary" type="submit">Register</button>
	    </form>

    </div> <!-- /container -->

  </body>
</html>

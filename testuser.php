<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'connect.php';
if(!isset($_SESSION)) {
	session_start();
};

/* check the database for the passed in username and password.  If it's there, redirect to metal.php homepage */

	/* Prepared statement, stage 1: prepare */
	if (!($stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?"))) {
 		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

		if (!$stmt->bind_param("ss", $_POST['username'], $_POST['password'])) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

		if (!$stmt->execute()) {
	   	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$stmt->store_result();
	$stmt->fetch();

	if($stmt->num_rows > 0) {

			if (!isset($_SESSION['is_logged_in'])) {
				$_SESSION['is_logged_in'] = 1;
			}

			if (!isset($_SESSION['username'])) {
				$_SESSION['username'] = $_POST['username'];
			}

			if (!isset($_SESSION['password'])) {
				$_SESSION['password'] = $_POST['password'];
			}
		
			echo 'login';
			
	} else {
		echo ('Incorrect Login Details');
		return false;
	}

	$mysqli->close();

?>


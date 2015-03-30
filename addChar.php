<?php
 
	//ini_set('error_reporting', E_ALL);
	//ini_set('display_errors', 'On');  //On or Off	
	
	
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'leey2-db';
	$dbuser = 'leey2-db';
	$dbpass = 'hqldhrvMO9c6xlVr';

	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname); 

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") "
		. $mysqli->connect_error;
	exit;
	}
	
	$name = $_POST['Name'];
	$health = $_POST['Health'];
	$mana = $_POST['Mana'];
	$myth = $_POST['Mythology'];
	$phys = $_POST['PhysicalApp'];
	$role = $_POST['Role'];	
	$enemy = $_POST['Enemy'];
	
	

	if ($enemy == 0){
		$enemy = NULL;
	}

	if (!($stmt = $mysqli->prepare("INSERT INTO 275Character(name, health, mana, myid, pid, enemyid) VALUES (?, ?, ?, ?, ?, ?)"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("siiiii", $name, $health, $mana, $myth, $phys, $enemy)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
		
	$stmt->close();

	//To enter a row into CharRole Table if necessary.
	if ($role != 0){
		if (!($stmt = $mysqli->prepare("SELECT id from 275Character WHERE name='$name'"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!$stmt->bind_result($out_id)) {
			echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}		

		if (!$stmt->fetch()) {
			echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		$stmt->close();
		

		if (!($stmt = $mysqli->prepare("INSERT INTO 275CharRole(cid, rid) VALUES (?, ?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->bind_param("ii", $out_id, $role)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$stmt->close();
	}
	
	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
?>	
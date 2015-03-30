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
	
	$Characterid = $_POST['Character'];
	$PhysicalAppid = $_POST['PhysicalApp'];

	
	if (!($stmt = $mysqli->prepare("UPDATE 275Character SET pid = ? WHERE id = ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("ii", $PhysicalAppid, $Characterid)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	$stmt->close();

	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
?>	
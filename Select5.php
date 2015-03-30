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

	$mythid = $_POST['Mythology'];
	$phyid = $_POST['PhysicalApp'];
		
	if(!($stmt = $mysqli->prepare("SELECT sum(c.health), sum(c.mana) FROM 275Character c INNER JOIN 275PhysicalApp p ON c.pid = p.id INNER JOIN 275Mythology m ON m.id = c.myid WHERE m.id = '$mythid' AND NOT p.id = '$phyid'"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_shealth, $out_smana)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Character Table";
	echo "<table border=1px>";
	echo "<tr><td>Sum of Health</td><td>Sum of Mana</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_shealth);
		echo "</td><td>";
		echo htmlspecialchars($out_smana);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();

	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
?>	
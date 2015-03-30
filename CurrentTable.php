<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Character Table</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>	
<body>
	<?php
	
	//Generate Character Table
	if(!($stmt = $mysqli->prepare("SELECT id, name, health, mana, myid, pid, enemyid FROM 275Character ORDER BY id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_id, $out_name, $out_health, $out_mana, $out_myid, $out_pid, $out_enemyid)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Character Table";
	echo "<table border=1px>";
	echo "<tr><td>ID</td><td>Name</td><td>Health</td><td>Mana</td><td>Mythology ID</td><td>Physical Appearance ID</td><td>Enemy ID(from Character table)</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_id);
		echo "</td><td>";
		echo htmlspecialchars($out_name);
		echo "</td><td>";
		echo htmlspecialchars($out_health);
		echo "</td><td>";
		echo htmlspecialchars($out_mana);
		echo "</td><td>";
		echo htmlspecialchars($out_myid);
		echo "</td><td>";
		echo htmlspecialchars($out_pid);
		echo "</td><td>";
		echo htmlspecialchars($out_enemyid); 
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();
	echo "\n<br />";
	
	//Generate Mythology Table
		if(!($stmt = $mysqli->prepare("SELECT id, name, origin FROM 275Mythology ORDER BY id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_id, $out_name, $out_origin)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Mythology Table";
	echo "<table border=1px>";
	echo "<tr><td>ID</td><td>Name</td><td>Origin</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_id);
		echo "</td><td>";
		echo htmlspecialchars($out_name);
		echo "</td><td>";
		echo htmlspecialchars($out_origin);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();
	echo "\n<br />";
	
	//Generate Physical Appearance Table	
		if(!($stmt = $mysqli->prepare("SELECT id, name, popularity FROM 275PhysicalApp ORDER BY id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_id, $out_name, $out_popularity)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Physical Appearance Table";
	echo "<table border=1px>";
	echo "<tr><td>ID</td><td>Name</td><td>Popularity Rank</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_id);
		echo "</td><td>";
		echo htmlspecialchars($out_name);
		echo "</td><td>";
		echo htmlspecialchars($out_popularity);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();
	echo "\n<br />";
	
	//Generate Role Table	
		if(!($stmt = $mysqli->prepare("SELECT id, name, rangeType FROM 275Role ORDER BY id"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_id, $out_name, $out_range)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Role Table";
	echo "<table border=1px>";
	echo "<tr><td>ID</td><td>Name</td><td>Range Type</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_id);
		echo "</td><td>";
		echo htmlspecialchars($out_name);
		echo "</td><td>";
		echo htmlspecialchars($out_range);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();
	echo "\n<br />";
	
	//Generate Character-Role Relationship Table	
		if(!($stmt = $mysqli->prepare("SELECT cid, rid FROM 275CharRole ORDER BY cid"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_cid, $out_rid)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Character-Role Relationship Table";
	echo "<table border=1px>";
	echo "<tr><td>Character ID</td><td>Role ID</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_cid);
		echo "</td><td>";
		echo htmlspecialchars($out_rid);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();

	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
	?>

</body>
</html>	
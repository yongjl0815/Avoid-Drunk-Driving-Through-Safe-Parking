<?php
ini_set('display_error', 'On');

/* You need to insert your database information within this file to get a local 
		environment set up */

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "INSERT DB NAME", "INSERT DB PW", "INSERT DB NAME");
if($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" .$mysqli->connect_errno. ")" .$mysqli->connect_error;
	}
	
?>

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
	<title>Smite DataBase</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
</head>	
<body>
	<!-- Introduction - CSS will be added later from some styling-->
    <div>
	<h2>SMITE DATABASE</h2>
	<p>This database is for Smite, a MOBA game I enjoy on a regular basis.</p>
	<p>You can manipulate the database by adding, updating, or deleting any row or attribute.</p>
	<p>There are five tables choose from:</p>
	
	<!-- Show what's in current database-->

		<p><a href="CurrentTable.php">SEE ALL TABLES</a></p>

	<p>Few rules to remember:</p>
		<ul>
			<li>A character must derive from a mythology. - A character must only belong to one mythology. This is a one to many relationship.</li>
			<li>A character must have physical appearance. - A character must have only one dominant physical appearance; therefore this is a one to many relationship.</li>
			<li>A character can belong to a role. - Some characters can fulfill few different roles while others can‘t, so this is a many to many relationship. A character can be without roles.</li>
			<li>A character can have a sworn enemy. - A character may have one enemy that he despises or none. Being the enemy does not have go both ways and multiple characters can despise a single character.</li>
		</ul
	</div></br></br>
	
	
	
	<!--Adding or Updating rows-->
	<div>
	<div style="float:left;">
		<form method="post" action="addChar.php"> 

			<fieldset>
				<legend>Add Characters</legend>
				<p>Name: <input type="text" name="Name" /></p>
				<p>Health: <input type="text" name="Health" /></p>
				<p>Mana: <input type="text" name="Mana" /></p>

				<p>Mythology:</p>
				<select name="Mythology">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Mythology ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
				<p>Physical App:</p>
				<select name="PhysicalApp">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>

				<p>Role:</p>
				<select name="Role">
				<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
				<p>Enemy:</p>
				<select name="Enemy">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
			</select>
			</fieldset>
			<input type="submit" name="add" value="Add Character" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="addMyth.php"> 

			<fieldset>
				<legend>AddMythology</legend>
				<p>Name: <input type="text" name="Name" /></p>
				<p>Origin: <input type="text" name="Origin" /></p>
			</fieldset>
			<input type="submit" name="add" value="Add Mythology" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="addPhy.php"> 

			<fieldset>
				<legend>Add Physical Appearance</legend>
				<p>Name: <input type="text" name="Name" /></p>
				<p>Popularity: <input type="text" name="Popularity" /></p>
			</fieldset>
			<input type="submit" name="add" value="Add Physical Appearance" />
		</form>
	</div>

	<div>
		<form method="post" action="addRole.php"> 

			<fieldset>
				<legend>Add Role</legend>
				<p>Name: <input type="text" name="Name" /></p>
				<p>Range Type: <input type="text" name="Range" /></p>
			</fieldset>
			<input type="submit" name="add" value="Add Role" />
		</form>
	</div>
	</div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>		
	

	<!--Updating rows-->
	<div>
	<div style="float:left;">
		<form method="post" action="upChar.php"> 

			<fieldset>
				<legend>Update Character</legend>
				<p>Name:</p>
				<select name="Character">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				<p>Health: <input type="text" name="Health" /></p>
				<p>Mana: <input type="text" name="Mana" /></p>			
			</fieldset>
			<input type="submit" name="update" value="Update Character" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="upMyth.php"> 
			
			<fieldset>
				<legend>Update Mythology</legend>
				<p>Name:</p>
				<select name="Mythology">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Mythology ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				<p>Origin: <input type="text" name="Origin" /></p>
			</fieldset>
			<input type="submit" name="update" value="Update Mythology" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="upPhy.php"> 

			<fieldset>
				<legend>Update Physical Appearance</legend>
				<p>Name:</p>
				<select name="PhysicalApp">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $pname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				<p>Popularity: <input type="text" name="Popularity" /></p>
			</fieldset>
			<input type="submit" name="update" value="Update Physical Appearance" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="upRole.php"> 

			<fieldset>
				<legend>Update Role</legend>
				<p>Name:</p>
				<select name="Role">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $rname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $rname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				<p>Range Type: <input type="text" name="Range" /></p>
			</fieldset>
			<input type="submit" name="update" value="Update Role" />
		</form>
	</div>
	
	<div style="float:left;">
		<form method="post" action="upEnemy.php"> 

			<fieldset>
				<legend>Update Enemy</legend>
				<p>Name:</p>
				<select name="Character">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
				<p>Enemy Name:</p>
				<select name="Enemy">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $ename)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $ename . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
			</fieldset>
			<input type="submit" name="update" value="Update Enemy" />
		</form>
	</div>
	</div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
	
	
	<!--Updating/Adding relationships-->
	<div>
	<div style="float:left;">
		<form method="post" action="upRelCM.php"> 

			<fieldset>
				<legend>Update Relationship(C+M)</legend>
				<p>Character:</p>
				<select name="Character">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
				<p>Mythology:</p>
				<select name="Mythology">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Mythology ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
			</fieldset>
			<input type="submit" name="update" value="Update Relationship (C+M)" />
		</form>
	</div>

	<div>
	<div style="float:left;">
		<form method="post" action="upRelCP.php"> 

			<fieldset>
				<legend>Update Relationship(C+P)</legend>
				<p>Character:</p>
				<select name="Character">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
				<p>Physical App:</p>
				<select name="PhysicalApp">
					<option value=0>none</option>
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp  ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $pname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $pname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>				
				
			</fieldset>
			<input type="submit" name="update" value="Update Relationship (C+P)" />
		</form>
	</div>

	
	<div>
	<div style="float:left;">
		<form method="post" action="addRelCR.php"> 

			<fieldset>
				<legend>Add Relationship</legend>
				<p>Character:</p>
				<select name="Character">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
	
				<p>Role:</p>
				<select name="Role">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role  ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $rname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $rname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
			</fieldset>
			<input type="submit" name="update" value="Add Relationship (C+R)" />
		</form>
	</div>
	
	
	<div>
		<form method="post" action="deleteRelCR.php"> 

			<fieldset>
				<legend>Delete Relationship</legend>
				<p>Character:</p>
				<select name="Character">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $cname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $cname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
	
				<p>Role:</p>
				<select name="Role">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role  ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $rname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $rname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
				
			</fieldset>
			<input type="submit" name="update" value="Delete Relationship (C+R)" />
		</form>
	</div>
	<div></br></br></br></br>
	
	
	
	<!--Deleting rows-->
	<div>
	<div style="float:left;">
		<form method="post" action="deleteChar.php"> 

			<fieldset>
				<legend>Delete Character</legend>
				<select name="Character">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Character ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
			</fieldset>
			<input type="submit" name="delete" value="Delete Character" />
		</form>
	</div>
	
	<div style="float:left;">
		<form method="post" action="deleteMyth.php"> 

			<fieldset>
				<legend>Delete Mythology</legend>
				<select name="Mythology">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Mythology ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
			</fieldset>
			<input type="submit" name="delete" value="Delete Mythology" />
		</form>
	</div>
	
	<div style="float:left;">
		<form method="post" action="deletePhy.php"> 

			<fieldset>
				<legend>Delete Physical Appearance</legend>
				<select name="PhysicalApp">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
			</fieldset>
			<input type="submit" name="delete" value="Delete Physical Appearance" />
		</form>
	</div>

	<div>
		<form method="post" action="deleteRole.php"> 

			<fieldset>
				<legend>Delete Role</legend>
				<select name="Role">
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>
				</select>
			</fieldset>
			<input type="submit" name="delete" value="Delete Role" />
		</form>
	</div>
	</div></br></br></br></br></br>
	
	
	
	<!--Select rows-->
	<div>
	<div style="float:left;">
		<form method="post" action="Select1.php"> 

			<fieldset>
				<legend>Select Character sort by role (Alphabetical Order)</legend>
			</fieldset>
			<input type="submit" name="select" value="See Result" />
		</form>
	</div>

	<div style="float:left;">
		<form method="post" action="Select2.php"> 

			<fieldset>
				<legend>Select Character filtered by physical appearance and role</legend>
				<select name="PhysicalApp">			
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	?>
				</select>
				<select name="Role">
	<?php			
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Role ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	$stmt->close();
	?>			
			</select>
			</fieldset>
		<input type="submit" name="select" value="See Result" />
		</form>		
	</div>
	
	<div style="float:left;">
		<form method="post" action="Select3.php"> 

			<fieldset>
				<legend>Select Character filtered by mythology and role type </legend>
				<select name="Mythology">			
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275Mythology ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	?>
				</select>
				<select name="Role">
	<?php			
	if(!($stmt = $mysqli->prepare("SELECT id, rangeType FROM 275Role ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . 'Not '.$mname . '</option>\n';
	}
	$stmt->close();
	?>		
			</select>
			</fieldset>	
		<input type="submit" name="select" value="See Result" />	
		</form>			
	</div>
	</div></br></br></br></br></br>
	
	<div>
	<div style="float:left;">
		<form method="post" action="Select4.php"> 

			<fieldset>
				<legend>Sum of number of characters filtered by health, mana and physical appearance's popularity</legend>
				<p>Health Greater than: <input type="text" name="Health" /></p>
				<p>Mana less than: <input type="text" name="Mana" /></p>

				<select name="PhysicalApp">			
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, popularity FROM 275PhysicalApp ORDER BY popularity"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' ."Ranking: ". $mname . '</option>\n';
	}
	?>
			</select>
			</fieldset>	
		<input type="submit" name="select" value="See Result" />	
		</form>			
	</div>

	<div style="float:left;">
		<form method="post" action="Select5.php"> 

			<fieldset>
				<legend>Sum of health and mana of characters filtered by mythology and physical appearance</legend>
				<select name="Mythology">	
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, origin FROM 275Mythology ORDER BY origin"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
	}
	?>
				</select>
				<select name="PhysicalApp">			
	<?php
	if(!($stmt = $mysqli->prepare("SELECT id, name FROM 275PhysicalApp ORDER BY name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($id, $mname)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	while($stmt->fetch()){
		echo '<option value=" '. $id . ' "> ' .'Not '. $mname . '</option>\n';
	}
	?>
			</select>
			</fieldset>	
		<input type="submit" name="select" value="See Result" />	
		</form>			
	</div>
	</div></br></br></br></br></br></br></br>
</body>
</html>

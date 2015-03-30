The schema is on the simple side for this. So with that in mind, be sure to add some 
additional complexity in your other queries. It would be best if you made sure you 
could delete items and relationships. As for your very large query, it will work, 
however we want to use prepared statements and it will be a real challenge to do this 
with a prepared statement. Instead of using INNER JOINS, you could use LEFT or RIGHT 
JOINS so that empty fields like roles are not added. For the WHERE conditions you 
could do something like "m.name OR ?" where the ? gets replaced with a boolean based 
on if a form was empty. So if the form is empty it is just treated as TRUE.


Create
-- Characters --
CREATE TABLE 275Character (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  health INT NOT NULL,
  mana INT NOT NULL,
  myid INT NOT NULL,
  pid INT NOT NULL,
  enemyid INT,
  PRIMARY KEY  (id),
  UNIQUE KEY (name),
  FOREIGN KEY (myid) REFERENCES 275Mythology (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pid) REFERENCES 275PhysicalApp (id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (enemyid) REFERENCES 275Character (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;

-- Mythology --
CREATE TABLE 275Mythology (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  origin VARCHAR(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY(name) 
)ENGINE=InnoDB;

-- Physical Appearance --
CREATE TABLE 275PhysicalApp (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  popularity VARCHAR(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY(name)
)ENGINE=InnoDB;

-- Roles --
CREATE TABLE 275Role (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  rangeType VARCHAR(255) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY(name)
)ENGINE=InnoDB;

-- Characters-Roles, Only Many to Many relationship table --
CREATE TABLE 275CharRole (
  cid INT NOT NULL,
  rid INT NOT NULL,
  PRIMARY KEY  (cid, rid),
  FOREIGN KEY (cid) REFERENCES 275Character (id) ON DELETE CASCADE ON UPDATE CASCADE, 
  FOREIGN KEY (rid) REFERENCES 275Role (id) ON DELETE CASCADE ON UPDATE CASCADE 
)ENGINE=InnoDB;


Add
--inserting rows to Mythology, Roles and PhysicalApp should be straight forward--
--I'm more concerned about adding rows to Characters--
--Do I need two separate Insert statement to update CharRole table as well?--
--Going to ask for roles when the user wants to add a row to Charcter Table--
INSERT INTO Characters VALUES (...);
INSERT INTO CharRole VALUES ((SELECT id from Characters WHERE name=""),(SELECT id from Roles WHERE name=""));


Select
--See characters of a certain role--
SELECT c.name, c.health, c.mana, c.speed, c.attSpeed, c.pProtection, c.mProtection FROM Characters c
INNER JOIN CharRole cr ON c.id = cr.cid
INNER JOIN roles r ON r.id = cr.rid
WHERE r.name = ''
GROUP BY c.name
ORDER BY c.name;

--See characters of a certain mythology--
SELECT c.name, c.health, c.mana, c.speed, c.attSpeed, c.pProtection, c.mProtection FROM Characters c
INNER JOIN Mythology m ON c.id = m.id
WHERE m.name = ''
GROUP BY c.name
ORDER BY c.name;

--See characters of a certain physical appearance--
SELECT c.name, c.health, c.mana, c.speed, c.attSpeed, c.pProtection, c.mProtection FROM Characters c
INNER JOIN physicalApp p ON c.id = p.id
WHERE p.name = ''
GROUP BY c.name
ORDER BY c.name;

--Select a Character and show its attributes, role, mythology, physical appearance--
SELECT c.name, c.health, c.mana, c.speed, c.attSpeed, c.pProtection, c.mProtection, r.name, m.name, p.name FROM Characters c
INNER JOIN CharRole cr ON c.id = cr.cid
INNER JOIN roles r ON r.id = cr.rid
INNER JOIN Mythology m ON c.id = m.id
INNER JOIN physicalApp p ON c.id = p.id
WHERE c.name = ''
GROUP BY c.name
ORDER BY c.name;

--Select from Characters of certain attribute, role, mythology, physical appearance--
SELECT c.name, c.health, c.mana, c.speed, c.attSpeed, c.pProtection, c.mProtection FROM Characters c
INNER JOIN CharRole cr ON c.id = cr.cid --not added if no input is entered in html field--
INNER JOIN roles r ON r.id = cr.rid --not added if no input is entered in html field--
INNER JOIN Mythology m ON c.id = m.id --not added if no input is entered in html field--
INNER JOIN physicalApp p ON c.id = p.id --not added if no input is entered in html field--
WHERE c.name = ''
AND c.health --not added if no input is entered in html field--
AND c.mana --not added if no input is entered in html field--
AND m.name --not added if no input is entered in html field--
AND p.name --not added if no input is entered in html field--
AND r.name --not added if no input is entered in html field--
GROUP BY c.name
ORDER BY c.name;
--Can this work? Should I break this up?--

Update
UPDATE FROM PhysicalApp SET name = "" WHERE name="" ;
UPDATE FROM Characters SET attSpeed = ?, mana=? WHERE name = "";
-- And so on, hoping I set foreign keys right so that delete or update will not mess up the other tables-- 


Delete
DELETE FROM Characters WHERE name = "";
-- And so on, hoping I set foreign keys right so that delete or update will not mess up the other tables-- 
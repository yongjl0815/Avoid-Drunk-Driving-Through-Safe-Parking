CREATE TABLE users (
id int AUTO_INCREMENT,
username VARCHAR(255),
password VARCHAR(255),
fname VARCHAR(255),
lname VARCHAR(255),
email VARCHAR(255),
PRIMARY KEY (id)
)ENGINE INNODB;

CREATE TABLE destinations(
id int AUTO_INCREMENT,
destination VARCHAR(255),
address VARCHAR(255),
instructions VARCHAR(255),
PRIMARY KEY (id)
)ENGINE INNODB

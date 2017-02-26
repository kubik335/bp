<?php

   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = 'eAqAsA5';
global $conn;   
   
try {
	$conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$drop = 'DROP DATABASE my_table;';
	$conn->exec($drop);
	
	$sql = 'CREATE DATABASE IF NOT EXISTS my_table;';
	$conn->exec($sql);
	
	echo "Database created successfully<br>";
    }
	
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

	$conn->query("use my_table");	
   
      $sql1 = 'CREATE TABLE IF NOT EXISTS account( 
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  login VARCHAR(30) NOT NULL,
      password VARCHAR(30) NOT NULL,
      email VARCHAR(50)NOT NULL,
	  enabled BOOLEAN,
	  role_id INTEGER NOT NULL
	  );';

    // use exec() because no results are returned
    $conn->exec($sql1);
    echo "Table sql1 created successfully";

$sql1_fill = 'INSERT INTO account(login,password,email,enabled,role_id) VALUES ("admin","admin","admin@admin.com",1,1);';	

    $conn->exec($sql1_fill);
    echo "Table sql1fill created successfully";
   
      $sql2 = 'CREATE TABLE IF NOT EXISTS role( 
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  role VARCHAR(30) NOT NULL
	  );';

    $conn->exec($sql2);
    echo "Table sql2 created successfully";
	
      $sql2_fill = 'INSERT INTO role(role) VALUES ("admin"),("zadavatel"),("resitel");';
	  
    $conn->exec($sql2_fill);
    echo "Table sql2fill created successfully";
   
      $sql3 = 'CREATE TABLE IF NOT EXISTS project( 
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  project_name VARCHAR(30) NOT NULL
	  );';

    $conn->exec($sql3);
    echo "Table sql3 created successfully";

 
?>
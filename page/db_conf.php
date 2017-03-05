<?php

$username = "root";
$password = "password";

try {
    $conn = new PDO('mysql:host=localhost;', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
	
	$sql = 'CREATE DATABASE IF NOT EXISTS sasa;';
	
	$conn->exec($sql);
	
	$conn->query("use sasa");	
	
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

	$sql1_fill = 'INSERT INTO account(login,password,email,enabled,role_id) VALUES ("admin","admin","admin@admin.com",1,1);';	

    $conn->exec($sql1_fill);
	
	$sql2 = 'CREATE TABLE IF NOT EXISTS role( 
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  role VARCHAR(30) NOT NULL
	  );';

    $conn->exec($sql2);
	
	$sql2_fill = 'INSERT INTO role(role) VALUES ("admin"),("zadavatel"),("resitel");';
	  
    $conn->exec($sql2_fill);
	
	$sql3 = 'CREATE TABLE IF NOT EXISTS project( 
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  project_name VARCHAR(30) NOT NULL
	  );';

    $conn->exec($sql3);
?>
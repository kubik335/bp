<?php

   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'new_db';
	global $conn;   
   
try {
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    }
	
	catch (PDOException $e)
{
	if ($e->errorInfo[1] == 1062) {
        echo "fail";
    }
}
	
?>
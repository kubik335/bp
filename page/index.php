<?php
session_start();
require('check.php');
if ($_SESSION['role'] == 'admin'){
	
	header("location:admin.php");
	
} else if($_SESSION['role'] == 'zadavatel'){
	
header("location:zadavatel.php");
} else if($_SESSION['role'] == 'řešitel'){
	
header("location:resitel.php");
}
;
?>
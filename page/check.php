<?php
if(!$_SESSION['status'] == "logged") {
	header("location: login.php");
}
?>
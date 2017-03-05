<?php session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$login = $_POST['login'];
	$password = $_POST['password'];
	
		$query = 'SELECT * from account join role on account.role_id=role.id where login= ? and password= ? and enabled=1';
	
	$result = $conn->prepare($query);
	$result->execute(array($login, $password));
	$numberOfRows = $result->rowCount();
	$result = $result->fetch();
	

	if ($numberOfRows == 1) {
		$_SESSION['user'] = $login;
		$_SESSION['status'] = "logged";
		$_SESSION['role'] = $result['role'];
header('location: index.php');

	}
	else {
		$error = "Your Login Name or Password is invalid";
		echo "<script type='text/javascript'>alert('$error');</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login to application</title>
<link rel="stylesheet" href="login.css" type="text/css">
<link rel="icon" href="favicon.png" type="image/png" sizes="16x16"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function validateForm() {
    var x = document.forms["form"]["login"].value;
	var y = document.forms["form"]["password"].value;
    var login = document.getElementsByName("login")[0];
	var password = document.getElementsByName("password")[0];
	login.className = "";
		login.id = "";
		password.className = "";
		password.id = "";
	if  (x == "" && y == "") {
		login.className = "form-control has-error";
		login.id = "inputError";
		password.className = "form-control has-error";
		password.id = "inputError";
		alert("You did not fill any credentials");
        return false;
	}
	else {
	if (x == "" && y != "") {
		login.className = "form-control has-error";
		login.id = "inputError";
		alert("Username must be filled out");
        return false;
    }
	
	else if (y == "" && x != "") {

		password.className = "form-control has-error";
		password.id = "inputError";
        alert("Password must be filled out");
        return false;
    }
	}
	
}
</script>

</head>
<body>
<div id="loginPage">
<div id="loginForm">
<form name="form" method="POST" onsubmit="return validateForm()">
<h2>Login to application</h2>
 <div class="form-group has-error has-feedback">
<input type="text" name="login" placeholder="username">
<input type="password" name="password" placeholder="password">
</div>
<button type="submit">Submit</button>
</form>
</div>
</div>
</body>
</html>
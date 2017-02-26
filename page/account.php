<?php
require('db.php');
global $id;
/** 
Methoda GET: 
	1) pro zobrazeni cele tabulky
	2)pro vyhledavani zaznamu podle loginu

*/

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
	if(isset($_REQUEST["loginSearch"])) {
	$login = $_REQUEST["loginSearch"];
	$data = array();

	$query = 'SELECT account.id as account_id, login, password, email, role, role_id, enabled from account join role on account.role_id=role.id where account.login=?';
	
	$stmt = $conn->prepare($query);
	$stmt->execute(array($login));
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$resultArray['id'] = $row['account_id'];
		$resultArray['login'] = $row['login'];
		$resultArray['password'] = $row['password'];
		$resultArray['email'] = $row['email'];
		$resultArray['role'] = $row['role'];
		$resultArray['role_id'] = $row['role_id'];
		$resultArray['enabled'] = $row['enabled'];
		array_push($data,$resultArray);
	}

	echo json_encode($data);
	} else {	
	$data = array();
	$query = 'SELECT account.id as account_id, login, password, email, role, role_id, enabled from account join role on account.role_id=role.id;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($id));
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$resultArray['id'] = $row['account_id'];
		$resultArray['login'] = $row['login'];
		$resultArray['password'] = $row['password'];
		$resultArray['email'] = $row['email'];
		$resultArray['role'] = $row['role'];
		$resultArray['role_id'] = $row['role_id'];
		$resultArray['enabled'] = $row['enabled'];
		array_push($data,$resultArray);
	}

		echo json_encode($data);
	} 

}	
/** 
Methoda POST: 

	1)pro update zaznamu (vyhledavani podle id)
	2) make disable (enable=0) zaznam v db (podle id)
	3) set enable (enable=1) zaznam v db (podle id)
	4)pro vytvareni noveho zaznamu v tabulce

*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
	if (isset($_REQUEST["update"])){

			$id = $_REQUEST["update"];
			$login = $_REQUEST["login"];
			$password = $_REQUEST["password"];
			$email = $_REQUEST["email"];
			$role = $_REQUEST["role"];
			var_dump($role);	
	$query = 'UPDATE account SET login=?, password=?, email=?, role_id=? WHERE account.id = ?;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($login, $password, $email, $role, $id));
			
		
	}
	else if (isset($_REQUEST["disable"])) {
		
	$id = $_REQUEST["disable"];
	$query = 'UPDATE account SET enabled=0 WHERE account.id = ?;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($id));
		
	}
	
	else if (isset($_REQUEST["enable"])) {
		
	$id = $_REQUEST["enable"];
	$query = 'UPDATE account SET enabled=1 WHERE account.id = ?;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($id));
		
	} else {
		
	$login = $_REQUEST["login"];
	$password = $_REQUEST["password"];
	$email = $_REQUEST["email"];
	$role = $_REQUEST["role"];
	$query = 'INSERT INTO account (login, password, email, enabled, role_id, ) VALUES (?, ?, ?, 1, ?);';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($login, $password, $email, $role));	
	}


}
?>
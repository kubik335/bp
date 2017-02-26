<?php
require('db.php');
// mehtoda GET pro select 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
		
	$data = array();
	$query = 'SELECT * from project';	
	$stmt = $conn->prepare($query);
	$stmt->execute();
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$resultArray['id'] = $row['id'];
		$resultArray['project_name'] = $row['project_name'];
		array_push($data,$resultArray);
}

	echo json_encode($data);
	
	}
// mehtoda POST pro update, delete, creat
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		

	if (isset($_REQUEST["update"])){

	$id = $_REQUEST["update"];
	$project_name = $_REQUEST["project_name"];
	$query = 'UPDATE project SET project_name=?  WHERE project.id = ?;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($project_name, $id));
			
	}
	else if (isset($_REQUEST["delete"])){

	$id = $_REQUEST["delete"];
	$query = 'DELETE FROM project WHERE id=?;';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($id));	
		

	} else {
	$project_name = $_REQUEST["project_name"];
	$query = 'INSERT INTO project (project_name) VALUES (?);';
	$stmt = $conn->prepare($query);
	$stmt->execute(array($project_name));
	}

}
?>
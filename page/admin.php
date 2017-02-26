<?php
session_start();
require('check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Role | Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Alexandra Kolpakova">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="icon" href="favicon.png" type="image/png" sizes="16x16"/>
  <link rel="stylesheet" href="style.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="script.js" type="text/javascript"></script>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Available modules</h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="#accounts" onclick="showAccounts()" >Accounts</a></li>
        <li><a href="#projects" onclick="showProjects()" >Projects</a></li>
		<li><a href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="col-sm-9">
	<div class="accounts" style="display:none">
      <h2>Accounts</h2>
      <h5>Module for adding, editing available accounts in the system.</h5>
	  <button type="button" class="btn btn-default" id="crtBtn" onclick=$('#createAccountModal').modal('show');>Create new account</button>
	  <div id="account_content"></div>
	  <div class="container" id="container">
	  
		<div class="modal fade" id="createAccountModal" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Fill in the fields to create new account</h4>
		</div>
		<div class="modal-body">
		<label>Login</label>
		<div><input id="login" type="text" name="login" placeholder="login"></div>
		<label>Password</label>
		<div><input id="password" type="password" name="password" placeholder="password"></div>
		<label>Email</label>
		<div><input id="email" type="text" name="email" placeholder="email"></div>
		<label>Role</label>
		<div><select id='role' type='text' name='role_id' placeholder='role'>
		<option value="1">admin</option>
		<option value="2">zadavatel</option>
		<option value="3">řešitel</option>
		</select></div>
		</div>
		<div class="modal-footer">
		<button id="createAccountConfirm" type="submit" class="btn btn-default" onclick="validateCreateAccounts()" >Create</button>
		<button type="button" class="btn btn-default" id="createAccountClose" onclick="createAccountClose">Close</button>
		</div>
		</div>
		</div>
		</div>
	  
	<div class='modal fade' id='updateAccountModal' role='dialog'>
	<div class='modal-dialog'>
	<div class='modal-content'>
	<div class='modal-header'>
	<button type='button' class='close' data-dismiss='modal'>&times;</button>
	<h4 class='modal-title'>Update Account</h4>
	</div>
	<div class='modal-body'>
	<div><label>Login</label></div>
	<input id='up_login' type='text' name='login' placeholder='login' value=''>
	<div><label>Password</label></div>
	<input id='up_password' type='password' name='password' placeholder='password' value=''>
	<div><label>Email</label></div>
	<input id='up_email' type='text' name='email' placeholder='email' value=''>
	<div><label>Role</label></div>
	<select id='up_role' type='text' name='role_id' placeholder='role' >
	<option value="1">admin</option>
    <option value="2">zadavatel</option>
    <option value="3">řešitel</option>
	</select>
	</div>
	<div class='modal-footer'>
	<button class='btn btn-default' type='submit' id="updateAccountConfirm">Update</button>
	<button type='button' class='btn btn-default' id="updateAccountClose">Close</button>
	</div>
	</div>
	</div>
	</div>
	
	<div class='modal fade' id='detailAccountModal' role='dialog'>
	<div class='modal-dialog'>
	<div class='modal-content'>
	<div class='modal-header'>
	<button type='button' class='close' data-dismiss='modal'>&times;</button>
	<h4 class='modal-title'>Account's detail</h4>
	</div>
	<div class='modal-body'>
	<input id='det_login' type='text' name='login' placeholder='login' disabled>
	<input id='det_password' type='password' name='password' placeholder='password' disabled>
	<input id='det_email' type='text' name='email' placeholder='email' disabled>
	<input id='det_role' type='text' name='role' placeholder='role' disabled>
	</div>
	<div class='modal-footer'>
	<button type='button' class='btn btn-default' id="detailAccountClose">Close</button>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>

	<div class="projects" style="display:none">
    <h2>Projects</h2>
    <h5>Module for adding, editing and deleting available projects in the system.</h5> 
	<button type="button" class="btn btn-default" id="crtBtn" onclick=$('#createProjectModal').modal('show');>Create new project</button>
	<div id="project_content"></div>
	<div class="container" id="container">

	  
	<div class='modal fade' id='createProjectModal' role='dialog'>
	<div class='modal-dialog'>
	<div class='modal-content'>
	<div class='modal-header'>
	<button type='button' class='close' data-dismiss='modal'>&times;</button>
	<h4 class='modal-title'>Create Project</h4>
	</div>
	<div class='modal-body'>
	<input id='project_name' type='text' name='project_name' placeholder='Project name' value=''>
	</div>
	<div class='modal-footer'>
	<button class='btn btn-default' type='submit' id="createProjectConfirm" onclick="validateCreateProjects()">Create project</button>
	<button type='button' class='btn btn-default' id="createProjectClose">Close</button>
	</div>
	</div>
	</div>
	</div>

	<div class='modal fade' id='updateProjectModal' role='dialog'>
	<div class='modal-dialog'>
	<div class='modal-content'>
	<div class='modal-header'>
	<button type='button' class='close' data-dismiss='modal'>&times;</button>
	<h4 class='modal-title'>Update Project</h4>
	</div>
	<div class='modal-body'>
	<input id='update_project_name' type='text' name='project_name' placeholder='Project name' value=''>
	</div>
	<div class='modal-footer'>
	<button class='btn btn-default' type='submit' id="updateProjectConfirm">Update project</button>
	<button type='button' class='btn btn-default' id="updateProjectClose">Close</button>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
    </div>
	</div>
	</div>

<footer class="container-fluid">
<p>Created By Alexandra Kolpakova, 2017</p>
</footer>
</body>
</html>
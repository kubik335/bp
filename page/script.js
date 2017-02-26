/**
Fce showAccounts() zobrazuje tabulku s accounty pro uzivatele = admin
*/  function showAccounts() {
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		document.getElementsByClassName("projects")[0].style.display = "none";
		document.getElementsByClassName("accounts")[0].style.display = "block";
		var text = this.responseText;
        var obj = $.parseJSON(text);
		var out = searchField();
		out += "<table class='table table-hover table-bordered'>";
		out += createAccountTableHeaders();
		out += "<tbody>"; 
		
		$.each(obj, function(key,value) {
			var id = obj[key].id;
			var login = obj[key].login;
			var password = obj[key].password;
			var email = obj[key].email;
			var role = obj[key].role;
			var enabled = obj[key].enabled;
			
			if (enabled==1) {	out += "<tr>";	}
			else {	out += "<tr class='disabled'>";}
            out += "<td>"+login+"</td>";
            out += "<td>"+password+"</td>";
            out += "<td>"+email+"</td>";
            out += "<td>"+role+"</td>";
			out += "<td><button class='btn btn-default' id='updBtn' type='submit' onclick=showUpdateAccountForm('"+id+"','"+login+"','"+password+"','"+email+"','"+role+"');>Update</button>";
			out += "<button class='btn btn-default' data-toggle='modal' data-target='#showDetailModal' id='detail' type='submit' value='detail' onclick=showDetail('"+id+"','"+login+"','"+password+"','"+email+"','"+role+"')>Detail</button>";

			if (enabled==1) { out += "<button class='btn btn-default' id='disable' type='submit' onclick=disable('"+id+"')>Disable</button></td>";}
			else {out += "<button class='btn btn-default' id='enable' type='submit' onclick=enable('"+id+"')>Enable</button></td>";}
            out += "</tr>";
			})
					out += "</tbody>";
					out += "</table>";
					document.getElementById("account_content").innerHTML = out;
		}
	};
	xhttp.open("GET", "account.php", true);
	xhttp.send();
	}
/**
Fce showProjects() zobrazuje tabulku s projekty pro uzivatele = admin
*/	
	function showProjects() {
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		document.getElementsByClassName("accounts")[0].style.display = "none";
		document.getElementsByClassName("projects")[0].style.display = "block";
		var text = this.responseText;

        var obj = $.parseJSON(text);
		var out = "";
		out += "<table class='table table-hover table-bordered'>";
		out += createProjectTableHeaders();
		out += "<tbody>"; 
		$.each(obj, function(key,value) {
			var id = obj[key].id;
			var project_name = obj[key].project_name;

			out += "<tr>";
	
            out += "<td>"+project_name+"</td>";
			out += "<td><button class='btn btn-default' id='updBtn' type='submit' onclick=showUpdateProjectForm('"+id+"','"+project_name+"');>Update</button>";
			out += "<button class='btn btn-default' type='submit' value='detail' onclick=deleteProject('"+id+"')>Delete</button>";
            out += "</tr>";

			})
					out += "</tbody>";
					out += "</table>";
					document.getElementById("project_content").innerHTML = out;
		}
	};
	xhttp.open("GET", "project.php", true);
	xhttp.send();
	
	
}
/**
Fce createAccountTableHeaders() vytvari hlavicku tabulky Accounts
*/	
	function createAccountTableHeaders() {
		var headers = "<thead>";
			headers += "<tr>";
			headers += "<th>Login</th>";
            headers += "<th>Password</th>";
            headers += "<th>Email</th>";
            headers += "<th>Role</th>";
			headers += "<th>Actions</th>";
			headers += "</tr>";
			headers += "</thead>";
			return headers;
	}
	
/**
Fce createProjectTableHeaders() vytvari hlavicku tabulky Projects
*/	
	
	function createProjectTableHeaders() {
		var headers = "<thead>";
			headers += "<tr>";
			headers += "<th>Project name</th>";
			headers += "<th>Actions</th>";
			headers += "</tr>";
			headers += "</thead>";
			return headers;
	}
	
/**
Fce createAccount() vytvari novy account.
Methoda POST zasila promenne do account.php -> pak zobrazena tabulka s ucty
*/	
	
	function createAccount() {

	var login = document.getElementById("login").value;
	var password = document.getElementById("password").value;
	var email = document.getElementById("email").value;
	var role = document.getElementById("role").value;
	

	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		showAccounts();
		}
	}
	xhttp.open("POST", "account.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("login="+login+"&password="+password+"&email="+email+"&role="+role);
	
	}

/**
Fce createProject() vytvari novy projekt.
Methoda POST zasila promenne do project.php -> pak zobrazena tabulka s projekty
*/		
	
	function createProject() {
	var project_name = document.getElementById("project_name").value;
		
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		showProjects();
		}
	}
	xhttp.open("POST", "project.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("project_name="+project_name);
	}
	
/**
Fce searchData() vyhledava zaznam o uctu podle Login name v tabulce Accounts.
Methoda GET zasila promenne do accounts.php -> vraceny text je umisten do jednotlivych bunek tabulky
*/	

	function searchData() {
	var LOGIN = document.getElementById("loginSearch").value;		
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		var text = this.responseText;

        var obj = $.parseJSON(text);
		var out = searchField();
		out += "</br>";
		out += "<table class='table table-hover table-bordered'>";
		out += createAccountTableHeaders();
		out += "<tbody>";
		
		$.each(obj, function(key,value) {
			
			var id = obj[key].id;
			var login = obj[key].login;
			var password = obj[key].password;
			var email = obj[key].email;
			var role = obj[key].role;
			var role_id = obj[key].role_id;
			var enabled = obj[key].enabled;
			if (enabled==1) { out += "<tr>";}
			else { out += "<tr class='disabled'>";}
            out += "<td>"+login+"</td>";
            out += "<td>"+password+"</td>";
            out += "<td>"+email+"</td>";
            out += "<td>"+role+"</td>";
			out += "<td><button class='btn btn-default' id='updBtn' type='submit' onclick=showUpdateAccountForm('"+id+"','"+login+"','"+password+"','"+email+"','"+role+"');>Update</button>";
			out += "<button class='btn btn-default' data-toggle='modal' data-target='#showDetailModal' id='detail' type='submit' value='detail' onclick=showDetail('"+id+"','"+login+"','"+password+"','"+email+"','"+role+"')>Detail</button>";
			if (enabled==1) { out += "<button class='btn btn-default' id='disable' type='submit' onclick=disable('"+id+"')>Disable</button></td>";}
			else { out += "<button class='btn btn-default' id='enable' type='submit' onclick=enable('"+id+"')>Enable</button></td>";}
			out += "</tr>";	})
			out += "</tbody>";
			out += "</table>";
			document.getElementById("account_content").innerHTML = out;
		}
	};
	xhttp.open("GET", "account.php?loginSearch="+LOGIN, true);
	xhttp.send();
	}

	
/**
Fce deleteProject() vyhledava zaznam o uctu podle id tabulce Projects.
Methoda POST zasila promenne do projects.php -> reload tabulky Projects na strance
*/		
	function deleteProject(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {	
		showProjects();
		}
	};
	xhttp.open("POST", "project.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("delete="+id);
	}
	
/**
Fce updateDataAccount() vyhledava zaznam o uctu podle id a pak ho edituje a uklada 
Methoda POST zasila promenne do accounts.php -> reload tabulky Accounts na strance
*/	
	
	function updateDataAccount(id) {
		var login = document.getElementById('up_login').value;
		var password = document.getElementById('up_password').value;
		var email = document.getElementById('up_email').value;
		var role = document.getElementById('up_role').value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			showAccounts();
		}
	};
	xhttp.open("POST", "account.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("update="+id+"&login="+login+"&password="+password+"&email="+email+"&role="+role);
	}

/**
Fce updateDataProject() vyhledava zaznam o projektu podle id a pak ho edituje a uklada 
Methoda POST zasila promenne do projects.php -> reload tabulky Projects na strance
*/	
	
	function updateDataProject(id) {
		var project_name = document.getElementById('update_project_name').value;	
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			showProjects();
		}
	};
	xhttp.open("POST", "project.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("update="+id+"&project_name="+project_name);
	}
	
/**
Fce showUpdateAccountForm() zobrazuje modal pro Update zaznamu v tabulce Accounts
*/	
	
	function showUpdateAccountForm(id, login, password, email, role_id) {
	$('#updateAccountModal').modal('show');
	document.getElementById('up_login').value = login;
	document.getElementById('up_password').value = password;
	document.getElementById('up_email').value = email;
	document.getElementById('updateAccountConfirm').onclick = function() { validateUpdateAccounts(id);};
	}
	
/**
Fce showUpdateProjectForm() zobrazuje modal pro Update zaznamu v tabulce Projects
*/	
	
	function showUpdateProjectForm(id, project_name) {
	$('#updateProjectModal').modal('show');
	document.getElementById('update_project_name').value = project_name;
	document.getElementById('updateProjectConfirm').onclick = function() { validateUpdateProjects(id); };
	}
	
/**
Fce showDetail() zobrazuje modal s udaje o uctu 
*/		
	
	function showDetail(id, login, password, email, role) {
	$('#detailAccountModal').modal('show');
	document.getElementById('det_login').value = login;
	document.getElementById('det_password').value = password;
	document.getElementById('det_email').value = email;
	document.getElementById('det_role').value = role;
	}
	
/**
Fce searchField() vytvari pole pro vyhledavani uctu v tabulce
*/
	
	function searchField() {
	var search = '';
	search += "<label>Search in table Accounts by login name </label>";
    search += "<input id='loginSearch' type='text' name='loginSearch' class='form-control' placeholder='login'>";
	search += "<button class='btn btn-default' id='GET' type='submit' value='GET' onclick='searchData()'>Search</button>";
	return search;
	}

/**
Fce enable() pomoci methody POST stanove hodnotu enable == 1 pro ucet v tabulce
*/
	
	function enable(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {		
		showAccounts();
		}
	};
	xhttp.open("POST", "account.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("enable="+id);
	}
	
/**
Fce enable() pomoci methody POST stanove hodnotu enable == 0 pro ucet v tabulce
*/	
	
	function disable(id) {
		
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
		showAccounts();
		}
	};
	xhttp.open("POST", "account.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("disable="+id);
	}
	
function validateCreateAccounts() {
	var error;

    var login = document.getElementById('login');
	var password = document.getElementById('password');
	var email = document.getElementById('email');
	var role = document.getElementById('role');
	
	if(login.value == ""){

		login.className = "has-error";
		error = true;
	}
	if(password.value == ""){
		password.className = "has-error";
		error = true;
}
	if(!validateEmail(email.value)){
		email.className = "has-error";
		error = true;
}

	if (error == true) {
		window.alert("You missed something");
	}
	else {
		createAccount();
		createAccountClose();
		$("#createAccountModal").modal("hide");
	}

}

function validateUpdateAccounts(id) {
	var error;
    var login = document.getElementById('up_login');
	var password = document.getElementById('up_password');
	var email = document.getElementById('up_email');
	var role = document.getElementById('up_role');
	
	if(login.value == ""){

		login.className = "has-error";
		error = true;
	}
	if(password.value == ""){
		password.className = "has-error";
		error = true;
}
	if(!validateEmail(email.value)){
		email.className = "has-error";
		error = true;
}

	if (error == true) {
		window.alert("You missed something");
	}
	else {
		updateDataAccount(id);
		updateAccountClose();
		$("#updateAccountModal").modal("hide");
	}

}

/**
Testovani hodnoty zadanou pro email regularnim vyrazem. Vraci true|false;
*/

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function createAccountClose() {
		document.getElementById('login').value = "";
		document.getElementById('password').value = "";
		document.getElementById('email').value = "";
		document.getElementById('login').className = "";
		document.getElementById('password').className = "";
		document.getElementById('email').className = "";
	
}

function updateAccountClose() {
		document.getElementById('up_login').value = "";
		document.getElementById('up_password').value = "";
		document.getElementById('up_email').value = "";
		document.getElementById('up_login').className = "";
		document.getElementById('up_password').className = "";
		document.getElementById('up_email').className = "";
	

	}
	
	function createProjectClose() {
		document.getElementById('project_name').value = "";
		document.getElementById('project_name').className = "";

}
	function updateProjectClose() {
		document.getElementById('update_project_name').value = "";
		document.getElementById('update_project_name').className = "";
	
}

function validateCreateProjects() {
	var error;
    var project_name = document.getElementById('project_name');

	if(project_name.value == ""){
		project_name.className = "has-error";
		error = true;
	}
	if (error == true) {
		window.alert("You missed something");
	}
	else {
		createProject();
		createProjectClose();
		$("#createProjectModal").modal("hide");
	}

}

function validateUpdateProjects(id) {
	var error;
    var project_name = document.getElementById('update_project_name');

	if(project_name.value == ""){

		project_name.className = "has-error";
		error = true;
	}
	if (error == true) {
		window.alert("You missed something");
	}
	else {
		updateDataProject(id);
		updateProjectClose();
		$("#updateProjectModal").modal("hide");
	}

}

$(document).ready(function(){

   $("#createAccountClose").click(function(){
	   createAccountClose();
        $("#createAccountModal").modal("hide");
    });
	   $("#updateAccountClose").click(function(){
		   updateAccountClose();
        $("#updateAccountModal").modal("hide");
    });
	$("#detailAccountClose").click(function(){
        $("#detailAccountModal").modal("hide");
    });
	   $("#createProjectClose").click(function(){
		   createProjectClose();
        $("#createProjectModal").modal("hide");
    });
	   $("#updateProjectClose").click(function(){
		   updateProjectClose();
        $("#updateProjectModal").modal("hide");
    });
	});


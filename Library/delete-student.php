<!-- 
	Sahil Patel
	This is the file that will delete students after the admin clicks delete and it will ask for permission to confirm deleting after pressing delete icon
	CSCE 3444 - Professor Okafor
  -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | DELETE STUDENT</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
	<!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
	
</head>

<?php
	session_start(); //creates a session or resumes the current one based on a session identifier
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' ) { //checks if session variable have user_id and role equal admin
	   header('Location: login.php'); //If above is false then redirect to login page 
	}
	require_once("db-connection.php"); // include db connection helper in this php file
?>

<body>
	<div class="bg2">
		<div class="wrapper">
			<!-- Sidebar  -->
			<nav id="sidebar">
				<div class="sidebar-header">
					<h3></h3>
				</div>
				<ul class="list-unstyled components">
					<li>
						<a href="admin-panel.php"><h4>DASHBOARD</h4></a>
					</li>
					<li class="active">
						<a href="#studentMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><h4>STUDENT</h4></a>
						<ul class="collapse list-unstyled" id="studentMenu">
							<li>
								<a href="add-student.php"><h6>ADD</h6></a>
							</li>
							<li>
								<a href="update-student.php"><h6>UPDATE</h6></a>
							</li>
							<li>
								<a href="#"><h6>DELETE</h6></a>
							</li>
						</ul>
					</li>
					<li class="active">
						<a href="#bookMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><h4>BOOK</h4></a>
						<ul class="collapse list-unstyled" id="bookMenu">
							<li>
								<a href="add-book.php"><h6>ADD</h6></a>
							</li>
							<li>
								<a href="update-book.php"><h6>UPDATE</h6></a>
							</li>
							<li>
								<a href="delete-book.php"><h6>DELETE</h6></a>
							</li>
							<li>
								<a href="borrowed-list.php"><h6>BORROWED</h6></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="logout.php"><h4>LOGOUT</h4></a>
					</li>
				</ul>					 
			</nav>

			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				 <div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Do you want to delete?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" onclick="deleteConfirmed()" data-dismiss="modal" class="btn btn-primary">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Page Content  -->
			<div id="content">
				<nav class="navbar navbar-expand-lg navbar-light bg-light" >
					<div class="container-fluid">
						<button type="button" id="sidebarCollapse" class="btn btn-info" >
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="navbar-header" >
							<a class="navbar-brand text-center" href="#">UNT LIBRARY</a>
						</div>
					</div>
				</nav>
				<div class="row">
					<div class="col-md-12 mr-auto ml-auto">
						<div class="card text-center" style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header">
								<h5>DELETE STUDENT</h5>
							</div>
							<div class="card-body" >
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to delete Student!
								</div>
								<div id="successAlert" class="alert alert-success alert-dismissible collapse">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Successfully deleted Student!
								</div>
								
								<form id= "searchForm" method="post" class="needs-validation" novalidate="">
									<div class="row">
									  <div class="col-md-5 mb-3 mr-auto ml-auto">
										<input type="text" class="form-control" name="searchValue" placeholder="Search Value" value="" required="">
										<div class="invalid-feedback">
										  Search Value is required.
										</div>
									  </div>
									  <div class="col-md-3 mb-3 mr-auto ml-auto">
										<select class="custom-select d-block w-100" name="searchBy" required="">
										  <option value="">Search By...</option>
										  <option>Student ID</option>
										  <option>Last Name</option>
										</select>
										<div class="invalid-feedback">
										  Please provide a valid Search By.
										</div>
									  </div>
									  
									  <div class="col-md-3 mb-3 mr-auto ml-auto">
										<button id="searchbtn" class="btn-primary form-control" type="button">SEARCH</button>
									  </div>
									</div>
								</form>
											  
								<table style="display:none" id="searchTable" class="table table-responsive-sm table-bordered">
								  <thead>
									<tr>
									  <th scope="col">ID</th>
									  <th scope="col">First Name</th>
									  <th scope="col">Last Name</th>
									  <th scope="col">Phone Number</th>
									  <th scope="col">Action</th>
									</tr>
								  </thead>
								  <tbody>
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="page-footer" style=" background-color: rgba(245, 245, 245, 0.5); ">
		  <div class="footer-copyright text-center py-4"><h6>Contact : abc@gmail.com &nbsp;&nbsp; Phone : 999100011</h6></div>
		</footer>		
	</div>
	
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		var $deleteRow;
		var $deleteID;
		//this method is used add new row in searchTable table
		function addtoTable(id, firstName, lastName, phoneNumber) {
			$("#searchTable").show();
			// new row created 
			var markup = "<tr><td class=\"studentID\">" + id + "</td><td>" + firstName + "</td><td>" + lastName + "</td><td>" + phoneNumber + "</td><td><button class=\"action-button\" type=\"button\" data-toggle=\"modal\" data-target=\"#exampleModal\"  ><img src=\"./image/delete.png\" width=\"20\" height=\"20\"></button></td></tr>";
			$("table tbody").append(markup); // new row appended 
		}
		
		function deleteConfirmed() { //fires on delete confirm popup ok clicked	
			$.ajax({ //ajax post request
				type : "post",
				url : "delete.php", // post url
				data : "studentID=" + $deleteID,
				success : function(msg) {
					if ( msg.indexOf("SUCCESS") >= 0) { // success callback
						$deleteRow.remove();
						var tbody = $("#searchTable tbody");
						if (tbody.children().length == 0) { // table have row count 0
							$("#searchTable").hide(); // hide table 
						}
						$("#successAlert").show();	 //show success alert					
					} else {
						$("#failAlert").show();  //show fail alert	
					}
				}
			});
		
		}

		(function() {
			'use strict';
			window.addEventListener('load', function() {
				//get table body using jquery
				var tbody = $("#searchTable tbody");

				if (tbody.children().length == 0) {
					$("#searchTable").hide();
				}
				
				$(".action-button").click(function() { //table row action button click listner
					$deleteRow = $(this).closest('tr');
					$deleteID = $deleteRow.find(".studentID").text(); //gets student ID from the clicked row 
				});
				
				var form = document.getElementById('searchForm');
				var button = document.getElementById('searchbtn');
				// Loop over them and prevent submission
				button.addEventListener('click', function(event) { //button click event listner
					if (form.checkValidity() === false) { //checks if form is valid
						event.preventDefault(); // if not valid then prevent to submit
						event.stopPropagation();
						form.classList.add('was-validated');
					} else{
						form.submit(); //if valid then form submit
					} 
				}, false);
			}, false);
		})();

		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () { //sidebar collapse button event listner
                $('#sidebar').toggleClass('active'); // sidebar div class value toggle
            });
        });
    </script>
	
	<?php   
		if($_POST){  
			$searchValue = $_POST['searchValue']; 
			$searchBy = $_POST['searchBy'];				
			
			$sql ="";
			
			if($searchBy == 'Last Name') { //if searchBy Last Name
				$sql ="SELECT * FROM `users` WHERE last_name LIKE '%$searchValue%' and role = 'student'";
			} else if($searchBy == 'Student ID') {  //if searchBy Student ID
				$sql ="SELECT * FROM `users` WHERE user_id LIKE '%$searchValue%' and role = 'student'";
			}
			
			$result = $conn->query($sql); // execute query 
			if ($result->num_rows > 0) { //if result row gt than 0
				while($row = $result->fetch_assoc()) {
					// get user_id, last_name, first_name, phone_number from row
					$user_id = $row["user_id"];
					$last_name = $row["last_name"];
					$first_name = $row["first_name"];
					$phone_number = $row["phone_number"];
					// add user_id, last_name, first_name, phone_number in html table row
					echo "<script>  addtoTable('$user_id', '$first_name', '$last_name', '$phone_number'); </script>" ;
				}
			} 
		}  
	?> 

</body>

</html>

<!--
Santosh Pradhan
CSCE 3444
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | UPDATE
STUDENT</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
	<!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
	
</head>

<?php
	session_start();
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' ) {
	   header('Location: login.php');
	}
	require_once("db-connection.php");
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
								<a href="#"><h6>UPDATE</h6></a>
							</li>
							<li>
								<a href="delete-student.php"><h6>DELETE</h6></a>
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
							   <h5>UPDATE STUDENT</h5>
							</div>
							<div class="card-body" >
								<form id= "searchForm" method="post" class="needs-validation" novalidate="">
									<div class="row">
									  <div class="col-md-4 mb-3 mr-auto ml-auto">
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
		  <div class="footer-copyright text-center py-4"><h6>Email : sahilpatel@gmail.com &nbsp;&nbsp; Phone : +1 (912) 384 - 1234 &nbsp;&nbsp; Address : 1234 Belt Line road, Dallas, TX, 75250  </h6></div>
		</footer>		
	</div>
	
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		function addtoTable(id, firstName, lastName, phoneNumber) {
			$("#searchTable").show();
			var markup = "<tr><td class=\"studentID\">" + id + "</td><td>" + firstName + "</td><td>" + lastName + "</td><td>" + phoneNumber + "</td><td><button class=\"action-button\" type=\"button\"><img src=\"./image/edit.png\" width=\"20\" height=\"20\"></button></td></tr>";
			$("table tbody").append(markup);
		}
	 
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var tbody = $("#searchTable tbody");

				if (tbody.children().length == 0) {
					$("#searchTable").hide();
				}
				
				$(".action-button").click(function() {
					var $row = $(this).closest('tr')
					var $studentID = $row.find(".studentID").text();
					
					document.location.href = "add-student.php?studentID=" + $studentID;    	    
				});
				var form = document.getElementById('searchForm');
				var button = document.getElementById('searchbtn');
				// Loop over them and prevent submission
				button.addEventListener('click', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
						form.classList.add('was-validated');
					} else{
						form.submit();
					} 
				}, false);
			}, false);
		})();

		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
	
	<?php   
		if($_POST){  
			$searchValue = $_POST['searchValue']; 
			$searchBy = $_POST['searchBy'];				
			
			$sql ="";
			
			if($searchBy == 'Last Name') {
				$sql ="SELECT * FROM `users` WHERE last_name LIKE '%$searchValue%' and role = 'student'";
			} else if($searchBy == 'Student ID') {
				$sql ="SELECT * FROM `users` WHERE user_id LIKE '%$searchValue%' and role = 'student'";
			}
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$user_id = $row["user_id"];
					$last_name = $row["last_name"];
					$first_name = $row["first_name"];
					$phone_number = $row["phone_number"];
					
					echo "<script>  addtoTable('$user_id', '$first_name', '$last_name', '$phone_number'); </script>" ;
				}
			} 
		}  
	?> 
</body>

</html>

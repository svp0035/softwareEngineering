<!--
Sunder Krishna upreti
This file will add students to the database
-->


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | STUDENT FORM</title>

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
								<a href="#"><h6>ADD</h6></a>
							</li>
							<li>
								<a href="update-student.php"><h6>UPDATE</h6></a>
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
					<div class="col-md-8 mr-auto ml-auto">
						<div class="card" style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header text-center">
							   <h5>STUDENT FORM</h5>
							</div>
							<div class="card-body" >
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to register new user!
								</div>
								<div id="successAlert" class="alert alert-success alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Successfully register new user!
								</div>
								<form id="mainForm" method="post" action="add-student.php" class="needs-validation"  novalidate="" >
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Student ID</label>
										<div class="input-group">
											<input type="text" class="form-control" name="studentID" placeholder="Student ID" value="" required="">
											<div class="invalid-feedback">
											  Valid Student ID is required.
											</div>
										</div>
									  </div>
									  <div class="col-md-6 mb-3">
										<label for="branchName">First Name</label>
										<div class="input-group">
											<input type="text" class="form-control" name="firstName" placeholder="First Name" value="" required="">
											<div class="invalid-feedback">
											  Valid First Name is required.
											</div>
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Email Address</label>
										<div class="input-group">
											<input type="email" class="form-control" name="email" placeholder="example@domain.xyz" value="" required="">
											<div class="invalid-feedback">
											  Valid Email Address is required.
											</div>
										</div>
									  </div>
									  <div class="col-md-6 mb-3">
										<label>Last Name</label>
										<div class="input-group">
											<input type="text" class="form-control" name="lastName" placeholder="Last Name" value="" required="">
											<div class="invalid-feedback">
											  Valid Last Name is required.
											</div>
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Phone Number</label>
										<div class="input-group">
											<input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number" value="" required="">
											<div class="invalid-feedback">
											  Valid Phone Number is required.
											</div>
										</div>
									  </div>
									  <div class="col-md-6 mb-3">
										<label>Password</label>
										<div class="input-group">
											<input type="password" class="form-control" name="password" placeholder="Password" value="" required="">
											<div class="invalid-feedback">
											  Valid Password is required.
											</div>
										</div>
									  </div>
									</div>
									<br>
									<input type="hidden" class="form-control" name="updateID" placeholder="" value="" required="">
											
									<div class="col-md-4 mb-3 mr-auto ml-auto">
										<button id="submitbtn" class="btn-success form-control" type="button">SUBMIT</button>
									</div>
								</form>
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
	
	<?php   
		if($_GET) {
			$updateID = $_GET['studentID'];
			$sql ="SELECT * FROM library_management_system.USERS WHERE user_id='$updateID' and role = 'student'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$first_name = $row["first_name"];
					$last_name = $row["last_name"];
					$email = $row["email"];
					$phone_number = $row["phone_number"];
					$password = $row["password"];
					
					echo "<script>  
					document.getElementsByName('updateID')[0].value = '$updateID';
					document.getElementsByName('studentID')[0].value = '$updateID';
					document.getElementsByName('firstName')[0].value = '$first_name';
					document.getElementsByName('lastName')[0].value = '$last_name';
					document.getElementsByName('email')[0].value = '$email';
					document.getElementsByName('phoneNumber')[0].value = '$phone_number';
					document.getElementsByName('password')[0].value = '$password';
					</script>" ;
				}
			}
		}

		if($_POST){  
			$updateID = $_POST['updateID']; 
			$studentID = $_POST['studentID']; 
			$firstName = $_POST['firstName'];				
			$lastName = $_POST['lastName'];
			$phoneNumber = $_POST['phoneNumber'];		
			$email = $_POST['email'];				
			$password = $_POST['password'];				
			
			$sql = "";
			
			if (!empty($updateID)) {
				$sql ="UPDATE library_management_system.users SET user_id='$studentID', first_name='$firstName', last_name='$lastName', phone_number='$phoneNumber',  email='$email', password='$password' WHERE user_id='$updateID'";
			} else {
				$sql ="INSERT INTO library_management_system.users VALUES ($studentID, '$firstName', '$lastName', '$phoneNumber', '$email', '$password', 'student')";
			}
			
			if ($conn->query($sql) === TRUE) {
				echo '<script>  $("#successAlert").show(); </script>' ; 
			} else {
				echo '<script>  $("#failAlert").show(); </script>' ;
			}
		}  
	?>  
	
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		(function() {
	        'use strict';
			window.addEventListener('load', function() {
				
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var form = document.getElementById('mainForm');
				var button = document.getElementById('submitbtn');
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
	
</body>

</html>
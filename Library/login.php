
 <!-- 
	Sahil Patel
	This is the login page of our system
	CSCE 3444 - Professor Okafor
  -->


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | LOGIN</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<?php
	session_start();
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
						<a href="index.php"><h4>HOME</h4></a>
					</li>
					<li>
						<a href="#"><h4>LOGIN</h4></a>
					</li>
					<li>
						<a href="register.php"><h4>REGISTER</h4></a>
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
					<div class="col-md-6 mr-auto ml-auto">
						<div class="card" style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header text-center">
							   <h5>LOGIN</h5>
							</div>
							<div class="card-body">
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Invalid email address or password!
								</div>
									  
								<form id= "mainForm" method="post" class="needs-validation" novalidate="" >
									<div class="row">
										<div class="col-md-6 mb-3 p-0  mr-auto ml-auto">
											<label for="email">Email Address</label>
											<div class="input-group">
												<div class="input-group-prepend">
												<span class="input-group-text">EA</span>
												</div>
												<input type="email" class="form-control" name="email" placeholder="Enter Email" value="" required="">
												<div class="invalid-feedback">
													Valid email is required.
												</div>
											</div>
										</div>
									</div>
								 
									<div class="row">
										<div class="col-md-6 mb-3 p-0 mr-auto ml-auto">
											<label for="branchCode">Password</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">PW</span>
												</div>
												<input type="password" class="form-control" name="password" placeholder="Password" value="" required="">
												<div class="invalid-feedback">
													Valid password is required.
												</div>
											</div>
										</div>
									</div>
								 
									<div class="row">
										<div class="col-md-4 mb-3 mr-auto ml-auto">
											<button id= "submitbtn" class="btn btn-success btn-mm btn-block" type="submit">SUBMIT</button>
										</div>
									</div>	
									
									<div class="row mr-auto ml-auto">
										<div class="col-md-4 mb-3 p-0 mr-auto ml-auto">
											<a href="register.php">Register Now!</a>
										</div>
										<div class="col-md-4 mb-3 p-0 ml-auto">
											<a href="#">Forgot Password?</a>
										</div>
									</div>
								</form>
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
	
	<?php   
		if($_POST){  
			$email = $_POST['email']; 
			$password = $_POST['password'];				
			
			$sql = "SELECT user_id, role FROM users where email='$email' and password='$password'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			  // output data of each row
				while($row = $result->fetch_assoc()) {
					 $_SESSION['user_id'] = $row["user_id"];
					 $_SESSION['role'] = $row["role"];
					 
					 if ($row["role"] == 'admin') {
						header('Location: admin-panel.php');
					 } else if ($row["role"] == 'student') {
						header('Location: student-panel.php');
					 }
				}
			} else {
				echo '<script>  $("#failAlert").show(); </script>' ; 
			}
		}  
    ?>
	
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
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
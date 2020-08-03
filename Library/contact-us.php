<!--
Ali Tahririan
CSCE 3444
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | CONTACT US</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<?php
	session_start(); //creates a session or resumes the current one based on a session identifier
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student' ) { //checks if session variable have user_id and role equal student
	   header('Location: login.php'); //If above is false then redirect to login page 
	}
	require_once("db-connection.php");  // include db connection helper in this php file
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
						<a href="student-panel.php"><h4>DASHBOARD</h4></a>
					</li>
					
					<li class="active">
						<a href="#bookMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><h4>BOOK</h4></a>
						<ul class="collapse list-unstyled" id="bookMenu">
							<li>
								<a href="borrow-book.php"><h6>BORROW</h6></a>
							</li>
							<li>
								<a href="return-book.php"><h6>RETURN</h6></a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="feedback.php"><h4>FEEDBACK</h4></a>
					</li>
					<li>
						<a href="#"><h4>CONTACT US</h4></a>
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
					<div class="col-sm-8 mr-auto ml-auto">
						<div class="card " style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header text-center">
								<h5>CONTACT US</h5>
							</div>
							<div class="card-body" >
								<div id="successAlert" class="alert alert-success alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Successfully submitted message!
								</div>								
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to submit message!
								</div>
								<form id= "mainForm" method="post" action="contact-us.php" class="needs-validation" novalidate="">
									<div class="row">
										<div class="col-md-10 mb-3  mr-auto ml-auto">
											<label for="branch">Subject</label>
											<div class="input-group">
												<input type="text" class="form-control" name="subject" placeholder="Enter message subject" value="" maxlength="100" required="">
												<div class="invalid-feedback">
												  Valid Subject is required.
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-10 mb-3 mr-auto ml-auto">
											<label for="branch">Message</label>
											<div class="input-group">
												<textarea class="form-control" name="message" maxlength="450" placeholder="Enter message body" rows="5" required=""></textarea>
												<div class="invalid-feedback">
												  Valid Message is required.
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3 mb-3 mr-auto ml-auto">
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
		  <div class="footer-copyright text-center py-4"><h6>Contact : abc@gmail.com &nbsp;&nbsp; Phone : 999100011</h6></div>
		</footer>
	</div>
	
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
	<!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		
		(function() {
			'use strict';
			window.addEventListener('load', function() { //window on load function
				var form = document.getElementById('mainForm');
				var button = document.getElementById('submitbtn');
				
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
		if($_POST){  // checks if there is post request
			// get parameters from post request
			$userID = $_SESSION['user_id'];
			$subject = $_POST['subject']; 
			$message = $_POST['message'];				
			// Insert query for contact us
			$sql ="INSERT INTO contact_us (user_id, subject, message, message_date) VALUES ('$userID', '$subject', '$message', CURDATE())";
		
			if ($conn->query($sql) === TRUE) { // if Insert query return success
				echo '<script>  $("#successAlert").show(); </script>' ; // show sucess alert
			} else {
				echo '<script>  $("#failAlert").show(); </script>' ; // show fail alert
			}
		}  
	?>
</body>

</html>

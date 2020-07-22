<!-- 
	Sahil Patel
	This is the file that will store the feedback of the users in the databsae.
	CSCE 3444 - Professor Okafor
  -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | FEEDBACK</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<?php
	session_start();
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student' ) {
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
						<a href=""><h4>FEEDBACK</h4></a>
					</li>
					<li>
						<a href="contact-us.php"><h4>CONTACT US</h4></a>
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
								<h5>FEEDBACK</h5>
							</div>
							<div class="card-body" >
								<div id="successAlert" class="alert alert-success alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Successfully submitted feedbacck!
								</div>								
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to submit feedbacck!
								</div>
								<form id= "mainForm" method="post" action="feedback.php" class="needs-validation" novalidate="">
									<div class="row">
										<div class="col-md-10 mb-3  mr-auto ml-auto text-center">
											<p><h6>Your feedback is very important to us. Please include your opinion</h6></p>
											<div class="input-group">
												<div class="col-md-12 mb-3 mr-auto ml-auto">
													<button type="button" class="emoticon-button">
														<span class="emoticon-span">&#128577;</span>
													</button>
													<button type="button" class="emoticon-button">												
														<span class="emoticon-span">&#128533;</span>
													</button>
													<button type="button" class="emoticon-button">
														<span class="emoticon-span">&#128528;</span>
													</button>
													<button type="button" class="emoticon-button">
														<span class="emoticon-span">&#128578;</span>
													</button>
													<button type="button" class="emoticon-button">
														<span class="emoticon-span">&#128512;</span>
													</button>
									
													<input type="text" class="form-control" name="emotion" placeholder="" value="" maxlength="100" required="" hidden>
													<div class="invalid-feedback">
													  Valid emotion is required.
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-10 mb-3 mr-auto ml-auto">
											<label for="branch">Suggestions</label>
											<div class="input-group">
												<textarea class="form-control" name="suggestion" maxlength="300" placeholder="Enter your suggestions" rows="3" required=""></textarea>
												<div class="invalid-feedback">
												  Valid Suggestion is required.
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
			window.addEventListener('load', function() {
				$(".emoticon-span").click(function() {
					document.getElementsByName('emotion')[0].value = $(this).html();
				});
				
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
	
	<?php   
		if($_POST){  
			$userID = $_SESSION['user_id'];
			$emotion = $_POST['emotion']; 
			$suggestion = $_POST['suggestion'];				
			
			$sql ="INSERT INTO feedback (user_id, emotion, suggestion, feedback_date) VALUES ('$userID', '$emotion', '$suggestion', CURDATE())";
		
			if ($conn->query($sql) === TRUE) {
				echo '<script>  $("#successAlert").show(); </script>' ; 
			} else {
				echo '<script>  $("#failAlert").show(); </script>' ; 
			}
		}  
	?>
</body>

</html>
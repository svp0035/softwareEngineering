<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | DASHBOARD</title>

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
						<a href="#"><h4>DASHBOARD</h4></a>
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
					<div class="col-sm-10 mr-auto ml-auto">
						<div class="card text-center" style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header">
								<h5>DASHBOARD</h5>
							</div>
							<div class="card-body" >
								<div class="row ">
									<div class="col-md-6">
										<p id="studentID"></p>
										<p id="firstName"></p>
										<p id="lastName"></p>
										<p id="email"></p>
										<p id="phoneNumber"></p>
									</div>
									<div class="col-md-6">
										<br><br>
										<p><span><b> CURRENT BORROWED BOOKS</b></span></p>
										<p id="borrowCount" style="font-size:40px"></p>
									</div>
								</div>
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
		$userID = $_SESSION['user_id'];
		// query to get student info and borrow book Count 
		$sql ="SELECT *, (SELECT count(*) from borrow_return WHERE user_id='$userID' and returned='N') borrowCount FROM users WHERE user_id='$userID'";
		
		$result = $conn->query($sql); //execute query
		if ($result->num_rows > 0) {  //if result row gt than 0
			while($row = $result->fetch_assoc()) {
				// get first_name, last_name, email, phone_number borrowCount from row
				$first_name = $row["first_name"];
				$last_name = $row["last_name"];
				$email = $row["email"];
				$phone_number = $row["phone_number"];
				$borrowCount = $row["borrowCount"];
				// fill up hrml field first_name, last_name, email, phone_number, borrowCount from row
				echo "<script>  
					document.getElementById('studentID').innerHTML = '<span><b>Student ID   : </b></span>$userID';
					document.getElementById('firstName').innerHTML = '<span><b>First Name   : </b></span>$first_name';
					document.getElementById('lastName').innerHTML = '<span><b>Last Name   : </b></span>$last_name';
					document.getElementById('email').innerHTML = '<span><b>Email   : </b></span>$email';
					document.getElementById('phoneNumber').innerHTML = '<span><b>Phone Number   : </b></span>$phone_number';
					document.getElementById('borrowCount').innerHTML = '<span>$borrowCount</span>';
				</script>" ;
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
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () { //sidebar collapse button event listner
                $('#sidebar').toggleClass('active'); // sidebar div class value toggle
            });
        });
    </script>
	
</body>

</html>
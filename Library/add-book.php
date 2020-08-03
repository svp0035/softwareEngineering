<!--
Ali Tahririan
CSCE 3444
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | BOOK FORM</title>

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
								<a href="delete-student.php"><h6>DELETE</h6></a>
							</li>
						</ul>
					</li>
					<li class="active">
						<a href="#bookMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><h4>BOOK</h4></a>
						<ul class="collapse list-unstyled" id="bookMenu">
							<li>
								<a href="#"><h6>ADD</h6></a>
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
							   <h5>BOOK FORM</h5>
							</div>
							<div class="card-body" >
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to add book!
								</div>
								<div id="successAlert" class="alert alert-success alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Successfully added book!
								</div>
								<form id="mainForm" method="post" action="add-book.php" class="needs-validation"  novalidate="" >
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Book ID</label>
										<div class="input-group">
											<input type="text" class="form-control" name="bookID" placeholder="Book ID" value="" required="">
											<div class="invalid-feedback">
											  Valid Book ID is required.
											</div>
										</div>
									  </div>
									  <div class="col-md-6 mb-3">
										<label for="branchName">Book Title</label>
										<div class="input-group">
											<input type="text" class="form-control" name="title" placeholder="Book Title" value="" required="">
											<div class="invalid-feedback">
											  Valid Book Title is required.
											</div>
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Author</label>
										<div class="input-group">
											<input type="text" class="form-control" name="author" placeholder="Author" value="" required="">
											<div class="invalid-feedback">
											  Valid Author is required.
											</div>
										</div>
									  </div>
									  <div class="col-md-6 mb-3">
										<label>Genre</label>
										<div class="input-group">
											<input type="text" class="form-control" name="genre" placeholder="Genre" value="" required="">
											<div class="invalid-feedback">
											  Valid Genre is required.
											</div>
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <div class="col-md-6 mb-3">
										<label for="branch">Edition</label>
										<div class="input-group">
											<input type="text" class="form-control" name="edition" placeholder="Edition" value="" required="">
											<div class="invalid-feedback">
											  Valid Edition is required.
											</div>
										</div>
									  </div>
									  
									  <div class="col-md-6 mb-3">
										<label for="branch">Count</label>
										<div class="input-group">
											<input type="number" class="form-control" name="count" placeholder="Count" value="" required="">
											<div class="invalid-feedback">
											  Valid Count is required.
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
		  <div class="footer-copyright text-center py-4"><h6>Contact : abc@gmail.com &nbsp;&nbsp; Phone : 999100011</h6></div>
		</footer>
	</div>
	
	<?php   
		if($_GET){ // checks if there is get request from update page
			$updateID = $_GET['bookID']; //updateID gets from get request 
			
			$sql ="SELECT * FROM books WHERE book_id='$updateID'";
			$result = $conn->query($sql); //execute query
			if ($result->num_rows > 0) { //checks if result num_rows is gt than 0
				while($row = $result->fetch_assoc()) {
					//get title, author, genre, edition, count from query result row
					$title = $row["title"];
					$author = $row["author"];
					$genre = $row["genre"];
					$edition = $row["edition"];
					$count = $row["count"];
					//fill up title, author, genre, edition, count values in html
					echo "<script>  
					document.getElementsByName('updateID')[0].value = '$updateID';
					document.getElementsByName('bookID')[0].value = '$updateID';
					document.getElementsByName('title')[0].value = '$title';
					document.getElementsByName('author')[0].value = '$author';
					document.getElementsByName('genre')[0].value = '$genre';
					document.getElementsByName('edition')[0].value = '$edition';
					document.getElementsByName('count')[0].value = '$count';
					</script>" ;
				}
			}
		}

		if($_POST){  // checks if there is post request from add page
			//get updateID, bookID, title, author, genre, edition, count from post request
			$updateID = $_POST['updateID']; 
			$bookID = $_POST['bookID']; 
			$title = $_POST['title'];				
			$author = $_POST['author'];
			$genre = $_POST['genre'];			
			$edition = $_POST['edition'];	
			$count = $_POST['count'];				
			
			$sql = "";
			
			if (!empty($updateID)) { // checks if update id not empty
				$sql ="UPDATE books SET book_id='$bookID', title='$title', author='$author', genre='$genre',  edition='$edition', count='$count' WHERE book_id='$updateID'";
			} else { //if update id empty
				$sql ="INSERT INTO books VALUES ($bookID, '$title', '$author', '$genre', '$edition', '$count')";
			}
			
			if ($conn->query($sql) === TRUE) { //if query successfully executed
				echo '<script>  $("#successAlert").show(); </script>' ;  //show success alert
			} else { 
				echo '<script>  $("#failAlert").show(); </script>' ; //show fail alert
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
			window.addEventListener('load', function() { //window on load function
				
				//get form and submitbtn by id
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
	
</body>

</html>

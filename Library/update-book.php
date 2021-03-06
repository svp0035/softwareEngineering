<!--
Santosh Pradhan
CSCE 3444
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | UPDATE BOOK</title>

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
								<a href="add-book.php"><h6>ADD</h6></a>
							</li>
							<li>
								<a href="#"><h6>UPDATE</h6></a>
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
							   <h5>UPDATE BOOK</h5>
							</div>
							<div class="card-body" >
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
										  <option>Title</option>
										  <option>Genre</option>
										  <option>Author</option>
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
									  <th scope="col">Title</th>
									  <th scope="col">Author</th>
									  <th scope="col">Genre</th>
									  <th scope="col">Edition</th>
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
		//this method is used add new row in searchTable table
		function addtoTable(id, title, author, genre, edition) {
			$("#searchTable").show();
			// new row created 
			var markup = "<tr><td class=\"bookID\">" + id + "</td><td>" + title + "</td><td>" + author + "</td><td>" + genre + "</td><td>" + edition + "</td><td><button class=\"action-button\" type=\"button\"><img src=\"./image/edit.png\" width=\"20\" height=\"20\"></button></td></tr>";
			$("table tbody").append(markup); // new row appended 
		}
	 
		(function() {
			'use strict';
			window.addEventListener('load', function() { //window on load function
				//get table body using jquery
				var tbody = $("#searchTable tbody");

				if (tbody.children().length == 0) { //checks if Table have any row or not
					$("#searchTable").hide(); //if Table dont have any row then hide table
				}
				
				$(".action-button").click(function() {  //table row action button click listner
					var $row = $(this).closest('tr')
					var $bookID = $row.find(".bookID").text(); //gets book ID from the clicked row
					
					document.location.href = "add-book.php?bookID=" + $bookID; // redirect to add-book form with book ID   	    
				});
				var form = document.getElementById('searchForm');
				var button = document.getElementById('searchbtn');
				
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
			$searchValue = $_POST['searchValue']; 
			$searchBy = $_POST['searchBy'];				
			
			$sql ="";
			
			if($searchBy == 'Title') { //if searchBy Title
				$sql ="SELECT * FROM books WHERE title LIKE '%$searchValue%'";
			} else if($searchBy == 'Author') { //if searchBy Author
				$sql ="SELECT * FROM books WHERE author LIKE '%$searchValue%'";
			} else if($searchBy == 'Genre') { //if searchBy Genre
				$sql ="SELECT * FROM books WHERE genre LIKE '%$searchValue%'";
			}
			
			$result = $conn->query($sql); //execute query
			if ($result->num_rows > 0) { //if result row gt than 0
				while($row = $result->fetch_assoc()) {
					//get book_id, title, author, genre, edition from row result
					$book_id = $row["book_id"];
					$title = $row["title"];
					$author = $row["author"];
					$genre = $row["genre"];
					$edition = $row["edition"];
					// add book_id, title, author, genre, edition in html table
					echo "<script>  addtoTable('$book_id', '$title', '$author', '$genre', '$edition'); </script>" ;
				}
			} 
		}  
	?> 	
</body>

</html>

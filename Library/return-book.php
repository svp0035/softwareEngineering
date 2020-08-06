<!--
	Sahil Patel
	This file is for student panel so students can return the books to the library.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | RETURN BOOK</title>

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
						<a href="student-panel.php"><h4>DASHBOARD</h4></a>
					</li>
					
					<li class="active">
						<a href="#bookMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><h4>BOOK</h4></a>
						<ul class="collapse list-unstyled" id="bookMenu">
							<li>
								<a href="borrow-book.php"><h6>BORROW</h6></a>
							</li>
							<li>
								<a href=""><h6>RETURN</h6></a>
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
								<h5>RETURN BOOK</h5>
							</div>
							<div class="card-body" >
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to return Book!
								</div>
								<br>
								<table style="display:none" id="searchTable" class="table table-responsive-sm table-bordered">
									<thead>
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Name</th>
											<th scope="col">Author</th>
											<th scope="col">Genre</th>
											<th scope="col">Edition</th>
											<th scope="col">Borrowed Date</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
								<tbody></table>
								<br>
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
	
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
	<!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		//this method is used add new row in searchTable table
		function addtoTable(id, title, author, genre, edition, borrowedDate) {
			$("#searchTable").show();
			// new row created 
			markup = "<tr><td class=\"bookID\">" + id + "</td><td>" + title + "</td><td>" + author + "</td><td>" + genre + "</td><td>" + edition + "</td><td>" + borrowedDate + "</td><td><button class='btn-success action-button form-control' type='button'>RETURN</button></td></tr>";
			
			$("table tbody").append(markup); // new row appended 
		}
	 
		(function() {
			'use strict';
			window.addEventListener('load', function() {  //window on load function
				//get table body using jquery
				var tbody = $("#searchTable tbody");

				if (tbody.children().length == 0) { //checks if Table have any row or not
					$("#searchTable").hide(); //if Table dont have any row then hide table
				}
				
				$(".action-button").click(function() { //table row action button click listner
					var $row = $(this).closest('tr')
					var $bookID = $row.find(".bookID").text(); //gets book ID from the clicked row
					
					$.ajax({ // ajax post request
						type : "post",
						url : "return.php", // post url
						data : "userID=" + <?php echo $_SESSION['user_id']; ?> + "&bookID=" + $bookID,
						success : function(msg) {
							if ( msg.indexOf("SUCCESS") >= 0) { // check if response message is SUCCESS
								document.location.reload(); // reload current page
							} else {
								$("#failAlert").show(); //show fail Alert
							}
						}
					});   
				});
			}, false);
		})();
		
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () { //sidebar collapse button event listner
                $('#sidebar').toggleClass('active'); // sidebar div class value toggle
            });
        });
    </script>
	
	<?php   
		$userID = $_SESSION['user_id']; //get user id from session
		//borrowed book list query
		$sql ="SELECT * FROM books, borrow_return WHERE books.book_id=borrow_return.book_id and borrow_return.user_id='$userID' and borrow_return.returned='N'";
		
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { //if result row gt than 0
			while($row = $result->fetch_assoc()) {
				// get book_id, title, author, genre, edition, borrowedDate from row
				$book_id = $row["book_id"];
				$title = $row["title"];
				$author = $row["author"];
				$genre = $row["genre"];
				$edition = $row["edition"];
				$borrowedDate = $row["borrowed_date"];
				// add book_id, title, author, genre, edition, borrowedDate  in html table
				echo "<script>  addtoTable('$book_id', '$title', '$author', '$genre', '$edition', '$borrowedDate'); </script>" ;
				
			}
		}  
	?>
</body>

</html>
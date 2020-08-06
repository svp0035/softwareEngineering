<!--
Ali Tahririan
CSCE 3444
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>UNT LIBRARY | BORROW BOOK</title>

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
								<a href="#"><h6>BORROW</h6></a>
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
					<div class="col-sm-12 mr-auto ml-auto">
						<div class="card text-center" style=" background-color: rgba(245, 245, 245, 0.7); ">
							<div class="card-header">
								<h5>BORROW BOOK</h5>
							</div>
							<div class="card-body" >
								<div id="failAlert" class="alert alert-danger alert-dismissible collapse text-center">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Danger!</strong> Failed to borrow book!
								</div>
								<form id= "searchForm" method="post" class="needs-validation" novalidate="">
									<div class="row">
										<div class="col-md-5 mb-3 mr-auto ml-auto">
											<input type="text" class="form-control" name="searchValue" placeholder="Search Value" value="">
											<div class="invalid-feedback">
												Search Value is required.
											</div>
										</div>
										<div class="col-md-3 mb-3 mr-auto ml-auto">
											<select class="custom-select d-block w-100" name="searchBy">
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
							  
								<table style="display:none; border: 1px solid black;" id="searchTable" class="table table-responsive-sm table-bordered">
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
									<tbody></tbody>
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
	
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
	<!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		function addtoTable(id, title, author, genre, edition, count, current_borrorw) {
			$("#searchTable").show();
			var markup = "";
			if (current_borrorw != 0) {
				markup = "<tr><td class=\"bookID\">" + id + "</td><td>" + title + "</td><td>" + author + "</td><td>" + genre + "</td><td>" + edition + "</td><td>Borrowed</td></tr>";
			} else {
				if (count == 0) {
					markup = "<tr><td class=\"bookID\">" + id + "</td><td>" + title + "</td><td>" + author + "</td><td>" + genre + "</td><td>" + edition + "</td><td>Not Available</td></tr>";
				} else {
					markup = "<tr><td class=\"bookID\">" + id + "</td><td>" + title + "</td><td>" + author + "</td><td>" + genre + "</td><td>" + edition + "</td><td><button class='btn-success action-button form-control' type='button'>BORROW</button></td></tr>";
				}
			}
			
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
					var $bookID = $row.find(".bookID").text();
					
					$.ajax({
						type : "post",
						url : "borrow.php",
						data : "userID=" + <?php echo $_SESSION['user_id']; ?> + "&bookID=" + $bookID,
						success : function(msg) {
							if ( msg.indexOf("SUCCESS") >= 0) {
								document.location.reload(); 
							} else {
								$("#failAlert").show();
							}
						}
					});
							
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
			$user_id = $_SESSION['user_id'];
			
			$sql ="SELECT *, (SELECT count(*) FROM borrow_return WHERE books.book_id=borrow_return.book_id and borrow_return.user_id='$user_id' and borrow_return.returned='N') current_borrorw FROM books";
			
			if($searchBy == 'Title') {
				$sql .=" WHERE title LIKE '%$searchValue%'";
			} else if($searchBy == 'Author') {
				$sql .=" WHERE author LIKE '%$searchValue%'";
			} else if($searchBy == 'Genre') {
				$sql .=" WHERE genre LIKE '%$searchValue%'";
			}
			
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$book_id = $row["book_id"];
					$title = $row["title"];
					$author = $row["author"];
					$genre = $row["genre"];
					$edition = $row["edition"];
					$count = $row["count"];
					$current_borrorw = $row["current_borrorw"];
					
					echo "<script>  addtoTable('$book_id', '$title', '$author', '$genre', '$edition', $count, '$current_borrorw'); </script>" ;
				}
			} 
		}  
	?>
</body>

</html>

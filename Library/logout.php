<!-- 
	Sahil Patel
	This is the file that ends the session for students and admin and returns to the front page: index.php
	CSCE 3444 - Professor Okafor
  -->

<?php
	session_start();  //creates a session or resumes the current one based on a session identifier
	unset($_SESSION['user_id']); //unset user_id
	unset($_SESSION['role']);  //unset role
	header("Location:index.php");  //redirect to index page 
?>

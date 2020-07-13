<!-- 
	Sahil Patel
	This is the file that ends the session for students and admin and returns to the front page: index.php
	CSCE 3444 - Professor Okafor
  -->

<?php
	session_start();
	unset($_SESSION['user_id']);
	unset($_SESSION['role']);
	header("Location:index.php");
?>
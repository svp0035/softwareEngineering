<!-- 
	Sahil Patel
	This is the file that will delete books and students from the phpmyadmin database
	CSCE 3444 - Professor Okafor
  -->


<?php
	session_start();
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' ) {
	   echo 'FAILED';
	}
	require_once("db-connection.php");
	
	if($_POST){  
		$studentID = $_POST['studentID']; 
		$bookID = $_POST['bookID']; 
		$searchSql = "";
		$deleteSql = "";
		
		if (!empty($studentID)) {
			$searchSql ="SELECT * FROM borrow_return WHERE user_id='$studentID'";
			$deleteSql ="DELETE FROM users WHERE user_id='$studentID'";
		} else {
			$searchSql ="SELECT * FROM borrow_return WHERE book_id='$bookID'";
			$deleteSql ="DELETE FROM books WHERE book_id='$bookID'";
		}
		
		
		$result = $conn->query($searchSql);
		if ($result->num_rows > 0) {
			echo 'FAILED' ;
		} else {
			if ($conn->query($deleteSql) === TRUE) {
				echo 'SUCCESS' ; 
			} else {
				echo 'FAILED' ;
			}
		}	
	}
?>
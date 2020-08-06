<!-- 
	Sahil Patel
	This is the file that will delete books and students from the phpmyadmin database
	CSCE 3444 - Professor Okafor
  -->


<?php
	session_start(); //creates a session or resumes the current one based on a session identifier
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin' ) { //checks if session variable have user_id and role equal admin
	   echo 'FAILED'; // if not then return failed
	}
	require_once("db-connection.php"); // include db connection helper in this php file
	
	if($_POST){   // checks if post request
		//get parameters from post request
		$studentID = $_POST['studentID']; 
		$bookID = $_POST['bookID']; 
		$searchSql = "";
		$deleteSql = "";
		
		if (!empty($studentID)) { // if delete student
			$searchSql ="SELECT * FROM borrow_return WHERE user_id='$studentID'"; //select query to if data exsit after delete
			$deleteSql ="DELETE FROM users WHERE user_id='$studentID'"; //delete query
		} else { // else delete book
			$searchSql ="SELECT * FROM borrow_return WHERE book_id='$bookID'"; //select query to if data exsit after delete
			$deleteSql ="DELETE FROM books WHERE book_id='$bookID'"; //delete query
		}
		
		$result = $conn->query($searchSql); //execute select query to if data exsit after delete
		if ($result->num_rows > 0) { //checks if result num_rows is gt than 0
			echo 'FAILED' ; // if not then return failed
		} else {
			if ($conn->query($deleteSql) === TRUE) { //if query successfully executed
				echo 'SUCCESS' ; 
			} else {
				echo 'FAILED' ; // if not then return failed
			}
		}	
	}
?>

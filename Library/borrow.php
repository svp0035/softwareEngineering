<!--
	Sahil Patel
	This file allows the students to borrow books from the library
-->

<?php
	session_start(); //creates a session or resumes the current one based on a session identifier
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student' ) { //checks if session variable have user_id and role equal student
	   echo 'FAILED'; // if not then return failed
	}
	require_once("db-connection.php"); // include db connection helper in this php file
	
	if($_POST){  // checks if post request
		//get parameters from post request
		$userID = $_POST['userID']; 
		$bookID = $_POST['bookID']; 
		
		//create a sql that insert new row in borrow_return table in db with borrow date as current date
		$sql ="INSERT INTO borrow_return (user_id, book_id, borrowed, borrowed_date, returned) VALUES ('$userID', '$bookID', 'Y', CURDATE(), 'N')";
		
		if ($conn->query($sql) === TRUE) { //checks if query executed successfully
			//create a sql that update available book count in book table
			$sql = "UPDATE books SET count= books.count-1 WHERE book_id='$bookID'";
			if ($conn->query($sql) === TRUE) { //checks if query executed successfully
				echo 'SUCCESS' ; //if executed successfully then return SUCCESS
			} else {
				echo 'FAILED' ; // if not then return failed
			}
		} else {
			echo 'FAILED' ; // if not then return failed
		}
	
	}
?>
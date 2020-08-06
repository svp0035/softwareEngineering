<!--
	Sahil Patel
	This file is for student panel so students can return the books to the library.
-->

<?php
	session_start(); //creates a session or resumes the current one based on a session identifier
	if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student' ) {  //checks if session variable have user_id and role equal student
	   echo 'FAILED'; // if not then return failed
	}
	require_once("db-connection.php");  // include db connection helper in this php file
	
	if($_POST){  
		//get parameters from post request
		$userID = $_POST['userID']; 
		$bookID = $_POST['bookID']; 
		
		//create a sql that insert new row in borrow_return table in db with return date as current date
		$sql ="UPDATE borrow_return SET returned='Y', returned_date=CURDATE() WHERE user_id='$userID' and book_id='$bookID' and returned='N'";
		
		if ($conn->query($sql) === TRUE) {  //checks if query executed successfully
			//create a sql that update available book count in book table
			$sql = "UPDATE books SET count= books.count+1 WHERE book_id='$bookID'";
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
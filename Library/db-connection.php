 <!-- 
	Sahil Patel
	This is the file that connects the website to phpMyAdmin database of our system
	CSCE 3444 - Professor Okafor
  -->

<?php
$servername = "localhost"; //server address 
$database = "library_management_system"; //databae name
$port = 3306;  //databae port
$username = "root"; //databae user
$password = ""; //databae user password

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);  //connect function is used to connect to database server

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

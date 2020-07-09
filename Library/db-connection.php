 <!-- 
	Sahil Patel
	This is the file that connects the website to phpMyAdmin database of our system
	CSCE 3444 - Professor Okafor
  -->

<?php
$servername = "localhost";
$database = "library_management_system";
$port = 3306;
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
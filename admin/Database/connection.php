<?php
$locahost = "localhost";
$username = "root";
$password = "";
$db_lawyer = "lawyer_database";

// Create connection
$conn = new mysqli($locahost, $username, $password,$db_lawyer);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";   
$dbname = "core_php_task"; // my database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "issue_tracking";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
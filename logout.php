<?php
require_once 'db.php';
$conn = Database::connect();

// logout.php - User Logout
session_start();
session_destroy();
header("Location: login.php");
exit();
?>
<?php
require_once 'db.php';
$conn = Database::connect();


// comment.php - Add Comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $per_id = $_SESSION['user_id'];
    $iss_id = $_POST['iss_id'];
    $short_comment = $_POST['short_comment'];
    $long_comment = $_POST['long_comment'];
    $conn->query("INSERT INTO iss_comments (per_id, iss_id, short_comment, long_comment, posted_date) VALUES ($per_id, $iss_id, '$short_comment', '$long_comment', NOW())");
    header("Location: issue.php?id=$iss_id");
}
?>
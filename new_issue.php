<?php
// new_issue.php - Create New Issue
require_once 'db.php';
session_start();
$conn = Database::connect();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $priority = $_POST['priority'];
    $per_id = $_SESSION['user_id'];
    
    try {
        $stmt = $conn->prepare("INSERT INTO iss_issues (short_description, long_description, open_date, priority, per_id) VALUES (?, ?, NOW(), ?, ?)");
        $stmt->execute([$short_description, $long_description, $priority, $per_id]);
        echo "Issue created successfully. <a href='index.php'>View Issues</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Create New Issue</title></head>
<body>
<h2>Create New Issue</h2>
<form method="post" action="new_issue.php">
    Short Description: <input type="text" name="short_description" required><br>
    Long Description: <textarea name="long_description" required></textarea><br>
    Priority: <select name="priority">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br>
    <button type="submit">Submit</button>
</form>
<a href="index.php">Back to Issues</a>
</body>
</html>
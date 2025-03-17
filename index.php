<?php
require_once 'db.php';
$conn = Database::connect();

// index.php - List Issues
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$stmt = $conn->query("SELECT * FROM iss_issues");
$issues = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><title>Issues</title></head>
<body>
<h2>Issue Tracker</h2>
<a href="new_issue.php">Create New Issue</a>
<table border="1">
    <tr><th>ID</th><th>Title</th><th>Priority</th><th>Actions</th></tr>
    <?php foreach ($issues as $row) { ?>

    <tr>
        <td><?= $row['id'] ?></td>
        <td><a href="issue.php?id=<?= $row['id'] ?>"><?= $row['short_description'] ?></a></td>
        <td><?= $row['priority'] ?></td>
        <td><a href="delete_issue.php?id=<?= $row['id'] ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
<a href="logout.php">Logout</a>
</body>
</html>
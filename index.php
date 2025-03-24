<?php
session_start();
include('db.php');
include('login.php');
ensure_logged_in();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Tracker - Home</title>
</head>
<body>
<h2>Welcome to the Issue Tracking App</h2>
<p>You are logged in!</p>
<a href="new_issue.php">Create New Issue</a>
<a href="logout.php">Logout</a>

<h3>Existing Issues:</h3>
<ul>
<?php
$query = "SELECT * FROM issues ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($issue = mysqli_fetch_assoc($result)) {
        echo "<li>" . htmlspecialchars($issue['title']) . " - " . htmlspecialchars($issue['description']) . "</li>";
    }
} else {
    echo "<p>No issues found.</p>";
}
?>
</ul>
</body>
</html>

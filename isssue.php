
<?php
require_once 'db.php';
$conn = Database::connect();

// issue.php - View Issue and Comments
if (!isset($_GET['id'])) {
    die("Issue ID missing.");
}
$issue_id = $_GET['id'];
$issue = $conn->query("SELECT * FROM iss_issues WHERE id = $issue_id")->fetch_assoc();
$comments = $conn->query("SELECT * FROM iss_comments WHERE iss_id = $issue_id");
?>
<!DOCTYPE html>
<html>
<head><title>Issue Details</title></head>
<body>
<h2><?= $issue['short_description'] ?></h2>
<p><?= $issue['long_description'] ?></p>
<h3>Comments</h3>
<?php while ($comment = $comments->fetch_assoc()) { ?>
<p><strong><?= $comment['short_comment'] ?></strong>: <?= $comment['long_comment'] ?></p>
<?php } ?>
<form method="post" action="comment.php">
    <input type="hidden" name="iss_id" value="<?= $issue_id ?>">
    <input type="text" name="short_comment" required>
    <textarea name="long_comment" required></textarea>
    <button type="submit">Add Comment</button>
</form>
</body>
</html>
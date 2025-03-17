<?php
// login.php - User Authentication
require_once 'db.php';
session_start();
$conn = Database::connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, fname, lname, pwd_hash, pwd_salt FROM iss_persons WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && hash('sha256', $user['pwd_salt'] . $password) === $user['pwd_hash']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['fname'] . ' ' . $user['lname'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<form method="post" action="login.php">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
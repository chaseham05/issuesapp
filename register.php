<?php
// register.php - User Registration
require_once 'db.php';
$conn = Database::connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Generate a unique salt
    $salt = bin2hex(random_bytes(16));
    $pwd_hash = hash('sha256', $salt . $password);

    try {
        $stmt = $conn->prepare("INSERT INTO iss_persons (fname, lname, email, pwd_hash, pwd_salt) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fname, $lname, $email, $pwd_hash, $salt]);
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<form method="post" action="register.php">
    First Name: <input type="text" name="fname" required><br>
    Last Name: <input type="text" name="lname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
<?php

// Database setup script
$servername = "localhost";
$username = "root";
$password = "";
$database = "issue_tracking";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, $database);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);";
if (mysqli_query($conn, $sql)) {
    echo "Users table created successfully.<br>";
} else {
    echo "Error creating users table: " . mysqli_error($conn) . "<br>";
}

// Create issues table
$sql = "CREATE TABLE IF NOT EXISTS issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);";
if (mysqli_query($conn, $sql)) {
    echo "Issues table created successfully.<br>";
} else {
    echo "Error creating issues table: " . mysqli_error($conn) . "<br>";
}

// Create comments table
$sql = "CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    issue_id INT,
    comment_text TEXT NOT NULL,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (issue_id) REFERENCES issues(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);";
if (mysqli_query($conn, $sql)) {
    echo "Comments table created successfully.<br>";
} else {
    echo "Error creating comments table: " . mysqli_error($conn) . "<br>";
}

// Insert sample data
$hashed_password1 = password_hash('admin123', PASSWORD_BCRYPT);
$hashed_password2 = password_hash('password1', PASSWORD_BCRYPT);
$hashed_password3 = password_hash('password2', PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, password) VALUES
    ('admin', '$hashed_password1'),
    ('user1', '$hashed_password2'),
    ('user2', '$hashed_password3');";
if (mysqli_query($conn, $sql)) {
    echo "Sample users added successfully.<br>";
} else {
    echo "Error inserting sample users: " . mysqli_error($conn) . "<br>";
}

// Insert sample issues and comments
$sql = "INSERT INTO issues (title, description, created_by) VALUES
    ('First Issue', 'This is the first issue description.', 1),
    ('Second Issue', 'This is the second issue description.', 2);";
if (mysqli_query($conn, $sql)) {
    echo "Sample issues added successfully.<br>";
} else {
    echo "Error inserting sample issues: " . mysqli_error($conn) . "<br>";
}

$sql = "INSERT INTO comments (issue_id, comment_text, user_id) VALUES
    (1, 'This is a comment on the first issue.', 1),
    (1, 'Another comment on the first issue.', 2),
    (2, 'Comment on the second issue.', 3);";
if (mysqli_query($conn, $sql)) {
    echo "Sample comments added successfully.<br>";
} else {
    echo "Error inserting sample comments: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>

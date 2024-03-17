<?php
session_start();

// Database connection parameters
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'leave_management_system';

// Retrieve the admin's email from the session (you should set it during login)
$admin_email = $_SESSION['admin_email'];

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a SQL query to retrieve the admin's details
$query = "SELECT first_name, last_name, email FROM admins WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $adminName = $row['first_name'] . ' ' . $row['last_name'];
    $adminEmail = $row['email'];
    echo "Name: $adminName<br>Email: $adminEmail";
} else {
    echo "Admin details not found.";
}

$stmt->close();
$conn->close();
?>

<?php
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = "leave_management_system"; // Change to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role === 'student') {
    $table = 'students';
} elseif ($role === 'admin') {
    $table = 'admins';
} else {
    echo "Invalid role selected";
    exit();
}

$sql = "SELECT * FROM $table WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        if ($role === 'student') {
            header("Location: student_dashboard.html"); // Redirect to student dashboard
        } elseif ($role === 'admin') {
            header("Location: admin_dashboard.html"); // Redirect to admin dashboard
        }
        exit();
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found!";
}

$conn->close();
?>

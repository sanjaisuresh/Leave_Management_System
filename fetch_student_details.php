<?php
session_start();

// Database connection parameters
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'leave_management_system';

// Retrieve the student's email from the session (you should set it during login)
$student_email = $_SESSION['student_email'];

// Create a database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a SQL query to retrieve the student's details
$query = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Format the student's details
    $studentDetails = "
        <p><strong>Name:</strong> {$row['first_name']} {$row['last_name']}</p>
        <p><strong>Roll Number:</strong> {$row['roll_number']}</p>
        <p><strong>Department:</strong> {$row['department']}</p>
        <p><strong>Academic Year:</strong> {$row['academic_year']}</p>
        <p><strong>Date of Birth:</strong> {$row['dob']}</p>
        <p><strong>Blood Group:</strong> {$row['blood_group']}</p>
    ";

    echo $studentDetails;
} else {
    echo "Student details not found.";
}

$stmt->close();
$conn->close();
?>

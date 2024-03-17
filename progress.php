<?php
// Define the database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "leave_management_system";

// Create a new MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check for a connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the student is logged in (you may need to implement a login system)
// For this example, let's assume you have stored the logged-in student's email in a session variable.
session_start();
if (!isset($_SESSION['student_email'])) {
    die("You are not logged in.");
}

// Get the logged-in student's email
$student_email = $_SESSION['student_email'];

// Prepare and execute an SQL query to fetch the leave application details for the logged-in student
$query = "SELECT * FROM leave_application WHERE student_email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $student_email);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    // Display leave application details
    while ($row = $result->fetch_assoc()) {
        echo '<div class="progress-item">';
        echo '<h3>Leave Application</h3>';
        echo '<p>Status: ' . $row['status'] . '</p>';
        echo '<p>Reason: ' . $row['reason'] . '</p>';
        echo '<p>Start Date: ' . $row['start_date'] . '</p>';
        echo '<p>End Date: ' . $row['end_date'] . '</p>';
        echo '</div>';
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$mysqli->close();
?>

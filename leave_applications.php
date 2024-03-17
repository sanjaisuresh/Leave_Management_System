<?php
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
// Retrieve all leave applications
$query = "SELECT * FROM leave_application WHERE status = 'Pending'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='leave-application'>";
        echo "<h4>{$row['category']} Leave</h4>";
        echo "<p><strong>Student Email:</strong> {$row['student_email']}</p>";
        echo "<p><strong>Reason:</strong> {$row['reason']}</p>";
        echo "<p><strong>Start Date:</strong> {$row['start_date']}</p>";
        echo "<p><strong>End Date:</strong> {$row['end_date']}</p>";
        echo "<p><strong>Status:</strong> {$row['status']}</p>";
        echo "<button class='approve-button' data-application-id='{$row['id']}'>Approve</button>";
        echo "<button class='reject-button' data-application-id='{$row['id']}'>Reject</button>";
        echo "</div>";
    }
} else {
    echo "<p>No leave applications found.</p>";
}

// Close the database connection
$mysqli->close();
?>

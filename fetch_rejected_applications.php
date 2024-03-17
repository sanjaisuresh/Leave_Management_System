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

// Retrieve rejected leave applications
$query = "SELECT * FROM leave_application WHERE status = 'Rejected'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='leave-application'>";
        echo "<h3>{$row['category']} Leave</h3>";
        echo "<p><strong>Student Email:</strong> {$row['student_email']}</p>";
        echo "<p><strong>Reason:</strong> {$row['reason']}</p>";
        echo "<p><strong>Start Date:</strong> {$row['start_date']}</p>";
        echo "<p><strong>End Date:</strong> {$row['end_date']}</p>";
        echo "</div>";
    }
} else {
    echo "<p>No rejected leave applications found.</p>";
}

// Close the database connection
$mysqli->close();
?>

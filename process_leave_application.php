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

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the application ID and status from the JSON request
    $data = json_decode(file_get_contents("php://input"));
    $applicationId = $data->id;
    $status = $data->status;

    // Update the status of the leave application in the database
    $updateQuery = "UPDATE leave_application SET status = ? WHERE id = ?";
    $stmt = $mysqli->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param("si", $status, $applicationId);
        if ($stmt->execute()) {
            echo "Leave application updated successfully.";
        } else {
            echo "Error updating leave application: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $mysqli->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$mysqli->close();
?>

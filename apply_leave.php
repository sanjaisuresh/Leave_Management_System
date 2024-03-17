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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $category = isset($_POST["category"]) ? $_POST["category"] : "";
    $reason = isset($_POST["reason"]) ? $_POST["reason"] : "";
    $start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
    $end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : "";
    $student_email = isset($_POST["student_email"]) ? $_POST["student_email"] : "";

    // Add status with a default value of "Pending"
    $status = "Pending";

    // Validate that the required fields are not empty
    if (empty($category) || empty($reason) || empty($start_date) || empty($end_date) || empty($student_email)) {
        echo "Please fill in all required fields.";
    } else {
        // Prepare and execute an SQL query to insert data into the database
        $query = "INSERT INTO leave_application (category, reason, start_date, end_date, student_email, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssss", $category, $reason, $start_date, $end_date, $student_email, $status);

        if ($stmt->execute()) {
            // Insertion was successful
            header("Location: student_dashboard.html"); // Redirect to student dashboard
        } else {
            // Insertion failed
            echo "Error: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
    }
}

// Close the database connection
$mysqli->close();
?>

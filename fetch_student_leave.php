<?php
session_start();
include('db.php');

if (isset($_SESSION['student_email'])) {
    $studentEmail = $_SESSION['student_email'];

    // Get the student's leave applications in progress
    $query = "SELECT * FROM leave_application WHERE student_email = ? AND status = 'In Progress'";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($query);
    if ($stmt === false) {
        die("Error in preparing the query.");
    }
    
    // Bind the student's email to the query
    $stmt->bind_param("s", $studentEmail);
    
    // Execute the query
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();
        
        $applications = array();
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        
        // Close the statement
        $stmt->close();
        
        // Return the leave applications as JSON
        echo json_encode($applications);
    } else {
        die("Error in executing the query: " . $stmt->error);
    }
} else {
    die("Session not set.");
}
?>

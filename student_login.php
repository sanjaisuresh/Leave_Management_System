<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['student_email'];
    $password = $_POST['student_password'];

    // Perform the query to retrieve the student's information
    $query = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password (use password_verify() if using hashed passwords)
        if ($password === $row['password']) {
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_email'] = $row['email'];
            header('Location: student_dashboard.html');
            exit();
        }
    }

    $_SESSION['login_error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit();
}
?>

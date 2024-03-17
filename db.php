<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'leave_management_system';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_eSrror) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php

$host = 'localhost';
$db   = 'your_database_name';
$user = 'root';
$pass = '';

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
session_start();
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default is empty
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

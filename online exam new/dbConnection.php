<?php
// Database connection settings
$host = "localhost"; // For XAMPP, it's usually 'localhost'
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (usually empty)
$dbname = "project1"; // Replace with your phpMyAdmin database name

// Create connection
$con = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Test if the connection is successful
    echo "Database connection successful!";
}
?>

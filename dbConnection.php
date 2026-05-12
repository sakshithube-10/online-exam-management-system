<?php
// Database connection configuration
$servername = "localhost";  // Usually localhost
$username = "root";         // Your database username
$password = "";             // Your database password (empty for XAMPP/WAMP)
$dbname = "project1";       // Your database name

// Create connection (connect to MySQL server only, not DB yet)
$con = mysqli_connect("localhost","root", "","project1");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($con, $sql)) {
    die("Error creating database: " . mysqli_error($con));
}

// Select the database
mysqli_select_db($con, $dbname);

// Create user table if it doesn't exist
$create_table = "CREATE TABLE IF NOT EXISTS user (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    email varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    gender varchar(10) NOT NULL,
    college varchar(100) NOT NULL,
    mob varchar(15) NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

if (!mysqli_query($con, $create_table)) {
    die("Error creating table: " . mysqli_error($con));
}

// Set charset to UTF-8
mysqli_set_charset($con, "utf8");
?>

<?php
include_once 'dbConnection.php';
$name = $_POST['name'];
$gender = $_POST['gender'];
$college = $_POST['college'];
$email = $_POST['email'];
$mob = $_POST['mob'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

// Confirm password check
if ($password !== $cpassword) {
    header("location:index.php?q7=Passwords do not match");
    exit();
}

// Hash password
$password = md5($password); 

// Insert user
$q3 = mysqli_query($con, "INSERT INTO user (name, gender, college, email, mob, password) 
     VALUES ('$name', '$gender', '$college', '$email', '$mob', '$password')");

// Error handling
if (!$q3) {
    // Show MySQL error on failure
    die("Signup failed: " . mysqli_error($con));
} else {
    header("location:index.php?q7=Account created successfully");
}
?>

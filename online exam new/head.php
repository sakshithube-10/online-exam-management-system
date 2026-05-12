<?php
include_once 'dbConnection.php';

// Debugging: Check if $con is properly initialized
if (!$con) {
    die("Database connection failed.");
}

$ref = isset($_GET['q']) ? $_GET['q'] : '';
$email = isset($_POST['uname']) ? $_POST['uname'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Sanitize inputs
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);

// Prepare the SQL statement to prevent SQL injection
$sql = "SELECT email FROM admin WHERE email = ? AND password = ? AND role = 'head'";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    
    // Execute the query
    mysqli_stmt_execute($stmt);
    
    // Get the result
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    
    if ($count == 1) {
        session_start();
        
        if (isset($_SESSION['email'])) {
            session_unset();
        }
        
        $_SESSION["name"] = 'Admin';
        $_SESSION["key"] = 'prasanth123'; // Use a more secure method for session keys
        $_SESSION["email"] = $email;
        
        header("Location: headdash.php?q=0");
    } else {
        header("Location: $ref?w=Warning: Access denied");
    }
    
    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Handle errors
    die('Error preparing the query: ' . mysqli_error($con));
}

// Close connection
mysqli_close($con);
?>

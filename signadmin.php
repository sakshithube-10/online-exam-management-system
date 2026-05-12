
<?php
include_once 'dbConnection.php';
$ref=@$_GET['q'];
//$name = $_POST['name'];
//$name= ucwords(strtolower($name));
//$gender = $_POST['gender'];
$email = $_POST['email'];

$password = $_POST['password'];



$q=mysqli_query($con,"INSERT INTO admin VALUES  ('$email' , '$password' , 'admin')");


header("location:$ref?q=Succesfully registered");
// After successful teacher insertion
header("location:headdash.php?q=4&success=teacher_added");



?>
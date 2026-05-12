<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
// Handle form submission
include_once "dbConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // keep as is
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $mobile = trim($_POST['mob']);
    
    
    // Server-side validation
    $errors = [];
    
    if (empty($name) || !preg_match('/^[A-Za-z\s]+$/', $name)) {
        $errors[] = "Name should contain only alphabets.";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    
    if (strlen($password) < 5 || strlen($password) > 25) {
        $errors[] = "Password must be 5 to 25 characters long.";
    }
    
    if (empty($gender)) {
        $errors[] = "Please select a gender.";
    }
    
    if (empty($college)) {
        $errors[] = "Institution/Stream is required.";
    }
    
    if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "Mobile number must be exactly 10 digits.";
    }
    
    if (empty($errors)) {
         // use your default DB connection
         $password = md5($password);

        // Check if email already exists
        $checkEmail = mysqli_query($con, "SELECT email FROM user WHERE email='$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            $error_message = "Email address already exists. Please use a different email.";
        } else {
            // Insert user
            $q3 = mysqli_query($con, "INSERT INTO user (name, gender, college, email, mob, password) 
                    VALUES ('$name', '$gender', '$college', '$email', '$mobile', '$password')");

                    
            
            if ($q3) {
                $success_message = "Account created successfully! You can now sign in with your credentials.";
            } else {
                $error_message = "Error creating account: " . mysqli_error($con);
            }
        }
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>

<title>Online Examiner</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/font.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>

<script>
function validateForm() {var y = document.forms["form"]["name"].value;  var letters = /^[A-Za-z]+$/;if (y == null || y == "") {alert("Name must be filled out.");return false;}var z =document.forms["form"]["college"].value;if (z == null || z == "") {alert("college must be filled out.");return false;}var x = document.forms["form"]["email"].value;var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {alert("Not a valid e-mail address.");return false;}var a = document.forms["form"]["password"].value;if(a == null || a == ""){alert("Password must be filled out");return false;}if(a.length<5 || a.length>25){alert("Passwords must be 5 to 25 characters long.");return false;}
var b = document.forms["form"]["cpassword"].value;if (a!=b){alert("Passwords must match.");return false;}}
</script>

<style>
/* CSS Reset and Base Styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

:root {
  --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
  --success-color: #10b981;
  --warning-color: #f59e0b;
  --error-color: #ef4444;
  --text-primary: #1f2937;
  --text-secondary: #6b7280;
  --bg-primary: #ffffff;
  --bg-secondary: #f9fafb;
  --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Particle Background Animation */
.particles {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  overflow: hidden;
  pointer-events: none;
}

.particle {
  position: absolute;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  pointer-events: none;
  animation: float 15s infinite ease-in-out;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
    opacity: 0.3;
  }
  25% {
    transform: translateY(-100px) rotate(90deg);
    opacity: 0.8;
  }
  50% {
    transform: translateY(-200px) rotate(180deg);
    opacity: 0.5;
  }
  75% {
    transform: translateY(-100px) rotate(270deg);
    opacity: 0.8;
  }
}

/* Enhanced Typography */
body {
  font-family: 'Inter', sans-serif;
  line-height: 1.6;
  color: var(--text-primary);
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  overflow-x: hidden;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  line-height: 1.2;
  letter-spacing: -0.025em;
}

/* Glowing Text Effect */
.glow-text {
  color: #fff;
  text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
               0 0 20px rgba(255, 255, 255, 0.3),
               0 0 30px rgba(255, 255, 255, 0.2);
  animation: glow-pulse 2s ease-in-out infinite alternate;
}

@keyframes glow-pulse {
  from { text-shadow: 0 0 5px rgba(255, 255, 255, 0.5); }
  to { text-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 30px rgba(255, 255, 255, 0.6); }
}

/* Success Popup Styles */
.success-popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 10000;
  backdrop-filter: blur(10px);
}

.success-popup.show {
  display: flex;
  animation: fadeIn 0.5s ease-out;
}

.success-card {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  padding: 40px;
  border-radius: 20px;
  text-align: center;
  color: white;
  max-width: 500px;
  width: 90%;
  box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
  transform: scale(0.8);
  animation: popIn 0.6s ease-out 0.2s forwards;
}

.success-icon {
  font-size: 80px;
  margin-bottom: 20px;
  animation: bounce 1s ease-out;
}

.success-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 15px;
  animation: slideInUp 0.8s ease-out 0.3s both;
}

.success-message {
  font-size: 1.1rem;
  margin-bottom: 30px;
  opacity: 0.9;
  animation: slideInUp 0.8s ease-out 0.4s both;
}

.success-button {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  border: 2px solid rgba(255, 255, 255, 0.3);
  padding: 12px 30px;
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  animation: slideInUp 0.8s ease-out 0.5s both;
}

.success-button:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}

@keyframes popIn {
  to {
    transform: scale(1);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes bounce {
  0%, 20%, 53%, 80%, 100% {
    transform: translateY(0);
  }
  40%, 43% {
    transform: translateY(-30px);
  }
  70% {
    transform: translateY(-15px);
  }
  90% {
    transform: translateY(-4px);
  }
}

/* Enhanced Gender Select */
.gender-select {
  position: relative;
}

.gender-options {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 2px solid #e5e7eb;
  border-top: none;
  border-radius: 0 0 12px 12px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.gender-option {
  padding: 15px 20px;
  cursor: pointer;
  transition: all 0.2s ease;
  border-bottom: 1px solid #f3f4f6;
  display: flex;
  align-items: center;
}

.gender-option:last-child {
  border-bottom: none;
}

.gender-option:hover {
  background: #f8fafc;
  color: #667eea;
}

.gender-option.selected {
  background: #667eea;
  color: white;
}

.gender-display {
  background: white;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 15px 20px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.gender-display:hover {
  border-color: #9ca3af;
}

.gender-display.active {
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.gender-icon {
  margin-right: 10px;
  font-size: 18px;
}

.dropdown-arrow {
  transition: transform 0.3s ease;
}

.dropdown-arrow.rotated {
  transform: rotate(180deg);
}

/* Modal Enhancements */
.modal {
  text-align: center;
}

.modal-content {
  border: none;
  border-radius: 20px;
  box-shadow: var(--shadow-xl);
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  animation: modalSlideIn 0.5s ease-out;
}

@keyframes modalSlideIn {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.modal-header {
  background: var(--primary-gradient);
  color: white;
  border-radius: 20px 20px 0 0;
  padding: 25px;
  border: none;
}

.modal-body {
  padding: 30px;
}

.modal-footer {
  border: none;
  padding: 20px 30px;
  background: rgba(248, 249, 250, 0.8);
  border-radius: 0 0 20px 20px;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

/* Enhanced Form Styles */
.form-control {
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 15px 20px;
  font-size: 16px;
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
}

.form-control:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  background: white;
  transform: translateY(-2px);
}

.form-control:hover {
  border-color: #9ca3af;
  transform: translateY(-1px);
}

.form-group {
  margin-bottom: 25px;
  position: relative;
}

/* Floating Label Effect */
.floating-label {
  position: relative;
}

.floating-label input {
  padding-top: 20px;
}

.floating-label label {
  position: absolute;
  top: 15px;
  left: 20px;
  color: #9ca3af;
  transition: all 0.3s ease;
  pointer-events: none;
  background: white;
  padding: 0 5px;
}

.floating-label input:focus + label,
.floating-label input:not(:placeholder-shown) + label {
  top: -10px;
  left: 15px;
  font-size: 12px;
  color: #667eea;
  font-weight: 500;
}

/* Enhanced Buttons */
.btn {
  border-radius: 12px;
  padding: 12px 30px;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  border: none;
  position: relative;
  overflow: hidden;
}

.btn:before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.btn:hover:before {
  left: 100%;
}

.btn-primary {
  background: var(--primary-gradient);
  color: white;
  box-shadow: var(--shadow-md);
}

.btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-xl);
  background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}

.btn-default {
  background: white;
  color: var(--text-primary);
  border: 2px solid #e5e7eb;
}

.btn-default:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  border-color: #9ca3af;
}

/* Enhanced Navbar */
.navbar {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border: none;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: var(--shadow-md);
  transition: all 0.3s ease;
  z-index: 9999;
  font-family: 'Poppins', sans-serif;
}

.navbar.scrolled {
  background: rgba(255, 255, 255, 0.98);
  box-shadow: var(--shadow-lg);
}

.navbar-brand {
  font-weight: 700;
  font-size: 24px !important;
  color: var(--text-primary) !important;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  transform: scale(1.05);
  color: #667eea !important;
}

.navbar-nav li a {
  color: var(--text-primary) !important;
  font-weight: 500;
  font-size: 16px !important;
  padding: 15px 20px !important;
  transition: all 0.3s ease;
  position: relative;
}

.navbar-nav li a:before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 0;
  height: 3px;
  background: var(--primary-gradient);
  transition: all 0.3s ease;
  transform: translateX(-50%);
}

.navbar-nav li a:hover:before {
  width: 80%;
}

.navbar-nav li a:hover {
  color: #667eea !important;
  transform: translateY(-2px);
  background: rgba(102, 126, 234, 0.05) !important;
  border-radius: 8px;
}

/* Hero Section */
.jumbotron {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 120px 25px;
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.jumbotron:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1)"/><stop offset="100%" style="stop-color:rgba(255,255,255,0)"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="300" cy="700" r="80" fill="url(%23a)"/><circle cx="700" cy="800" r="120" fill="url(%23a)"/></svg>') no-repeat;
  background-size: cover;
  opacity: 0.3;
  animation: float-bg 20s ease-in-out infinite;
}

@keyframes float-bg {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(5deg); }
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 800px;
  margin: 0 auto;
}

.hero-title {
  font-size: 4rem;
  font-weight: 800;
  margin-bottom: 30px;
  background: linear-gradient(45deg, #fff, #e0e7ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: slideInUp 1s ease-out;
}

.hero-subtitle {
  font-size: 1.5rem;
  margin-bottom: 40px;
  opacity: 0.9;
  animation: slideInUp 1s ease-out 0.2s both;
}

.hero-nav {
  list-style: none;
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
  animation: slideInUp 1s ease-out 0.4s both;
}

.hero-nav li a {
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  padding: 15px 30px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 50px;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  display: inline-block;
}

.hero-nav li a:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  border-color: rgba(255, 255, 255, 0.4);
}

/* Floating Globe Animation */
.floating-globe {
  position: absolute;
  left: 50px;
  top: 100px;
  animation: float-globe 6s ease-in-out infinite;
}

.custom-logo {
  font-size: 120px;
  color: rgba(255, 255, 255, 0.8);
  text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
}

@keyframes float-globe {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
  }
  50% {
    transform: translateY(-30px) rotate(180deg);
  }
}

/* Slide Animations */
@keyframes slideInUp {
  from {
    transform: translateY(60px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.slide-in-left {
  animation: slideInLeft 1s ease-out;
}

.slide-in-right {
  animation: slideInRight 1s ease-out;
}

@keyframes slideInLeft {
  from {
    transform: translateX(-100px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slideInRight {
  from {
    transform: translateX(100px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

/* Content Sections */
.container-fluid {
  padding: 80px 50px;
  position: relative;
}

.section-title {
  font-size: 3rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 60px;
  position: relative;
}

.section-title:after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: var(--primary-gradient);
  border-radius: 2px;
}

/* Enhanced SMARTER Section */
.smarter-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  position: relative;
  overflow: hidden;
  min-height: 100vh;
  display: flex;
  align-items: center;
  color: white;
}

.smarter-section::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 30%, transparent 70%);
  animation: rotate 30s linear infinite;
}

@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.floating-elements {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  pointer-events: none;
}

.floating-icon {
  position: absolute;
  color: rgba(255, 255, 255, 0.1);
  font-size: 60px;
  animation: float-icon 8s ease-in-out infinite;
}

.floating-icon:nth-child(1) {
  top: 20%;
  left: 15%;
  animation-delay: 0s;
}

.floating-icon:nth-child(2) {
  top: 60%;
  left: 85%;
  animation-delay: -2s;
}

.floating-icon:nth-child(3) {
  top: 80%;
  left: 10%;
  animation-delay: -4s;
}

.floating-icon:nth-child(4) {
  top: 10%;
  right: 20%;
  animation-delay: -6s;
}

@keyframes float-icon {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
    opacity: 0.1;
  }
  50% {
    transform: translateY(-20px) rotate(180deg);
    opacity: 0.3;
  }
}

.smarter-title {
  font-size: 4.5rem;
  font-weight: 900;
  margin-bottom: 0;
  position: relative;
  z-index: 2;
}

.smart-text {
  background: linear-gradient(45deg, #00f2fe, #4facfe, #00f2fe);
  background-size: 200% 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: gradient-shift 3s ease-in-out infinite;
  text-shadow: 0 0 30px rgba(0, 242, 254, 0.3);
}

.harder-text {
  color: #fbbf24;
  text-shadow: 0 0 30px rgba(251, 191, 36, 0.5);
  animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes gradient-shift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

@keyframes pulse-glow {
  0%, 100% {
    text-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
    transform: scale(1);
  }
  50% {
    text-shadow: 0 0 40px rgba(251, 191, 36, 0.8), 0 0 60px rgba(251, 191, 36, 0.4);
    transform: scale(1.05);
  }
}

.feature-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-top: 40px;
}

.feature-item {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 15px;
  padding: 25px;
  text-align: center;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.feature-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.6s ease;
}

.feature-item:hover::before {
  left: 100%;
}

.feature-item:hover {
  transform: translateY(-10px) scale(1.05);
  background: rgba(255, 255, 255, 0.15);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.feature-item i {
  font-size: 40px;
  margin-bottom: 15px;
  color: #00f2fe;
  display: block;
}

.feature-item h5 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
  color: white;
}

.feature-item p {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}

.image-container {
  position: relative;
  z-index: 2;
}

.main-image {
  border-radius: 20px;
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
  transition: all 0.4s ease;
  position: relative;
}

.main-image:hover {
  transform: translateY(-10px) rotateY(5deg);
  box-shadow: 0 40px 80px rgba(0, 0, 0, 0.4);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, rgba(102, 126, 234, 0.3), rgba(116, 75, 162, 0.3));
  border-radius: 20px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.main-image:hover .image-overlay {
  opacity: 1;
}

.stats-container {
  display: flex;
  justify-content: space-around;
  margin-top: 50px;
  position: relative;
  z-index: 2;
}

.stat-item {
  text-align: center;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 15px;
  padding: 30px 20px;
  min-width: 150px;
  transition: all 0.3s ease;
}

.stat-item:hover {
  transform: translateY(-5px);
  background: rgba(255, 255, 255, 0.15);
}

.stat-number {
  font-size: 3rem;
  font-weight: 800;
  color: #00f2fe;
  display: block;
  margin-bottom: 10px;
}

.stat-label {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.cta-button {
  background: linear-gradient(45deg, #00f2fe, #4facfe);
  color: white;
  border: none;
  padding: 18px 40px;
  border-radius: 50px;
  font-size: 18px;
  font-weight: 600;
  margin-top: 30px;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(79, 172, 254, 0.4);
}

.cta-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s ease;
}

.cta-button:hover::before {
  left: 100%;
}

.cta-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 40px rgba(79, 172, 254, 0.6);
}

.animated-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="pulse1" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(0,242,254,0.1)"/><stop offset="100%" style="stop-color:rgba(0,242,254,0)"/></radialGradient><radialGradient id="pulse2" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(79,172,254,0.1)"/><stop offset="100%" style="stop-color:rgba(79,172,254,0)"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23pulse1)" opacity="0.8"/><circle cx="800" cy="600" r="120" fill="url(%23pulse2)" opacity="0.6"/><circle cx="600" cy="300" r="100" fill="url(%23pulse1)" opacity="0.4"/></svg>') no-repeat;
  background-size: cover;
  animation: pulse-bg 8s ease-in-out infinite;
  pointer-events: none;
}

@keyframes pulse-bg {
  0%, 100% {
    opacity: 0.3;
    transform: scale(1);
  }
  50% {
    opacity: 0.6;
    transform: scale(1.1);
  }
}

/* Responsive Design for SMARTER section */
@media (max-width: 768px) {
  .smarter-title {
    font-size: 2.5rem;
  }
  
  .feature-grid {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .stats-container {
    flex-direction: column;
    gap: 20px;
  }
  
  .stat-item {
    min-width: auto;
  }
  
  .floating-icon {
    font-size: 40px;
  }
}

/* Feature Cards */
.feature-card {
  background: white;
  border-radius: 20px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  margin-bottom: 30px;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.feature-card:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: var(--primary-gradient);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.feature-card:hover:before {
  transform: scaleX(1);
}

.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: var(--shadow-xl);
}

.feature-icon {
  font-size: 60px;
  color: #667eea;
  margin-bottom: 25px;
  display: block;
  transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
  transform: scale(1.1) rotate(5deg);
  color: #5a67d8;
}

.feature-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 15px;
  color: var(--text-primary);
}

.feature-description {
  color: var(--text-secondary);
  font-size: 16px;
  line-height: 1.6;
  flex-grow: 1;
  display: flex;
  align-items: center;
}

/* Services Section */
#services {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  position: relative;
  padding: 80px 0;
}

#services .row {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
}

#services .row > [class*="col-"] {
  display: flex;
  margin-bottom: 30px;
}

/* Responsive adjustments for services */
@media (max-width: 991px) {
  #services .col-md-4 {
    flex: 0 0 50%;
    max-width: 50%;
  }
}

@media (max-width: 767px) {
  #services .col-sm-6 {
    flex: 0 0 100%;
    max-width: 100%;
  }
  
  .feature-card {
    margin-bottom: 20px;
  }
}

/* Testimonials */
.carousel-inner {
  padding: 40px 0;
}

.item {
  padding: 0 100px;
}

.item h4 {
  font-size: 24px;
  font-style: italic;
  color: var(--text-primary);
  line-height: 1.6;
  margin-bottom: 20px;
}

.item span {
  font-weight: 600;
  color: #667eea;
}

.carousel-indicators li {
  background-color: #667eea;
  border: 2px solid #667eea;
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.carousel-indicators li.active {
  background-color: #5a67d8;
  transform: scale(1.2);
}

.carousel-control {
  background: none !important;
  border: none;
  color: #667eea !important;
  font-size: 30px;
  transition: all 0.3s ease;
}

.carousel-control:hover {
  color: #5a67d8 !important;
  transform: scale(1.1);
}

/* About Section */
#about {
  background: white;
  padding: 100px 50px;
}

.about-content {
  font-size: 18px;
  line-height: 1.8;
  color: var(--text-secondary);
}

.about-image {
  text-align: center;
  position: relative;
}

.about-image img {
  max-width: 100%;
  height: auto;
  border-radius: 20px;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
}

.about-image:hover img {
  transform: scale(1.05);
  box-shadow: var(--shadow-xl);
}

/* Contact Section */
#contact {
  background: var(--dark-gradient);
  color: white;
  position: relative;
  overflow: hidden;
}

#contact:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,0 1000,300 1000,1000 0,700"/></svg>') no-repeat;
  background-size: cover;
}

.contact-info {
  position: relative;
  z-index: 2;
}

.contact-info h5 {
  font-size: 18px;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 15px;
}

.contact-info .glyphicon {
  font-size: 20px;
  color: #4facfe;
}

/* Enhanced Footer */
footer {
  background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
  color: white;
  padding: 60px 0 30px;
  text-align: center;
  position: relative;
}

footer:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
}

footer .glyphicon {
  font-size: 30px;
  color: #4facfe;
  transition: all 0.3s ease;
}

footer a:hover .glyphicon {
  transform: translateY(-5px);
  color: #00f2fe;
}

footer p {
  font-size: 16px;
  opacity: 0.8;
  margin-top: 20px;
}

/* Loading Animation */
.loading {
  display: inline-block;
  width: 30px;
  height: 30px;
  border: 3px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Pulse Animation */
.pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

/* Fade In Animation */
.fade-in {
  animation: fadeIn 1s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Bounce Animation */
.bounce {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 53%, 80%, 100% {
    transform: translateY(0);
  }
  40%, 43% {
    transform: translateY(-30px);
  }
  70% {
    transform: translateY(-15px);
  }
  90% {
    transform: translateY(-4px);
  }
}

/* Responsive Enhancements */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-subtitle {
    font-size: 1.2rem;
  }
  
  .hero-nav {
    flex-direction: column;
    gap: 15px;
  }
  
  .floating-globe {
    display: none;
  }
  
  .container-fluid {
    padding: 60px 20px;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .item {
    padding: 0 20px;
  }
  
  .feature-card {
    margin-bottom: 20px;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .jumbotron {
    padding: 80px 15px;
  }
  
  .navbar-brand {
    font-size: 20px !important;
  }
  
  .navbar-nav li a {
    font-size: 14px !important;
    padding: 10px 15px !important;
  }
}

/* Additional Modern Effects */
.glass-effect {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.gradient-text {
  background: var(--primary-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.shadow-glow {
  box-shadow: 0 0 40px rgba(102, 126, 234, 0.3);
}

.transform-hover:hover {
  transform: translateY(-5px) scale(1.02);
  transition: all 0.3s ease;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: var(--primary-gradient);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}

/* Enhanced Hover States */
.hover-lift {
  transition: all 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-10px);
  box-shadow: var(--shadow-xl);
}

.hover-glow:hover {
  box-shadow: 0 0 30px rgba(102, 126, 234, 0.4);
}

/* Text Selection */
::selection {
  background: rgba(102, 126, 234, 0.2);
  color: inherit;
}

::-moz-selection {
  background: rgba(102, 126, 234, 0.2);
  color: inherit;
}

/* Focus States */
button:focus,
input:focus,
select:focus,
textarea:focus {
  outline: 2px solid #667eea;
  outline-offset: 2px;
}

/* Status Indicators */
.status-online {
  color: var(--success-color);
}

.status-warning {
  color: var(--warning-color);
}

.status-error {
  color: var(--error-color);
}

/* Progress Indicators */
.progress-ring {
  width: 60px;
  height: 60px;
  transform: rotate(-90deg);
}

.progress-ring circle {
  stroke: #667eea;
  stroke-width: 4;
  stroke-dasharray: 188.5;
  stroke-dashoffset: 188.5;
  fill: transparent;
  transition: stroke-dashoffset 0.3s ease;
}

/* Notification Styles */
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  background: white;
  border-radius: 12px;
  box-shadow: var(--shadow-lg);
  padding: 20px;
  max-width: 350px;
  z-index: 10000;
  animation: slideInRight 0.3s ease-out;
}

.notification.success {
  border-left: 4px solid var(--success-color);
}

.notification.warning {
  border-left: 4px solid var(--warning-color);
}

.notification.error {
  border-left: 4px solid var(--error-color);
}

/* Enhanced Typography Hierarchy */
.text-xs { font-size: 0.75rem; }
.text-sm { font-size: 0.875rem; }
.text-base { font-size: 1rem; }
.text-lg { font-size: 1.125rem; }
.text-xl { font-size: 1.25rem; }
.text-2xl { font-size: 1.5rem; }
.text-3xl { font-size: 1.875rem; }
.text-4xl { font-size: 2.25rem; }
.text-5xl { font-size: 3rem; }

.font-light { font-weight: 300; }
.font-normal { font-weight: 400; }
.font-medium { font-weight: 500; }
.font-semibold { font-weight: 600; }
.font-bold { font-weight: 700; }
.font-extrabold { font-weight: 800; }

/* Spacing Utilities */
.space-y-1 > * + * { margin-top: 0.25rem; }
.space-y-2 > * + * { margin-top: 0.5rem; }
.space-y-3 > * + * { margin-top: 0.75rem; }
.space-y-4 > * + * { margin-top: 1rem; }
.space-y-5 > * + * { margin-top: 1.25rem; }
.space-y-6 > * + * { margin-top: 1.5rem; }

/* Layout Utilities */
.flex { display: flex; }
.flex-col { flex-direction: column; }
.items-center { align-items: center; }
.justify-center { justify-content: center; }
.justify-between { justify-content: space-between; }
.justify-around { justify-content: space-around; }

.grid { display: grid; }
.grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }

.gap-1 { gap: 0.25rem; }
.gap-2 { gap: 0.5rem; }
.gap-3 { gap: 0.75rem; }
.gap-4 { gap: 1rem; }
.gap-5 { gap: 1.25rem; }
.gap-6 { gap: 1.5rem; }

/* Border Utilities */
.rounded { border-radius: 0.25rem; }
.rounded-md { border-radius: 0.375rem; }
.rounded-lg { border-radius: 0.5rem; }
.rounded-xl { border-radius: 0.75rem; }
.rounded-2xl { border-radius: 1rem; }
.rounded-full { border-radius: 9999px; }

/* Shadow Utilities */
.shadow { box-shadow: var(--shadow-sm); }
.shadow-md { box-shadow: var(--shadow-md); }
.shadow-lg { box-shadow: var(--shadow-lg); }
.shadow-xl { box-shadow: var(--shadow-xl); }

/* Color Utilities */
.text-primary { color: var(--text-primary); }
.text-secondary { color: var(--text-secondary); }
.bg-primary { background-color: var(--bg-primary); }
.bg-secondary { background-color: var(--bg-secondary); }

/* Interactive Elements */
.interactive {
  cursor: pointer;
  user-select: none;
  transition: all 0.2s ease;
}

.interactive:hover {
  opacity: 0.8;
}

.interactive:active {
  transform: scale(0.98);
}

/* Accessibility */
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

/* Print Styles */
@media print {
  * {
    background: white !important;
    color: black !important;
    box-shadow: none !important;
    text-shadow: none !important;
  }
  
  .navbar, footer, .modal { display: none; }
  .container-fluid { padding: 20px 0; }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
  :root {
    --text-primary: #000000;
    --text-secondary: #333333;
    --bg-primary: #ffffff;
    --bg-secondary: #f5f5f5;
  }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
  /* Dark mode styles would go here if needed */
}

/* Container Queries */
@container (max-width: 768px) {
  .feature-card {
    padding: 30px 20px;
  }
}

/* Modern CSS Grid Layout */
.grid-auto-fit {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
}

.grid-auto-fill {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

/* Aspect Ratios */
.aspect-square {
  aspect-ratio: 1 / 1;
}

.aspect-video {
  aspect-ratio: 16 / 9;
}

.aspect-photo {
  aspect-ratio: 4 / 3;
}

/* Modern Clamp for Responsive Text */
.text-fluid-sm {
  font-size: clamp(0.875rem, 2vw, 1rem);
}

.text-fluid-base {
  font-size: clamp(1rem, 2.5vw, 1.125rem);
}

.text-fluid-lg {
  font-size: clamp(1.125rem, 3vw, 1.25rem);
}

.text-fluid-xl {
  font-size: clamp(1.25rem, 4vw, 1.5rem);
}

.text-fluid-2xl {
  font-size: clamp(1.5rem, 5vw, 2rem);
}

.text-fluid-3xl {
  font-size: clamp(1.875rem, 6vw, 2.5rem);
}

.text-fluid-4xl {
  font-size: clamp(2.25rem, 7vw, 3rem);
}

/* Logical Properties */
.margin-inline { margin-inline: 1rem; }
.padding-inline { padding-inline: 1rem; }
.margin-block { margin-block: 1rem; }
.padding-block { padding-block: 1rem; }

/* Modern Color Functions */
.accent-color {
  accent-color: #667eea;
}

/* Enhanced Form Validation */
.form-control:valid {
  border-color: var(--success-color);
}

.form-control:invalid {
  border-color: var(--error-color);
}

.form-control:valid + .validation-icon::before {
  content: '✓';
  color: var(--success-color);
}

.form-control:invalid + .validation-icon::before {
  content: '✗';
  color: var(--error-color);
}

/* Enhanced Button States */
.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none !important;
}

.btn:disabled:hover {
  transform: none !important;
}

/* Loading States */
.btn.loading {
  position: relative;
  color: transparent;
}

.btn.loading::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 20px;
  height: 20px;
  border: 2px solid currentColor;
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

/* Enhanced Modal Backdrop */
.modal-backdrop {
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(4px);
}

/* Enhanced Dropdown */
.dropdown-menu {
  border: none;
  border-radius: 12px;
  box-shadow: var(--shadow-xl);
  overflow: hidden;
  margin-top: 10px;
}

.dropdown-menu li a {
  padding: 12px 20px;
  transition: all 0.2s ease;
}

.dropdown-menu li a:hover {
  background: rgba(102, 126, 234, 0.1);
  color: #667eea;
  transform: translateX(5px);
}

/* Enhanced Navigation */
.nav-pills {
  border-radius: 50px;
  background: rgba(102, 126, 234, 0.1);
  padding: 5px;
}

.nav-pills li a {
  border-radius: 50px;
  margin: 0 2px;
  transition: all 0.3s ease;
}

.nav-pills li.active a {
  background: var(--primary-gradient);
  color: white;
}

/* Enhanced Pagination */
.pagination {
  border-radius: 50px;
  overflow: hidden;
  box-shadow: var(--shadow-md);
}

.pagination li a {
  border: none;
  color: var(--text-primary);
  padding: 12px 20px;
  transition: all 0.2s ease;
}

.pagination li.active a {
  background: var(--primary-gradient);
  color: white;
}

.pagination li a:hover {
  background: rgba(102, 126, 234, 0.1);
  transform: translateY(-2px);
}

/* Enhanced Progress Bars */
.progress {
  height: 12px;
  border-radius: 50px;
  background: rgba(102, 126, 234, 0.1);
  overflow: hidden;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

.progress-bar {
  background: var(--primary-gradient);
  border-radius: 50px;
  transition: width 0.6s ease;
  position: relative;
  overflow: hidden;
}

.progress-bar::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  animation: progress-shine 2s infinite;
}

@keyframes progress-shine {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

/* Enhanced Alerts */
.alert {
  border: none;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}

.alert::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
}

.alert-success::before { background: var(--success-color); }
.alert-warning::before { background: var(--warning-color); }
.alert-danger::before { background: var(--error-color); }
.alert-info::before { background: #667eea; }

/* Enhanced Tables */
.table {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: var(--shadow-md);
}

.table thead th {
  background: var(--primary-gradient);
  color: white;
  font-weight: 600;
  border: none;
  padding: 20px;
}

.table tbody tr {
  transition: all 0.2s ease;
}

.table tbody tr:hover {
  background: rgba(102, 126, 234, 0.05);
  transform: scale(1.005);
}

.table tbody td {
  border-color: rgba(0, 0, 0, 0.05);
  padding: 15px 20px;
  vertical-align: middle;
}

/* Enhanced Badge */
.badge {
  font-size: 0.75rem;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 50px;
  letter-spacing: 0.5px;
}

.badge-primary { background: var(--primary-gradient); }
.badge-success { background: var(--success-color); }
.badge-warning { background: var(--warning-color); }
.badge-danger { background: var(--error-color); }

/* Custom Scrollbar for Webkit */
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.1);
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: var(--primary-gradient);
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}

/* Enhanced Tooltips */
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 200px;
  background: rgba(0, 0, 0, 0.9);
  color: white;
  text-align: center;
  border-radius: 8px;
  padding: 10px;
  position: absolute;
  z-index: 1000;
  bottom: 125%;
  left: 50%;
  margin-left: -100px;
  opacity: 0;
  transition: opacity 0.3s ease;
  font-size: 14px;
  backdrop-filter: blur(10px);
}

.tooltip .tooltiptext::after {
  content: '';
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: rgba(0, 0, 0, 0.9) transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<!-- Success Popup -->
<div class="success-popup" id="successPopup">
  <div class="success-card">
    <div class="success-icon">
      <i class="fas fa-check-circle"></i>
    </div>
    <h2 class="success-title">Account Created Successfully!</h2>
    <p class="success-message" id="successMessage">Welcome to ExamPortal! Your account has been created and you can now sign in.</p>
    <button class="success-button" onclick="closeSuccessPopup()">
      <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
      Continue to Sign In
    </button>
  </div>
</div>

<!-- Particle Background -->
<div class="particles">
  <div class="particle" style="left: 10%; animation-delay: 0s; width: 4px; height: 4px;"></div>
  <div class="particle" style="left: 20%; animation-delay: 2s; width: 6px; height: 6px;"></div>
  <div class="particle" style="left: 30%; animation-delay: 4s; width: 3px; height: 3px;"></div>
  <div class="particle" style="left: 40%; animation-delay: 1s; width: 5px; height: 5px;"></div>
  <div class="particle" style="left: 50%; animation-delay: 3s; width: 4px; height: 4px;"></div>
  <div class="particle" style="left: 60%; animation-delay: 5s; width: 7px; height: 7px;"></div>
  <div class="particle" style="left: 70%; animation-delay: 2s; width: 3px; height: 3px;"></div>
  <div class="particle" style="left: 80%; animation-delay: 4s; width: 5px; height: 5px;"></div>
  <div class="particle" style="left: 90%; animation-delay: 1s; width: 6px; height: 6px;"></div>
</div>

<!-- Enhanced Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand pulse" href="#myPage">
        <i class="fas fa-graduation-cap" style="margin-right: 10px; color: #667eea;"></i>
        <span class="gradient-text">ExamPortal</span>
      </a> 
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#login" class="transform-hover">
          <i class="fas fa-user-shield" style="margin-right: 8px;"></i>ADMIN
        </a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModal" class="transform-hover">
          <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>SIGN IN
        </a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModal1" class="transform-hover">
          <i class="fas fa-user-plus" style="margin-right: 8px;"></i>SIGN UP
        </a></li>
        <li><a href="#" data-toggle="modal" data-target="#login2" class="transform-hover">
          <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>TEACHER
        </a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Enhanced Hero Section -->
<div class="jumbotron text-center fade-in">
  <!-- Floating Globe -->
  <div class="floating-globe">
    <i class="fas fa-globe custom-logo bounce"></i>
  </div>

  <!-- Hero Content -->
  <div class="hero-content">
    <h1 class="hero-title ">Online Examination System</h1>
    <p class="hero-subtitle">Transform Your Assessment Experience with Modern Technology</p>
    
    <!-- Navigation Links -->
    <ul class="hero-nav">
      <li><a href="#services" class="hover-glow">
        <i class="fas fa-cogs" style="margin-right: 10px;"></i>SERVICES
      </a></li>
      <li><a href="#about" class="hover-glow">
        <i class="fas fa-info-circle" style="margin-right: 10px;"></i>ABOUT
      </a></li>
      <li><a href="#contact" class="hover-glow">
        <i class="fas fa-envelope" style="margin-right: 10px;"></i>CONTACT
      </a></li>
    </ul>
  </div>
</div>

<!-- Enhanced Admin Modal -->
<div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content glass-effect">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">
          <i class="fas fa-user-shield" style="margin-right: 15px;"></i>
          <span class="glow-text">ADMIN LOGIN</span>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="post" action="head.php?q=index.php" class="space-y-4">
              <div class="form-group floating-label">
                <input type="text" name="uname" maxlength="20" placeholder=" " class="form-control" required/>
                <label>Admin User ID</label>
              </div>
              <div class="form-group floating-label">
                <input type="password" name="password" maxlength="15" placeholder=" " class="form-control" required/>
                <label>Password</label>
              </div>
              <div class="form-group text-center">
                <button type="submit" name="login" class="btn btn-primary hover-lift">
                  <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                  Login to Dashboard
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Teacher Modal -->
<div class="modal fade" id="login2">
  <div class="modal-dialog">
    <div class="modal-content glass-effect">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">
          <i class="fas fa-chalkboard-teacher" style="margin-right: 15px;"></i>
          <span class="glow-text">TEACHER LOGIN</span>
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="post" action="admin.php?q=index.php" class="space-y-4">
              <div class="form-group floating-label">
                <input type="text" name="uname" maxlength="20" placeholder=" " class="form-control" required/>
                <label>Teacher User ID</label>
              </div>
              <div class="form-group floating-label">
                <input type="password" name="password" maxlength="15" placeholder=" " class="form-control" required/>
                <label>Password</label>
              </div>
              <div class="form-group text-center">
                <button type="submit" name="login2" class="btn btn-primary hover-lift">
                  <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>
                  Access Teacher Panel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced SMARTER NOT HARDER Section -->
<div class="container-fluid smarter-section">
  <!-- Animated Background Elements -->
  <div class="animated-bg"></div>
  
  <!-- Floating Icons -->
  <div class="floating-elements">
    <i class="fas fa-brain floating-icon"></i>
    <i class="fas fa-lightbulb floating-icon"></i>
    <i class="fas fa-rocket floating-icon"></i>
    <i class="fas fa-star floating-icon"></i>
  </div>

  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 slide-in-left">
        <h1 class="smarter-title">
          Manage <span class="smart-text">SMARTER</span>
        </h1>
        <h1 class="smarter-title">
          Not <span class="harder-text">HARDER!!</span>
        </h1>
        
        <p class="text-fluid-lg mb-6" style="color: rgba(255, 255, 255, 0.9); line-height: 1.8;">
          Easy to get started and intuitive to use. Our platform equips you with 
          all the power and functionality you need to create secure exams for your students, your way.
        </p>

        <!-- Feature Grid -->
        <div class="feature-grid">
          <div class="feature-item">
            <i class="fas fa-bolt"></i>
            <h5>Lightning Fast</h5>
            <p>Quick setup and instant results</p>
          </div>
          <div class="feature-item">
            <i class="fas fa-shield-alt"></i>
            <h5>Secure Platform</h5>
            <p>Bank-level security for your data</p>
          </div>
          <div class="feature-item">
            <i class="fas fa-chart-line"></i>
            <h5>Real-time Analytics</h5>
            <p>Track performance instantly</p>
          </div>
          <div class="feature-item">
            <i class="fas fa-mobile-alt"></i>
            <h5>Mobile Ready</h5>
            <p>Works on any device, anywhere</p>
          </div>
        </div>

        
      </div>
      
      <div class="col-md-6 text-center slide-in-right">
        <div class="image-container">
          <img src="https://images.pexels.com/photos/5940721/pexels-photo-5940721.jpeg?auto=compress&cs=tinysrgb&w=600" 
               alt="Smart Exam Management" 
               class="img-fluid main-image" 
               style="max-width: 85%; border-radius: 20px;">
          <div class="image-overlay"></div>
        </div>

        <!-- Statistics -->
        <div class="stats-container">
          <div class="stat-item">
            <span class="stat-number">98%</span>
            <span class="stat-label">Success Rate</span>
          </div>
         
          
          <div class="stat-item">
            <span class="stat-number">10,000</span>
            <span class="stat-label">Happy Users</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Sign In Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content glass-effect">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">
          <i class="fas fa-sign-in-alt" style="margin-right: 15px;"></i>
          <span class="glow-text">USER LOGIN</span>
        </h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal space-y-4" action="login.php?q=index.php" method="POST">
          <div class="form-group floating-label">
            <input id="email" name="email" placeholder=" " class="form-control" type="email" required>
            <label for="email">Email Address</label>
            <div class="validation-icon"></div>
          </div>
          <div class="form-group floating-label">
            <input id="password" name="password" placeholder=" " class="form-control" type="password" required>
            <label for="password">Password</label>
            <div class="validation-icon"></div>
          </div>
          <div class="form-group">
            
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary hover-lift w-full">
              <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
              Sign In
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer text-center">
        <p class="text-secondary">
          Don't have an account? 
          <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal1" class="text-primary font-semibold">
            Sign up here
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Sign Up Modal -->
<div class="modal fade" id="myModal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content glass-effect">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">
          <i class="fas fa-user-plus" style="margin-right: 15px;"></i>
          <span class="glow-text">CREATE ACCOUNT</span>
        </h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" name="form" action="index.php" method="POST" onSubmit="return validateForm()">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group floating-label">
                <input id="name" name="name" placeholder=" " class="form-control" type="text" required>
                <label for="name">Full Name</label>
                <div class="validation-icon"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="gender-select">
                  <div class="gender-display" id="genderDisplay" onclick="toggleGenderDropdown()">
                    <span id="genderText">Select Gender</span>
                    <i class="fas fa-chevron-down dropdown-arrow" id="genderArrow"></i>
                  </div>
                  <div class="gender-options" id="genderOptions">
                    <div class="gender-option" onclick="selectGender('M', 'Male')">
                      <i class="fas fa-mars gender-icon" style="color: #3B82F6;"></i>
                      <span>Male</span>
                    </div>
                    <div class="gender-option" onclick="selectGender('F', 'Female')">
                      <i class="fas fa-venus gender-icon" style="color: #EC4899;"></i>
                      <span>Female</span>
                    </div>
                    <div class="gender-option" onclick="selectGender('Other', 'Other')">
                      <i class="fas fa-genderless gender-icon" style="color: #8B5CF6;"></i>
                      <span>Other</span>
                    </div>
                  </div>
                  <input type="hidden" id="gender" name="gender" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group floating-label">
                <input id="college" name="college" placeholder=" " class="form-control" type="text" required>
                <label for="college">Institution/Stream</label>
                <div class="validation-icon"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group floating-label">
                <input id="mob" name="mob" placeholder=" " class="form-control" type="tel" pattern="[0-9]{10}" required>
                <label for="mob">Mobile Number</label>
                <div class="validation-icon"></div>
              </div>
            </div>
          </div>
          <div class="form-group floating-label">
            <input id="email_2" name="email" placeholder=" " class="form-control" type="email" required>
            <label for="email_2">Email Address</label>
            <div class="validation-icon"></div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group floating-label">
                <input id="password_2" name="password" placeholder=" " class="form-control" type="password" minlength="5" maxlength="25" required>
                <label for="password_2">Password</label>
                <div class="validation-icon"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group floating-label">
                <input id="cpassword" name="cpassword" placeholder=" " class="form-control" type="password" required>
                <label for="cpassword">Confirm Password</label>
                <div class="validation-icon"></div>
              </div>
            </div>
          </div>
          
          <?php if(isset($error_message)) { ?>
            <div class="alert alert-danger">
              <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error_message; ?>
            </div>
          <?php } ?>
          
          <div class="form-group">
            <label class="flex items-center">
              <input type="checkbox" class="accent-color mr-2" required>
              <span class="text-sm text-secondary">
                I agree to the <a href="#" class="text-primary">Terms of Service</a> and 
                <a href="#" class="text-primary">Privacy Policy</a>
              </span>
            </label>
          </div>
          
          <div class="form-group text-center">
            <button type="submit" name="signup" class="btn btn-primary hover-lift w-full">
              <i class="fas fa-user-plus" style="margin-right: 8px;"></i>
              Create Account
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer text-center">
        <p class="text-secondary">
          Already have an account? 
          <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal" class="text-primary font-semibold">
            Sign in here
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
// Gender Selection Functions
function toggleGenderDropdown() {
    const options = document.getElementById('genderOptions');
    const arrow = document.getElementById('genderArrow');
    const display = document.getElementById('genderDisplay');
    
    if (options.style.display === 'block') {
        options.style.display = 'none';
        arrow.classList.remove('rotated');
        display.classList.remove('active');
    } else {
        options.style.display = 'block';
        arrow.classList.add('rotated');
        display.classList.add('active');
    }
}

function selectGender(value, text) {
    document.getElementById('gender').value = value;
    document.getElementById('genderText').innerHTML = `<i class="fas fa-${value === 'M' ? 'mars' : value === 'F' ? 'venus' : 'genderless'} gender-icon" style="color: ${value === 'M' ? '#3B82F6' : value === 'F' ? '#EC4899' : '#8B5CF6'};"></i> ${text}`;
    
    // Remove previous selections and add selected class
    document.querySelectorAll('.gender-option').forEach(option => {
        option.classList.remove('selected');
    });
    event.target.closest('.gender-option').classList.add('selected');
    
    toggleGenderDropdown();
    
    // Add success styling
    document.getElementById('genderDisplay').style.borderColor = '#10b981';
    document.getElementById('genderDisplay').style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const genderSelect = document.querySelector('.gender-select');
    if (!genderSelect.contains(event.target)) {
        document.getElementById('genderOptions').style.display = 'none';
        document.getElementById('genderArrow').classList.remove('rotated');
        document.getElementById('genderDisplay').classList.remove('active');
    }
});

function validateForm() {
    // Name validation - only alphabets
    var name = document.getElementById("name").value;
    var namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(name)) {
        showError("name", "Name should contain only alphabets.");
        return false;
    }

    // Gender validation
    var gender = document.getElementById("gender").value;
    if (gender === "") {
        alert("Please select a gender.");
        return false;
    }

    // Mobile number validation - 10 digits
    var mob = document.getElementById("mob").value;
    if (mob.length != 10 || isNaN(mob)) {
        showError("mob", "Mobile number must be exactly 10 digits.");
        return false;
    }

    // Email validation
    var email = document.getElementById("email").value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        showError("email", "Please enter a valid email address.");
        return false;
    }

    // Password validation
    var password = document.getElementById("password").value;
    var password = document.getElementById("cpassword").value;
    
    if (password.length < 5 || password.length > 25) {
        showError("password", "Password must be 5 to 25 characters long.");
        return false;
    }
    
    if (password !== password) {
        showError("cpassword", "Passwords do not match.");
        return false;
    }

    return true;
}

function showError(fieldId, message) {
    var field = document.getElementById(fieldId);
    field.style.borderColor = '#ef4444';
    field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
    
    // Remove existing error message
    var existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Add new error message
    var errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.color = '#ef4444';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>' + message;
    field.parentNode.appendChild(errorDiv);
    
    alert(message);
}

// Success Popup Functions
function showSuccessPopup(message, userName) {
    document.getElementById('successMessage').textContent = message;
    document.getElementById('successPopup').classList.add('show');
}

function closeSuccessPopup() {
    document.getElementById('successPopup').classList.remove('show');
    $('#myModal1').modal('hide');
    $('#myModal').modal('show');
}

<?php if(isset($success_message)) { ?>
    // Show success popup
    $(document).ready(function() {
        $('#myModal1').modal('hide');
        showSuccessPopup("<?php echo $success_message; ?>", "<?php echo htmlspecialchars($name ?? ''); ?>");
    });
<?php } ?>
</script>

<!-- Enhanced Services Section -->
<div id="services" class="container-fluid text-center bg-secondary">
  <div class="section-title fade-in">
    <h2 class="text-primary mb-4">Our Services</h2>
    <p class="text-fluid-lg text-secondary">Discover what makes our platform unique</p>
  </div>
  
  <div class="row">
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-users feature-icon"></i>
        <h4 class="feature-title">Multi-User Platform</h4>
        <p class="feature-description">Support for unlimited students, teachers, and administrators on a single platform.</p>
      </div>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-dollar-sign feature-icon"></i>
        <h4 class="feature-title">Cost Optimized</h4>
        <p class="feature-description">Significantly reduces paperwork and operational costs while maintaining quality.</p>
      </div>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-smile feature-icon"></i>
        <h4 class="feature-title">User Satisfaction</h4>
        <p class="feature-description">Intuitive interface designed with user experience as the top priority.</p>
      </div>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-leaf feature-icon"></i>
        <h4 class="feature-title">Eco-Friendly</h4>
        <p class="feature-description">Go paperless and contribute to environmental conservation efforts.</p>
      </div>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-headset feature-icon"></i>
        <h4 class="feature-title">24/7 Support</h4>
        <p class="feature-description">Round-the-clock customer support to help you whenever you need assistance.</p>
      </div>
    </div>
    
    <div class="col-sm-6 col-md-4 col-lg-4">
      <div class="feature-card hover-lift">
        <i class="fas fa-shield-alt feature-icon"></i>
        <h4 class="feature-title">Secure & Reliable</h4>
        <p class="feature-description">Advanced security measures to protect your data and ensure reliable performance.</p>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Testimonials Section -->
<div class="container-fluid py-5">
  <h2 class="section-title text-center fade-in">What Our Users Say</h2>
  
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="testimonial-card glass-effect">
          <i class="fas fa-quote-left" style="font-size: 40px; color: #667eea; margin-bottom: 20px;"></i>
          <h4>"Very good initiative. I am so happy with the result! The platform has transformed how we conduct examinations."</h4>
          <div class="testimonial-author">
           
            <span><strong>Michael Roe</strong><br>Vice President </span>
          </div>
        </div>
      </div>
      
      <div class="item">
        <div class="testimonial-card glass-effect">
          <i class="fas fa-quote-left" style="font-size: 40px; color: #667eea; margin-bottom: 20px;"></i>
          <h4>"One word... WOW!! The user interface is incredibly intuitive and the features are exactly what we needed."</h4>
          <div class="testimonial-author">
            <span><strong>John Doe</strong><br>Salesman  </span>
          </div>
        </div>
      </div>
      
      <div class="item">
        <div class="testimonial-card glass-effect">
          <i class="fas fa-quote-left" style="font-size: 40px; color: #667eea; margin-bottom: 20px;"></i>
          <h4>"Could I... BE any more happy with this startup? The support team is amazing and the platform is robust."</h4>
          <div class="testimonial-author">
            <span><strong>Chandler Bing</strong><br>Actor </span>
          </div>
        </div>
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="fas fa-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="fas fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Enhanced About Section -->
<div id="about" class="container-fluid bg-secondary">
  <div class="row align-items-center">
    <div class="col-sm-8 slide-in-left">
      <h2 class="section-title text-left">About Our Platform</h2>
      <div class="about-content space-y-4">
        <h4 class="font-semibold text-primary mb-4">Revolutionizing Online Education</h4>
        <p>
          Online examination System is conducting a test online to measure the knowledge of the 
          participants on a given topic. In the olden days everybody had to gather in a classroom 
          at the same time to take an exam. With online examination students can do the exam online, 
          in their own time and with their own device, regardless where they live. You only need a 
          browser and internet connection.
        </p>
        <p>
          Online Examination System (OES) is a platform to hold online examinations. It caters to 
          many requirements of holding online examinations. The system can generate statistical data 
          for records. The system makes it possible to maintain a repository of questions, and then 
          generate papers at a later stage, such that the lecturer has more flexibility over holding 
          online quizzes. Furthermore, it provides the functionality to mark the papers automatically.
        </p>
        
        <!-- Feature Highlights -->
        <div class="row mt-5">
          <div class="col-md-6">
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Automated Grading</span>
            </div>
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Question Bank Management</span>
            </div>
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Statistical Reports</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Mobile Responsive</span>
            </div>
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Real-time Monitoring</span>
            </div>
            <div class="flex items-center mb-3">
              <i class="fas fa-check-circle text-success mr-3"></i>
              <span class="font-medium">Secure Environment</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-sm-4 text-center slide-in-right">
      <div class="about-image">
        <div class="relative">
          <i class="fas fa-chart-line" style="font-size: 120px; color: #667eea; margin-bottom: 30px;"></i>
          <img src="pie-chart.png" alt="Analytics" class="img-fluid shadow-xl rounded-2xl" style="max-width: 80%;">
        </div>
        
        <!-- Statistics Cards -->
        <div class="mt-5 space-y-3">
          <div class="glass-effect p-4 rounded-lg">
            <h3 class="text-2xl font-bold text-primary">10,000+</h3>
            <p class="text-secondary">Active Users</p>
          </div>
          <div class="glass-effect p-4 rounded-lg">
            <h3 class="text-2xl font-bold text-primary">50,000+</h3>
            <p class="text-secondary">Exams Conducted</p>
          </div>
          <div class="glass-effect p-4 rounded-lg">
            <h3 class="text-2xl font-bold text-primary">99.9%</h3>
            <p class="text-secondary">Uptime</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Contact Section -->
<div id="contact" class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="contact-info space-y-6">
        <h2 class="section-title text-left text-white mb-5">Get In Touch</h2>
        <p class="text-fluid-lg text-white opacity-90 mb-6"><h4>
          Contact us and we'll see through your request. We're here to help you succeed.
  </h4></p>
        
        <div class="space-y-4">
          <div class="flex items-center space-x-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full">
              <i class="fas fa-map-marker-alt text-white"></i>
            </div>
            <div>
              <h5 class="text-white font-semibold">Location</h5>
              <p class="text-white opacity-80">Mumbai, India</p>
            </div>
          </div>
          
          <div class="flex items-center space-x-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full">
              <i class="fas fa-phone text-white"></i>
            </div>
            <div>
              <h5 class="text-white font-semibold">Phone</h5>
              <p class="text-white opacity-80">+91 7977865701</p>
            </div>
          </div>
          
          <div class="flex items-center space-x-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full">
              <i class="fas fa-envelope text-white"></i>
            </div>
            <div>
              <h5 class="text-white font-semibold">Email</h5>
              <p class="text-white opacity-80">sakshithube49@gmail.com</p>
            </div>
          </div>
        </div>
        
        <!-- Social Media Links -->
        
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="glass-effect p-6 rounded-2xl">
        <h3 class="text-2xl font-bold text-primary mb-4">Send Us a Message</h3>
        
        <?php if(@$_GET['q']) {
          echo '<div class="alert alert-success">
                  <i class="fas fa-check-circle mr-2"></i>'.@$_GET['q'].'
                </div>';
        } else { ?>
        
        <form role="form" method="post" action="feed.php?q=index.php" class="space-y-4">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group floating-label">
                <input class="form-control" id="name_2" name="name" placeholder=" " type="text" required>
                <label for="name_2">Full Name</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group floating-label">
                <input class="form-control" id="email_3" name="email" placeholder=" " type="email" required>
                <label for="email_3">Email Address</label>
              </div>
            </div>
          </div>
          
          <div class="form-group floating-label">
            <input class="form-control" id="subject" name="subject" placeholder=" " type="text" required>
            <label for="subject">Subject</label>
          </div>
          
          <div class="form-group floating-label">
            <textarea class="form-control" id="feedback" name="feedback" placeholder=" " rows="5" required></textarea>
            <label for="feedback">Your Message</label>
          </div>
          
          <div class="form-group text-center">
            <button class="btn btn-primary hover-lift w-full" name="submit" type="submit">
              <i class="fas fa-paper-plane mr-2"></i>
              Send Message
            </button>
          </div>
        </form>
        
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Footer -->
<footer class="container-fluid text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="#myPage" title="Back to Top" class="inline-block hover-lift">
          <i class="fas fa-chevron-up text-3xl"></i>
        </a>
        
        <div class="mt-4">
          <h4 class="font-bold text-white mb-2">ExamPortal</h4>
          <p class="text-white opacity-80 mb-4">Transforming Education Through Technology</p>
          
          <!-- Quick Links -->
          <div class="flex justify-center space-x-6 mb-6">
            <a href="#services" class="text-white hover:text-blue-300 transition-colors">Services</a>
            <a href="#about" class="text-white hover:text-blue-300 transition-colors">About</a>
            <a href="#contact" class="text-white hover:text-blue-300 transition-colors">Contact</a>
            
          </div>
          
          <div class="border-t border-white border-opacity-20 pt-6">
            <p class="text-white opacity-60">
              © 2025 ExamPortal. All rights reserved. Thank you for visiting us.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Enhanced JavaScript -->
<script>
$(document).ready(function(){
  // Smooth scrolling
  $(".navbar a, footer a[href='#myPage'], .hero-nav a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 70
      }, 800, function(){
        window.location.hash = hash;
      });
    }
  });
  
  // Navbar scroll effect
  $(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
      $('.navbar').addClass('scrolled');
    } else {
      $('.navbar').removeClass('scrolled');
    }
    
    // Scroll animations
    $(".fade-in, .slide-in-left, .slide-in-right").each(function(){
      var pos = $(this).offset().top;
      var winTop = $(window).scrollTop();
      
      if (pos < winTop + $(window).height() - 100) {
        $(this).addClass("animated");
      }
    });
  });
  
  // Form validation feedback
  $('.form-control').on('input', function() {
    if (this.validity.valid) {
      $(this).removeClass('is-invalid').addClass('is-valid');
    } else {
      $(this).removeClass('is-valid').addClass('is-invalid');
    }
  });
  
  // Password strength indicator
  $('#password').on('input', function() {
    var password = $(this).val();
    var strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    var indicator = $(this).siblings('.password-strength');
    if (indicator.length === 0) {
      indicator = $('<div class="password-strength mt-2"></div>').insertAfter(this);
    }
    
    var strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
    var strengthColors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#16a34a'];
    
    if (password.length > 0) {
      indicator.html('<div style="height: 4px; background: ' + strengthColors[strength-1] + '; width: ' + (strength * 20) + '%; transition: all 0.3s;"></div>');
      indicator.append('<small style="color: ' + strengthColors[strength-1] + ';">' + strengthText[strength-1] + '</small>');
    } else {
      indicator.empty();
    }
  });
  
  // Auto-hide alerts
  $('.alert').delay(5000).fadeOut();
  
  // Loading states for buttons
  $('form').on('submit', function() {
    var submitBtn = $(this).find('button[type="submit"]');
    var originalText = submitBtn.html();
    
    submitBtn.addClass('loading').prop('disabled', true);
    submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Processing...');
    
    setTimeout(function() {
      submitBtn.removeClass('loading').prop('disabled', false).html(originalText);
    }, 3000);
  });
  
  // Tooltip initialization
  $('[data-toggle="tooltip"]').tooltip();
  
  // Animate counters
  $('.counter').each(function() {
    var $this = $(this);
    var countTo = $this.attr('data-count');
    
    $({ countNum: $this.text()}).animate({
      countNum: countTo
    }, {
      duration: 2000,
      easing: 'linear',
      step: function() {
        $this.text(Math.floor(this.countNum));
      },
      complete: function() {
        $this.text(this.countNum);
      }
    });
  });

  // Counter animation for statistics
  function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      obj.innerHTML = Math.floor(progress * (end - start) + start) + (obj.dataset.suffix || '');
      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    };
    window.requestAnimationFrame(step);
  }

  // Trigger counter animation when section is in view
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const statNumbers = entry.target.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
          const finalValue = stat.textContent.replace(/[^0-9]/g, '');
          if (finalValue && !stat.classList.contains('animated')) {
            stat.classList.add('animated');
            animateValue(stat, 0, parseInt(finalValue), 2000);
          }
        });
      }
    });
  });

  const smarterSection = document.querySelector('.smarter-section');
  if (smarterSection) {
    observer.observe(smarterSection);
  }
});

// Enhanced form validation
function validateForm() {
  var isValid = true;
  
  // Name validation
  var name = document.getElementById("name").value;
  var namePattern = /^[A-Za-z\s]+$/;
  if (!namePattern.test(name) || name.trim() === "") {
    showError("name", "Name should contain only alphabets.");
    isValid = false;
  } else {
    showSuccess("name");
  }

  // Mobile validation
  var mob = document.getElementById("mob").value;
  if (mob.length !== 10 || isNaN(mob)) {
    showError("mob", "Mobile number must be exactly 10 digits.");
    isValid = false;
  } else {
    showSuccess("mob");
  }

  // Email validation
  var email = document.getElementById("email").value;
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    showError("email", "Please enter a valid email address.");
    isValid = false;
  } else {
    showSuccess("email");
  }

  // Password validation
  var password = document.getElementById("password").value;
  var password = document.getElementById("cpassword").value;
  
  if (password.length < 5 || password.length > 25) {
    showError("password", "Password must be 5 to 25 characters long.");
    isValid = false;
  } else if (password !== password) {
    showError("cpassword", "Passwords do not match.");
    isValid = false;
  } else {
    showSuccess("password");
    showSuccess("cpassword");
  }

  return isValid;
}

function showError(fieldId, message) {
  var field = document.getElementById(fieldId);
  field.classList.add('is-invalid');
  field.classList.remove('is-valid');
  
  var errorDiv = field.parentNode.querySelector('.invalid-feedback');
  if (!errorDiv) {
    errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    field.parentNode.appendChild(errorDiv);
  }
  errorDiv.textContent = message;
}

function showSuccess(fieldId) {
  var field = document.getElementById(fieldId);
  field.classList.add('is-valid');
  field.classList.remove('is-invalid');
  
  var errorDiv = field.parentNode.querySelector('.invalid-feedback');
  if (errorDiv) {
    errorDiv.remove();
  }
}

// Notification system
function showNotification(message, type = 'success') {
  var notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.innerHTML = `
    <div class="flex items-center">
      <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-3"></i>
      <span>${message}</span>
      <button onclick="this.parentNode.parentNode.remove()" class="ml-auto text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
  `;
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.opacity = '0';
    setTimeout(() => notification.remove(), 300);
  }, 5000);
}

// Theme switching capability
function toggleTheme() {
  document.body.classList.toggle('dark-mode');
  localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

// Initialize theme on page load
if (localStorage.getItem('darkMode') === 'true') {
  document.body.classList.add('dark-mode');
}

// Performance monitoring
const observerAnimation = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-in');
    }
  });
});

document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
  observerAnimation.observe(el);
});


</script>

<!-- Additional CSS for enhanced styling -->
<style>
.testimonial-card {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(20px);
  border-radius: 20px;
  padding: 40px;
  margin: 20px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.testimonial-author {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.is-valid {
  border-color: var(--success-color) !important;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
}

.is-invalid {
  border-color: var(--error-color) !important;
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
}

.invalid-feedback {
  color: var(--error-color);
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

.animate-in {
  animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.w-full {
  width: 100%;
}

.leading-relaxed {
  line-height: 1.8;
}

.space-x-4 > * + * {
  margin-left: 1rem;
}

.space-x-6 > * + * {
  margin-left: 1.5rem;
}

.mr-2 { margin-right: 0.5rem; }
.mr-3 { margin-right: 0.75rem; }
.ml-3 { margin-left: 0.75rem; }
.ml-auto { margin-left: auto; }
.mt-2 { margin-top: 0.5rem; }
.mt-3 { margin-top: 0.75rem; }
.mt-4 { margin-top: 1rem; }
.mt-5 { margin-top: 1.25rem; }
.mt-6 { margin-top: 1.5rem; }
.mt-8 { margin-top: 2rem; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 0.75rem; }
.mb-4 { margin-bottom: 1rem; }
.mb-5 { margin-bottom: 1.25rem; }
.mb-6 { margin-bottom: 1.5rem; }

.p-3 { padding: 0.75rem; }
.p-4 { padding: 1rem; }
.p-6 { padding: 1.5rem; }
.py-5 { padding-top: 1.25rem; padding-bottom: 1.25rem; }

.opacity-60 { opacity: 0.6; }
.opacity-80 { opacity: 0.8; }
.opacity-90 { opacity: 0.9; }

.transition-colors {
  transition: color 0.3s ease;
}

.border-t {
  border-top: 1px solid;
}

.border-opacity-20 {
  border-color: rgba(255, 255, 255, 0.2);
}

.pt-6 {
  padding-top: 1.5rem;
}

.inline-block {
  display: inline-block;
}

.relative {
  position: relative;
}

.absolute {
  position: absolute;
}

.top-4 {
  top: 1rem;
}

.right-4 {
  right: 1rem;
}

.px-3 {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
}

.py-1 {
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
}

.rounded-full {
  border-radius: 50%;
}

.font-semibold {
  font-weight: 600;
}

.hover\:text-blue-300:hover {
  color: #93c5fd;
}

.hover\:text-gray-700:hover {
  color: #374151;
}

/* Additional modern enhancements */
.bg-opacity-20 {
  background-color: rgba(255, 255, 255, 0.2);
}

.text-3xl {
  font-size: 1.875rem;
}

/* Custom animations for specific elements */
@keyframes pulse-glow {
  0%, 100% {
    box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
  }
  50% {
    box-shadow: 0 0 30px rgba(102, 126, 234, 0.6), 0 0 40px rgba(102, 126, 234, 0.3);
  }
}

.pulse-glow {
  animation: pulse-glow 2s infinite;
}

/* Loading skeleton animation */
@keyframes skeleton {
  0% {
    background-position: -200px 0;
  }
  100% {
    background-position: calc(200px + 100%) 0;
  }
}

.skeleton {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200px 100%;
  animation: skeleton 1.5s infinite linear;
}

/* Enhanced focus management */
.focus\:outline-none:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.focus\:ring-2:focus {
  --ring-offset-shadow: var(--ring-inset) 0 0 0 var(--ring-offset-width) var(--ring-offset-color);
  --ring-shadow: var(--ring-inset) 0 0 0 calc(2px + var(--ring-offset-width)) var(--ring-color);
  box-shadow: var(--ring-offset-shadow), var(--ring-shadow), var(--shadow, 0 0 #0000);
}

/* Print optimization */
@media print {
  .no-print {
    display: none !important;
  }
  
  .print-break {
    page-break-before: always;
  }
  
  .print-avoid-break {
    page-break-inside: avoid;
  }
}
</style>

</body>
</html>
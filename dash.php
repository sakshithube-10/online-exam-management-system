<?php
include_once 'dbConnection.php';
session_start();
$email=$_SESSION['email'];
if(!(isset($_SESSION['email']))){
    header("location:index.php");
    exit();
}
else
{
    $name = $_SESSION['name'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Teacher Dashboard - Online Examiner</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/font.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet'>

<!--alert message - ONLY show after adding questions-->
<?php 
// FIXED: Only show success message after questions are added
if(@$_GET['w'] && @$_GET['success'] == 'questions') {
    echo'<script>
    $(document).ready(function() {
        showQuestionsSuccessPopup("'.addslashes(@$_GET['test_name']).'", "'.@$_GET['question_count'].'");
    });
    </script>';
} else if(@$_GET['w'] && @$_GET['success'] != 'questions') {
    echo'<script>alert("'.@$_GET['w'].'");</script>';
}
?>
<!--alert message end-->

<style>
/* Modern CSS Variables */
:root {
  --primary-color: #3B82F6;
  --secondary-color: #14B8A6;
  --accent-color: #F97316;
  --success-color: #10B981;
  --warning-color: #F59E0B;
  --error-color: #EF4444;
  --dark-color: #1E293B;
  --light-color: #F8FAFC;
  --gradient-primary: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
  --gradient-secondary: linear-gradient(135deg, #14B8A6 0%, #0D9488 100%);
  --gradient-success: linear-gradient(135deg, #10B981 0%, #059669 100%);
  --gradient-warning: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Reset and Base Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', 'Roboto', sans-serif;
  background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
  background-attachment: fixed;
  color: #1e293b;
  overflow-x: hidden;
}

/* Enhanced Header */
.header {
  background: var(--gradient-primary);
  color: white;
  padding: 25px 20px;
  text-align: center;
  box-shadow: var(--shadow-lg);
  position: relative;
  overflow: hidden;
}

.header::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% { left: -100%; }
  100% { left: 100%; }
}

.header .pull-right {
  animation: slideInRight 0.8s ease-out;
}

/* Enhanced Navigation */
.navbar {
  background: rgba(255, 255, 255, 0.95) !important;
  backdrop-filter: blur(10px);
  border: none !important;
  box-shadow: var(--shadow-md);
  transition: all 0.3s ease;
  border-radius: 0 !important;
  position: relative;
  z-index: 1000;
}

.navbar-fixed-top {
  animation: slideDown 0.5s ease-out;
  position: fixed !important;
  top: 0;
  width: 100%;
  z-index: 1030 !important;
}

@keyframes slideDown {
  from { transform: translateY(-100%); }
  to { transform: translateY(0); }
}

.navbar-brand {
  font-weight: 700 !important;
  font-size: 24px !important;
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  transform: scale(1.05);
}

.navbar-nav > li > a {
  font-weight: 500 !important;
  color: var(--dark-color) !important;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.navbar-nav > li > a::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: var(--gradient-primary);
  transition: left 0.3s ease;
}

.navbar-nav > li > a:hover::before,
.navbar-nav > li.active > a::before {
  left: 0;
}

.navbar-nav > li > a:hover,
.navbar-nav > li.active > a {
  color: var(--primary-color) !important;
  transform: translateY(-2px);
  background: rgba(59, 130, 246, 0.05) !important;
}

/* FIXED: Enhanced dropdown menu z-index and visibility */
.dropdown-menu {
  border: none !important;
  box-shadow: var(--shadow-xl) !important;
  border-radius: 12px !important;
  overflow: hidden;
  z-index: 9999 !important;
  position: absolute !important;
  background: rgba(255, 255, 255, 0.98) !important;
  backdrop-filter: blur(10px) !important;
  margin-top: 2px !important;
}

.navbar-nav .dropdown:hover .dropdown-menu {
  display: block;
  z-index: 9999 !important;
}

.dropdown-menu > li > a {
  transition: all 0.3s ease !important;
  padding: 12px 20px !important;
  font-weight: 500 !important;
}

.dropdown-menu > li > a:hover {
  background: var(--gradient-primary) !important;
  color: white !important;
  transform: translateX(5px) !important;
}

/* Enhanced Container */
.container {
  animation: fadeInUp 0.8s ease-out;
  margin-top: 20px;
  position: relative;
  z-index: 1;
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

/* Modern Panel Styling */
.panel {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  box-shadow: var(--shadow-xl);
  border: 1px solid rgba(255, 255, 255, 0.2);
  margin: 20px 0;
  overflow: hidden;
  transition: all 0.3s ease;
  animation: cardSlideIn 0.6s ease-out;
  position: relative;
  z-index: 1;
}

@keyframes cardSlideIn {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.panel:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl), 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Enhanced Table Styling */
.table {
  margin: 0 !important;
  background: transparent !important;
  font-size: 14px;
  position: relative;
  z-index: 1;
}

.table thead tr {
  background: var(--gradient-primary);
}

.table thead th,
.table thead td {
  color: white !important;
  font-weight: 600 !important;
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 0.5px;
  padding: 15px 12px !important;
  border: none !important;
}

.table tbody tr {
  transition: all 0.3s ease;
  border-bottom: 1px solid rgba(0,0,0,0.05) !important;
  position: relative;
  z-index: 1;
}

.table tbody tr:hover {
  background: rgba(59, 130, 246, 0.05) !important;
  transform: translateX(5px);
  box-shadow: inset 3px 0 0 var(--primary-color);
  z-index: 2;
}

.table tbody td {
  padding: 12px !important;
  vertical-align: middle !important;
  border: none !important;
}

/* Enhanced Buttons */
.btn {
  border-radius: 12px !important;
  padding: 12px 24px !important;
  font-weight: 600 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
  transition: all 0.3s ease !important;
  border: none !important;
  position: relative !important;
  overflow: hidden !important;
  margin: 2px !important;
  z-index: 10 !important;
}

.btn-primary {
  background: var(--gradient-primary) !important;
  color: white !important;
}

.btn-success {
  background: var(--gradient-success) !important;
  color: white !important;
}

.btn-warning {
  background: var(--gradient-warning) !important;
  color: white !important;
}

.btn-danger {
  background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
  color: white !important;
}

.btn:hover {
  transform: translateY(-3px) !important;
  box-shadow: var(--shadow-lg) !important;
}

/* Form Styling */
.form-control {
  border-radius: 12px !important;
  border: 2px solid rgba(59, 130, 246, 0.1) !important;
  padding: 15px 20px !important;
  font-size: 14px !important;
  transition: all 0.3s ease !important;
  background: rgba(255, 255, 255, 0.9) !important;
}

.form-control:focus {
  border-color: var(--primary-color) !important;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
  background: white !important;
}

.form-group {
  margin-bottom: 25px !important;
}

.form-group label {
  font-weight: 600 !important;
  color: var(--dark-color) !important;
  margin-bottom: 8px !important;
  font-size: 14px !important;
}

/* Quiz Form Container */
.quiz-form-container {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 40px;
  margin: 20px 0;
  box-shadow: var(--shadow-xl);
  animation: cardSlideIn 0.6s ease-out;
  position: relative;
  z-index: 1;
}

.quiz-form-title {
  text-align: center;
  color: var(--primary-color);
  font-weight: 700;
  margin-bottom: 30px;
  font-size: 28px;
}

/* Question Container */
.question-container {
  background: rgba(248, 250, 252, 0.8);
  border-radius: 12px;
  padding: 25px;
  margin: 20px 0;
  border-left: 4px solid var(--primary-color);
  transition: all 0.3s ease;
}

.question-container:hover {
  background: rgba(59, 130, 246, 0.05);
  transform: translateX(5px);
}

.question-number {
  background: var(--gradient-primary);
  color: white;
  padding: 8px 16px;
  border-radius: 20px;
  font-weight: 600;
  display: inline-block;
  margin-bottom: 15px;
}

/* Duration Badge Styling */
.duration-badge {
  background: var(--gradient-warning);
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 12px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.duration-badge:before {
  content: '⏰';
}

/* Answer Selection Styling */
.answer-select {
  position: relative;
}

.answer-select option:checked {
  background: var(--success-color) !important;
  color: white !important;
  font-weight: bold !important;
}

.answer-selected {
  background: rgba(16, 185, 129, 0.1) !important;
  border-color: var(--success-color) !important;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
}

.answer-selected::after {
  content: '✓ Selected';
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--success-color);
  font-weight: bold;
  font-size: 12px;
  pointer-events: none;
}

/* Status Indicators */
.status-completed {
  position: relative;
}

.status-completed::after {
  content: '';
  position: absolute;
  left: -10px;
  top: 50%;
  width: 4px;
  height: 100%;
  background: var(--success-color);
  transform: translateY(-50%);
  border-radius: 2px;
  animation: glow 2s infinite alternate;
}

@keyframes glow {
  from { box-shadow: 0 0 5px var(--success-color); }
  to { box-shadow: 0 0 20px var(--success-color); }
}

/* Notification badge */
.notification-badge {
  background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
  color: white;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 600;
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
  40% { transform: translateY(-3px); }
  60% { transform: translateY(-2px); }
}

/* Modal Enhancements */
.modal-content {
  border-radius: 16px;
  border: none;
  box-shadow: var(--shadow-xl);
}

.modal-header {
  background: var(--gradient-primary);
  color: white;
  border-radius: 16px 16px 0 0;
  border: none;
}

.modal-footer {
  border: none;
  border-radius: 0 0 16px 16px;
}

/* Loading Animation */
.loading {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(59, 130, 246, 0.3);
  border-radius: 50%;
  border-top-color: var(--primary-color);
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Section Spacing */
.section-spacing {
  margin: 40px 0;
}

/* Enhanced Title Styling */
.title1 {
  font-family: 'Inter', sans-serif !important;
  font-weight: 600 !important;
}

/* Stats Cards */
.stats-card {
  background: var(--gradient-primary);
  color: white;
  padding: 25px;
  border-radius: 16px;
  text-align: center;
  margin: 10px 0;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-md);
}

.stats-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
}

.stats-number {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.stats-label {
  font-size: 14px;
  opacity: 0.9;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* ENHANCED: Questions Success Popup Modal Styles */
.questions-success-popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000;
  animation: fadeIn 0.5s ease-out;
}

.questions-success-popup-content {
  background: white;
  padding: 50px;
  border-radius: 25px;
  text-align: center;
  max-width: 600px;
  width: 90%;
  box-shadow: var(--shadow-xl), 0 30px 60px rgba(0,0,0,0.3);
  animation: bounceIn 0.8s ease-out;
  position: relative;
  overflow: hidden;
}

.questions-success-popup-content::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
  animation: rotate 4s linear infinite;
}

.questions-success-icon {
  font-size: 100px;
  margin-bottom: 25px;
  animation: pulse 2s infinite;
  filter: drop-shadow(0 0 20px rgba(16, 185, 129, 0.3));
}

.questions-success-title {
  font-size: 32px;
  font-weight: 700;
  color: var(--success-color);
  margin-bottom: 20px;
  text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.questions-success-message {
  font-size: 18px;
  color: var(--dark-color);
  margin-bottom: 30px;
  line-height: 1.8;
}

.questions-success-details {
  background: linear-gradient(135deg, #10B981 0%, #059669 100%);
  color: white;
  padding: 20px;
  border-radius: 15px;
  margin: 25px 0;
  font-weight: 600;
}

.confetti-piece {
  position: absolute;
  width: 12px;
  height: 12px;
  animation: confetti 4s ease-out infinite;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes bounceIn {
  0% {
    opacity: 0;
    transform: scale(0.3) rotate(-10deg);
  }
  50% {
    opacity: 1;
    transform: scale(1.1) rotate(5deg);
  }
  70% {
    transform: scale(0.95) rotate(-2deg);
  }
  100% {
    opacity: 1;
    transform: scale(1) rotate(0deg);
  }
}

@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.15); }
}

@keyframes confetti {
  0% {
    opacity: 1;
    transform: translateY(0) rotate(0deg);
  }
  100% {
    opacity: 0;
    transform: translateY(150px) rotate(720deg);
  }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .header { padding: 15px 10px; }
  .container { padding: 0 10px; }
  .panel { margin: 10px 0; border-radius: 12px; }
  .table tbody tr:hover { transform: none; }
  .quiz-form-container { padding: 20px; }
  .quiz-form-title { font-size: 24px; }
  .dropdown-menu { position: relative !important; }
  .questions-success-popup-content { padding: 30px; }
  .questions-success-title { font-size: 28px; }
  .questions-success-icon { font-size: 80px; }
}

/* Alert Styling */
.alert-custom {
  border: none;
  border-radius: 12px;
  padding: 20px;
  margin: 20px 0;
  font-weight: 500;
}

.alert-success-custom {
  background: rgba(16, 185, 129, 0.1);
  color: var(--success-color);
  border-left: 4px solid var(--success-color);
}

.alert-warning-custom {
  background: rgba(245, 158, 11, 0.1);
  color: var(--warning-color);
  border-left: 4px solid var(--warning-color);
}

.alert-error-custom {
  background: rgba(239, 68, 68, 0.1);
  color: var(--error-color);
  border-left: 4px solid var(--error-color);
}
</style>

<?php
// FIXED: Create a robust function to handle duration extraction from database
function getDuration($row) {
    // Check if time field exists and has a valid value
    if (isset($row['time'])) {
        // Handle different data types: string, integer, float
        $time_value = trim($row['time']);
        
        // Convert to integer and validate
        if (is_numeric($time_value)) {
            $duration = intval($time_value);
            // Ensure duration is within reasonable range (1 to 300 minutes)
            if ($duration >= 1 && $duration <= 300) {
                return $duration;
            }
        }
        
        // Try to parse if it's stored with text (e.g., "30 minutes", "5 min")
        if (preg_match('/(\d+)/', $time_value, $matches)) {
            $duration = intval($matches[1]);
            if ($duration >= 1 && $duration <= 300) {
                return $duration;
            }
        }
    }
    
    // Return default of 30 minutes only if no valid time found
    return 30;
}
?>

</head>

<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
</div>
<div class="col-md-4 col-md-offset-2">
<?php
echo '<span class="pull-right top title1"><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Welcome,</span> <a href="dash.php?q=0" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=dash.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</a></span>';
?>
</div>
</div>
</div>

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php?q=0"><b>Teacher Dashboard</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar left">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dash.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dash.php?q=1"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Scores</a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dash.php?q=2"><span class="glyphicon glyphicon-trophy" aria-hidden="true"></span>&nbsp;Ranking</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5 || @$_GET['q']==6) echo'active'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Tests<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dash.php?q=4"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add Test</a></li>
            <li><a href="dash.php?q=5"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Remove Test</a></li>
            <li><a href="dash.php?q=6"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Edit Test</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->

<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==0) {
$result = mysqli_query($con,"SELECT * FROM quiz where email='$email' ORDER BY date DESC") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-list-alt"></span> My Created Tests</h3>';
echo '</div>';

// Stats Overview
$total_tests = mysqli_num_rows($result);
$total_attempts = 0;
$active_tests = 0;

mysqli_data_seek($result, 0);
while($row = mysqli_fetch_array($result)) {
    $eid = $row['eid'];
    $attempts_query = mysqli_query($con,"SELECT COUNT(*) as count FROM history WHERE eid='$eid'");
    $attempts_row = mysqli_fetch_array($attempts_query);
    $total_attempts += $attempts_row['count'];
    $active_tests++;
}

echo '<div style="padding: 30px;">';
echo '<div class="row" style="margin-bottom: 30px;">';
echo '<div class="col-md-4"><div class="stats-card"><div class="stats-number">'.$total_tests.'</div><div class="stats-label">Total Tests</div></div></div>';
echo '<div class="col-md-4"><div class="stats-card" style="background: var(--gradient-success);"><div class="stats-number">'.$total_attempts.'</div><div class="stats-label">Total Attempts</div></div></div>';
echo '<div class="col-md-4"><div class="stats-card" style="background: var(--gradient-warning);"><div class="stats-number">'.$active_tests.'</div><div class="stats-label">Active Tests</div></div></div>';
echo '</div>';
echo '</div>';

echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Total Marks</b></td><td><b>+ve Marks</b></td><td><b>-ve Marks</b></td><td><b>Duration</b></td><td><b>Actions</b></td></tr></thead>';
echo '<tbody>';

mysqli_data_seek($result, 0);
$c=1;
while($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $total = $row['total'];
    $sahi = $row['sahi'];
    $wrong = $row['wrong'];
    // FIXED: Use the robust duration function
    $time = getDuration($row);
    $eid = $row['eid'];
    
    $attempts_query = mysqli_query($con,"SELECT COUNT(*) as count FROM history WHERE eid='$eid'");
    $attempts_row = mysqli_fetch_array($attempts_query);
    $attempt_count = $attempts_row['count'];
    
    echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong>';
    if($attempt_count > 0) {
        echo '&nbsp;<span title="'.$attempt_count.' students attempted" class="glyphicon glyphicon-user" style="color: var(--success-color);"></span>';
    }
    echo '</td><td>'.$total.'</td><td><span style="color: var(--success-color);">'.$sahi*$total.'</span></td><td><span style="color: var(--success-color);">+'.$sahi.'</span></td><td><span style="color: var(--error-color);">-'.$wrong.'</span></td>';
    echo '<td><span class="duration-badge">'.$time.' min</span></td>';
    echo '<td>';
    echo '<a href="dash.php?q=6&eid='.$eid.'" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>';
    echo '<a href="update.php?q=rmquiz&eid='.$eid.'" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this test?\')"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>';
    echo '</td></tr>';
}
echo '</tbody></table></div></div>';
}?>

<!--score details-->
<?php
if(@$_GET['q']== 1) 
{
$q=mysqli_query($con,"SELECT distinct q.title,u.name,u.college,h.score,h.date from user u,history h,quiz q where q.email='$email' and q.eid=h.eid and h.email=u.email order by q.eid DESC")or die('Error197');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-stats"></span> Student Scores</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Test Title</b></td><td><b>Student Name</b></td><td><b>Stream</b></td><td><b>Score</b></td><td><b>Date</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row=mysqli_fetch_array($q) )
{
    $title=$row['title'];
    $name=$row['name'];
    $college=$row['college'];
    $score=$row['score'];
    $date=$row['date'];
    echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong></td><td>'.$name.'</td><td>'.$college.'</td><td><span style="color: var(--primary-color); font-weight: 700;">'.$score.'</span></td><td>'.$date.'</td></tr>';
}
echo '</tbody></table></div></div>';
}?>

<!--ranking start-->
<?php
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM rank ORDER BY score DESC " )or die('Error223');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-trophy"></span> Student Rankings</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Stream</b></td><td><b>Total Score</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row=mysqli_fetch_array($q) )
{
    $e=$row['email'];
    $s=$row['score'];
    $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
    while($row12=mysqli_fetch_array($q12) )
    {
        $name=$row12['name'];
        $gender=$row12['gender'];
        $college=$row12['college'];
    }
    
    $rank_class = '';
    if($c == 1) $rank_class = 'style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #1e293b;"';
    elseif($c == 2) $rank_class = 'style="background: linear-gradient(135deg, #c0c0c0 0%, #e5e5e5 100%); color: #1e293b;"';
    elseif($c == 3) $rank_class = 'style="background: linear-gradient(135deg, #cd7f32 0%, #daa520 100%); color: white;"';
    
    echo '<tr '.$rank_class.'><td><span class="notification-badge">'.$c.'</span></td><td><strong>'.$name.'</strong></td><td>'.$gender.'</td><td>'.$college.'</td><td><span style="font-weight: 700;">'.$s.'</span></td></tr>';
    $c++;
}
echo '</tbody></table></div></div>';
}?>

<!--add quiz start-->
<?php
if(@$_GET['q']==4 && !(@$_GET['step'])) {
echo '<div class="section-spacing">';
echo '<div class="quiz-form-container">';
echo '<h2 class="quiz-form-title"><span class="glyphicon glyphicon-plus-sign"></span> Create New Test</h2>';
echo '<form class="form-horizontal title1" name="quizForm" action="dash.php?q=4&step=1" method="POST" onsubmit="return validateQuizForm()">';

echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div class="form-group">';
echo '<label for="name">Test Title *</label>';
echo '<input id="name" name="name" class="form-control" type="text" placeholder="Enter an engaging test title" required minlength="3" maxlength="100">';
echo '</div>';
echo '</div>';

echo '<div class="col-md-6">';
echo '<div class="form-group">';
echo '<label for="total">Number of Questions *</label>';
echo '<input id="total" name="total" class="form-control" type="number" min="1" max="100" placeholder="e.g., 10" required>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-md-4">';
echo '<div class="form-group">';
echo '<label for="right">Marks per Correct Answer *</label>';
echo '<input id="right" name="right" class="form-control" type="number" step="0.01" min="0.01" placeholder="e.g., 1" required>';
echo '</div>';
echo '</div>';

echo '<div class="col-md-4">';
echo '<div class="form-group">';
echo '<label for="wrong">Negative Marking *</label>';
echo '<input id="wrong" name="wrong" class="form-control" type="number" step="0.01" min="0" placeholder="e.g., 0.25" required>';
echo '</div>';
echo '</div>';

echo '<div class="col-md-4">';
echo '<div class="form-group">';
echo '<label for="time">Test Duration (minutes) *</label>';
echo '<input id="time" name="time" class="form-control" type="number" min="1" max="300" placeholder="e.g., 30" required>';
echo '<small class="help-block" style="color: #6B7280; margin-top: 5px;">Duration must be between 1 and 300 minutes</small>';
echo '</div>';
echo '</div>';
echo '</div>';

// Real-time preview of test settings
echo '<div class="alert-custom alert-success-custom" id="testPreview" style="display: none;">';
echo '<span class="glyphicon glyphicon-info-sign"></span> ';
echo '<strong>Test Preview:</strong>';
echo '<div id="previewContent" style="margin-top: 10px; font-size: 14px;"></div>';
echo '</div>';

echo '<div class="alert-custom alert-warning-custom">';
echo '<span class="glyphicon glyphicon-info-sign"></span> ';
echo '<strong>Note:</strong> After creating the test, you will be able to add questions and set correct answers for each question. Make sure the duration is appropriate for the number of questions.';
echo '</div>';

echo '<div class="form-group text-center">';
echo '<button type="submit" class="btn btn-primary btn-lg" id="createTestBtn"><span class="glyphicon glyphicon-arrow-right"></span>&nbsp;Create Test & Add Questions</button>';
echo '</div>';

echo '</form>';
echo '</div>';
echo '</div>';
}?>

<!--process quiz creation-->
<?php
if(@$_GET['q']==4 && @$_GET['step']==1) {
    if($_POST) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $total = intval($_POST['total']);
        $right = floatval($_POST['right']);
        $wrong = floatval($_POST['wrong']);
        $time = intval($_POST['time']);
        $date = date("Y-m-d");
        
        // Insert quiz into database
        $query = "INSERT INTO quiz (title, total, sahi, wrong, time, date, email) VALUES ('$name', '$total', '$right', '$wrong', '$time', '$date', '$email')";
        $result = mysqli_query($con, $query);
        
        if($result) {
            $eid = mysqli_insert_id($con);
            
            // FIXED: No popup here - just redirect to add questions
            echo '<div class="section-spacing">';
            echo '<div class="quiz-form-container text-center">';
            
            echo '<div style="background: var(--gradient-primary); color: white; padding: 30px; border-radius: 20px; margin-bottom: 20px;">';
            echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-ok-circle"></span> Test Created Successfully!</h3>';
            echo '<p style="margin: 15px 0 0 0; font-size: 16px;">Now add questions to complete your test setup.</p>';
            echo '</div>';
            
            echo '<a href="dash.php?q=4&step=2&eid='.$eid.'&n='.$total.'&ch=1" class="btn btn-success btn-lg">';
            echo '<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Questions Now</a>';
            
            // Auto-redirect after 2 seconds
            echo '<script>';
            echo 'setTimeout(function() {';
            echo '    window.location.href = "dash.php?q=4&step=2&eid='.$eid.'&n='.$total.'&ch=1";';
            echo '}, 2000);';
            echo '</script>';
            
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="alert-custom alert-error-custom">';
            echo '<span class="glyphicon glyphicon-exclamation-sign"></span> ';
            echo '<strong>Error:</strong> Failed to create test. Please try again.';
            echo '</div>';
        }
    }
}
?>

<!--edit quiz start-->
<?php
if(@$_GET['q']==6 && !(@$_GET['step'])) {
if(isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    $quiz_query = mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' AND email='$email'");
    if(mysqli_num_rows($quiz_query) > 0) {
        $quiz_data = mysqli_fetch_array($quiz_query);
        // FIXED: Use the robust duration function
        $quiz_duration = getDuration($quiz_data);
        
        echo '<div class="section-spacing">';
        echo '<div class="quiz-form-container">';
        echo '<h2 class="quiz-form-title"><span class="glyphicon glyphicon-edit"></span> Edit Test: '.$quiz_data['title'].'</h2>';
        
        echo '<div class="row" style="margin-bottom: 30px;">';
        echo '<div class="col-md-3">';
        echo '<div class="stats-card">';
        echo '<div class="stats-number">'.$quiz_data['total'].'</div>';
        echo '<div class="stats-label">Total Questions</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-3">';
        $attempts_query = mysqli_query($con,"SELECT COUNT(*) as count FROM history WHERE eid='$eid'");
        $attempts_row = mysqli_fetch_array($attempts_query);
        echo '<div class="stats-card" style="background: var(--gradient-success);">';
        echo '<div class="stats-number">'.$attempts_row['count'].'</div>';
        echo '<div class="stats-label">Student Attempts</div>';
        echo '</div>';
        echo '</div>';
        // Duration display in stats
        echo '<div class="col-md-3">';
        echo '<div class="stats-card" style="background: var(--gradient-warning);">';
        echo '<div class="stats-number">'.$quiz_duration.'</div>';
        echo '<div class="stats-label">Duration (min)</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-3">';
        echo '<div class="stats-card" style="background: var(--gradient-secondary);">';
        echo '<div class="stats-number">'.($quiz_data['sahi'] * $quiz_data['total']).'</div>';
        echo '<div class="stats-label">Total Marks</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Display existing questions for editing
        $questions_query = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ORDER BY sn");
        if(mysqli_num_rows($questions_query) > 0) {
            echo '<h4 style="color: var(--primary-color); margin-bottom: 20px;"><span class="glyphicon glyphicon-list"></span> Edit Questions</h4>';
            
            while($question_row = mysqli_fetch_array($questions_query)) {
                $qid = $question_row['qid'];
                $sn = $question_row['sn'];
                $qns = isset($question_row['qns']) ? $question_row['qns'] : '';
                $ans = isset($question_row['ans']) ? $question_row['ans'] : '';

                echo '<div class="question-container">';
                echo '<div class="question-number">Question '.$sn.'</div>';

                echo '<form method="POST" action="update.php?q=editqns&qid='.$qid.'&eid='.$eid.'">';
                echo '<div class="form-group">';
                echo '<label>Question Text *</label>';
                echo '<textarea name="qns" class="form-control" rows="3" required>'.htmlspecialchars($qns).'</textarea>';
                echo '</div>';

                // Get options
                $options_query = mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' ORDER BY optionid");
                $opt_texts = array('','','','');
                $i_opt = 0;
                while($option_row = mysqli_fetch_array($options_query)) {
                    $opt_texts[$i_opt] = isset($option_row['option']) ? $option_row['option'] : '';
                    $i_opt++;
                }

                for($i = 0; $i < 4; $i++) {
                    $option_letter = chr(97 + $i); // a, b, c, d
                    $option_text = isset($opt_texts[$i]) ? $opt_texts[$i] : '';
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<div class="form-group">';
                    echo '<label>Option '.strtoupper($option_letter).' *</label>';
                    echo '<input type="text" name="'.$option_letter.'" class="form-control" value="'.htmlspecialchars($option_text).'" required>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '<div class="form-group">';
                echo '<label>Correct Answer *</label>';
                echo '<select name="ans" class="form-control">';
                echo '<option value="">Select correct answer</option>';
                for($i = 0; $i < 4; $i++) {
                    $option_letter = chr(97 + $i);
                    $selected = ($ans == $option_letter) ? 'selected' : '';
                    echo '<option value="'.$option_letter.'" '.$selected.'>Option '.strtoupper($option_letter).'</option>';
                }
                echo '</select>';
                echo '</div>';

                echo '<div class="text-center">';
                echo '<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span>&nbsp;Save Changes</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            }        } else {
            echo '<div class="alert-custom alert-warning-custom">';
            echo '<span class="glyphicon glyphicon-warning-sign"></span> ';
            echo '<strong>No questions found!</strong> This test doesn\'t have any questions yet. Please add questions first.';
            echo '</div>';
            echo '<div class="text-center">';
            echo '<a href="dash.php?q=4&step=2&eid='.$eid.'&n='.$quiz_data['total'].'&ch=1" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Questions</a>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert-custom alert-error-custom">';
        echo '<span class="glyphicon glyphicon-exclamation-sign"></span> ';
        echo '<strong>Access Denied!</strong> You can only edit your own tests.';
        echo '</div>';
    }
} else {
    // Show list of tests to edit
    $result = mysqli_query($con,"SELECT * FROM quiz where email='$email' ORDER BY date DESC") or die('Error');
    echo '<div class="section-spacing">';
    echo '<div class="panel">';
    echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
    echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-edit"></span> Select Test to Edit</h3>';
    echo '</div>';
    echo '<table class="table table-striped title1">';
    echo '<thead><tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Total Marks</b></td><td><b>Duration</b></td><td><b>Action</b></td></tr></thead>';
    echo '<tbody>';
    $c=1;
    while($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $sahi = $row['sahi'];
        // FIXED: Use the robust duration function
        $time = getDuration($row);
        $eid = $row['eid'];
        echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td><span class="duration-badge">'.$time.' min</span></td>';
        echo '<td><a href="dash.php?q=6&eid='.$eid.'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit Questions</a></td></tr>';
    }
    echo '</tbody></table></div></div>';
}
}?>

<!--remove quiz-->
<?php
if(@$_GET['q']==5) 
{
$result = mysqli_query($con,"SELECT * FROM quiz where email='$email' ORDER BY date DESC") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-trash"></span> Remove Tests</h3>';
echo '</div>';
echo '<div class="alert-custom alert-warning-custom" style="margin: 20px;">';
echo '<span class="glyphicon glyphicon-warning-sign"></span> ';
echo '<strong>Warning:</strong> Deleting a test will permanently remove all questions and student attempts. This action cannot be undone.';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Total Marks</b></td><td><b>Duration</b></td><td><b>Student Attempts</b></td><td><b>Action</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $total = $row['total'];
    $sahi = $row['sahi'];
    // FIXED: Use the robust duration function
    $time = getDuration($row);
    $eid = $row['eid'];
    
    // Count student attempts
    $attempts_query = mysqli_query($con,"SELECT COUNT(*) as count FROM history WHERE eid='$eid'");
    $attempts_row = mysqli_fetch_array($attempts_query);
    $attempt_count = $attempts_row['count'];
    
    echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td><span class="duration-badge">'.$time.' min</span></td><td><span style="color: var(--primary-color); font-weight: 600;">'.$attempt_count.'</span></td>';
    echo '<td><button class="btn btn-danger" onclick="confirmDelete(\''.$eid.'\', \''.$title.'\', '.$attempt_count.')"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete Test</button></td></tr>';
}
echo '</tbody></table></div></div>';
}?>

<!--FIXED: add quiz step2 start - REMOVED ACCESS VERIFICATION-->
<?php
if(@$_GET['step']==2) {
    $eid = @$_GET['eid'];
    $n = @$_GET['n'];
    $ch = @$_GET['ch'];
    
    // FIXED: Removed the strict access verification that was causing "Access Denied" error
    // Get quiz info for display purposes only
    $quiz_query = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid'");
    $quiz_data = mysqli_fetch_array($quiz_query);
    $quiz_title = $quiz_data ? $quiz_data['title'] : 'Test';

echo '<div class="section-spacing">';
echo '<div class="quiz-form-container">';
echo '<h2 class="quiz-form-title"><span class="glyphicon glyphicon-list-alt"></span> Add Questions to Test: '.$quiz_title.'</h2>';

echo '<div class="alert-custom alert-success-custom">';
echo '<span class="glyphicon glyphicon-info-sign"></span> ';
echo '<strong>Instructions:</strong> Please fill in all questions and their options. Make sure to select the correct answer for each question.';
echo '</div>';

echo '<form class="form-horizontal title1" name="questionsForm" action="update.php?q=addqns&n='.$n.'&eid='.$eid.'&ch='.$ch.'" method="POST" onsubmit="return validateQuestionsForm()">';

for($i=1;$i<=$n;$i++) {
    echo '<div class="question-container">';
    echo '<div class="question-number">Question '.$i.'</div>';
    
    echo '<div class="form-group">';
    echo '<label for="qns'.$i.'">Question Text *</label>';
    echo '<textarea rows="3" name="qns'.$i.'" id="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..." required></textarea>';
    echo '</div>';

    echo '<div class="row">';
    for($j=1;$j<=4;$j++) {
        $option_letter = chr(96 + $j); // a, b, c, d
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label for="'.$i.$j.'">Option '.strtoupper($option_letter).' *</label>';
        echo '<input id="'.$i.$j.'" name="'.$i.$j.'" placeholder="Enter option '.strtoupper($option_letter).'" class="form-control" type="text" required>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label for="ans'.$i.'">Correct Answer *</label>';
    echo '<select id="ans'.$i.'" name="ans'.$i.'" class="form-control answer-select" required style="background: #f0f9ff; border: 2px solid var(--primary-color);">';
    echo '<option value="">Select correct answer for question '.$i.'</option>';
    echo '<option value="a" data-question="'.$i.'">Option A</option>';
    echo '<option value="b" data-question="'.$i.'">Option B</option>';
    echo '<option value="c" data-question="'.$i.'">Option C</option>';
    echo '<option value="d" data-question="'.$i.'">Option D</option>';
    echo '</select>';
    echo '</div>';
    
    echo '</div>'; // question-container
}

echo '<div class="form-group text-center">';
echo '<button type="submit" class="btn btn-success btn-lg" onclick="return confirmSaveQuestions()"><span class="glyphicon glyphicon-save"></span>&nbsp;Save All Questions & Complete Test</button>';
echo '</div>';

echo '</form>';
echo '</div>';
echo '</div>';
}?>

</div></div></div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="deleteModalLabel"><span class="glyphicon glyphicon-warning-sign"></span> Confirm Deletion</h4>
      </div>
      <div class="modal-body" style="padding: 30px; line-height: 1.6;">
        <div class="alert-custom alert-error-custom">
          <span class="glyphicon glyphicon-exclamation-sign"></span>
          <strong>Warning:</strong> This action cannot be undone!
        </div>
        <p>Are you sure you want to delete the test "<strong id="testTitle"></strong>"?</p>
        <p>This will permanently remove:</p>
        <ul style="margin-left: 20px;">
          <li>All questions and answers</li>
          <li><span id="attemptCount"></span> student attempt(s)</li>
          <li>All associated data</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
          <span class="glyphicon glyphicon-trash"></span> Yes, Delete Test
        </a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Enhanced answer selection visual feedback
$('.answer-select').on('change', function() {
    const $select = $(this);
    const selectedValue = $select.val();
    const questionNum = $select.attr('name').replace('ans', '');
    
    // Remove previous selection styling
    $select.removeClass('answer-selected');
    
    if (selectedValue) {
        // Add selection styling
        $select.addClass('answer-selected');
        
        // Update the select appearance
        $select.css({
            'background': 'rgba(16, 185, 129, 0.1)',
            'border-color': 'var(--success-color)',
            'box-shadow': '0 0 0 3px rgba(16, 185, 129, 0.1)'
        });
        
        // Show success message
        showAnswerFeedback(questionNum, selectedValue);
    } else {
        // Reset styling if no option selected
        $select.css({
            'background': '#f0f9ff',
            'border-color': 'var(--primary-color)',
            'box-shadow': 'none'
        });
    }
});

// Function to show answer selection feedback
function showAnswerFeedback(questionNum, selectedOption) {
    const $questionContainer = $('select[name="ans' + questionNum + '"]').closest('.question-container');
    
    // Remove any existing feedback
    $questionContainer.find('.answer-feedback').remove();
    
    // Add feedback message (kept visible, no fadeout)
    const feedbackHtml = '<div class="answer-feedback" style="background: rgba(16, 185, 129, 0.1); color: var(--success-color); padding: 10px; border-radius: 8px; margin-top: 10px; border-left: 4px solid var(--success-color);">' +
                        '<span class="glyphicon glyphicon-ok-circle"></span> ' +
                        '<strong>Correct answer set to Option ' + selectedOption.toUpperCase() + '</strong>' +
                        '</div>';
    
    $questionContainer.append(feedbackHtml);
}


    // FIXED: Enhanced real-time form preview for test creation with accurate duration display
    $('#name, #total, #right, #wrong, #time').on('input', function() {
        updateTestPreview();
    });
    
    function updateTestPreview() {
        const title = $('#name').val().trim();
        const total = $('#total').val().trim();
        const right = $('#right').val().trim();
        const wrong = $('#wrong').val().trim();
        const time = $('#time').val().trim();
        
        if (title && total && right && wrong && time) {
            const totalMarks = parseInt(total) * parseFloat(right);
            const preview = `
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <div><strong>Title:</strong> ${title}</div>
                    <div><strong>Questions:</strong> ${total}</div>
                    <div><strong>Duration:</strong> <span class="duration-badge">${time} min</span></div>
                    <div><strong>Total Marks:</strong> ${totalMarks}</div>
                    <div><strong>Marks per Question:</strong> +${right} / -${wrong}</div>
                </div>
            `;
            $('#previewContent').html(preview);
            $('#testPreview').show();
        } else {
            $('#testPreview').hide();
        }
    }

    // FIXED: Enhanced form validation for quiz creation
    window.validateQuizForm = function() {
        const title = $('#name').val().trim();
        const total = parseInt($('#total').val().trim());
        const right = parseFloat($('#right').val().trim());
        const wrong = parseFloat($('#wrong').val().trim());
        const time = parseInt($('#time').val().trim());

        if (!title || title.length < 3) {
            showAlert('Test title must be at least 3 characters long!', 'error');
            $('#name').focus();
            return false;
        }

        if (!total || total < 1 || total > 100) {
            showAlert('Number of questions must be between 1 and 100!', 'error');
            $('#total').focus();
            return false;
        }

        if (!right || right <= 0) {
            showAlert('Marks per correct answer must be greater than 0!', 'error');
            $('#right').focus();
            return false;
        }

        if (wrong < 0) {
            showAlert('Negative marking cannot be negative!', 'error');
            $('#wrong').focus();
            return false;
        }

        // FIXED: Improved time validation with better range
        if (!time || time < 1 || time > 300) {
            showAlert('Test duration must be between 1 and 300 minutes!', 'error');
            $('#time').focus();
            return false;
        }

        // Check if duration is appropriate for number of questions
        const minTime = Math.ceil(total * 0.5); // Minimum 30 seconds per question
        if (time < minTime) {
            if (!confirm(`The duration seems short for ${total} questions. Recommended minimum: ${minTime} minutes. Continue anyway?`)) {
                $('#time').focus();
                return false;
            }
        }

        // Show loading state
        $('#createTestBtn').html('<span class="loading"></span> Creating Test...');
        return true;
    };

    // Enhanced form validation for questions
    window.validateQuestionsForm = function() {
        let isValid = true;
        let emptyFields = [];
        let firstError = null;

        // Check all questions
        $('textarea[name^="qns"]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                const questionNum = $(this).attr('name').replace('qns', '');
                emptyFields.push('Question ' + questionNum + ' text');
                if (!firstError) firstError = this;
            }
        });

        // Check all options
        $('input[type="text"]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                const name = $(this).attr('name');
                const questionNum = name.charAt(0);
                const optionNum = name.charAt(1);
                const optionLetter = String.fromCharCode(96 + parseInt(optionNum));
                emptyFields.push('Question ' + questionNum + ' Option ' + optionLetter.toUpperCase());
                if (!firstError) firstError = this;
            }
        });

        // Check all correct answers
        $('select[name^="ans"]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                const questionNum = $(this).attr('name').replace('ans', '');
                emptyFields.push('Question ' + questionNum + ' correct answer');
                if (!firstError) firstError = this;
            }
        });

        if (!isValid) {
            let message = 'Please fill the following required fields:\\n\\n';
            message += emptyFields.slice(0, 10).join('\\n');
            if (emptyFields.length > 10) {
                message += '\\n... and ' + (emptyFields.length - 10) + ' more fields';
            }
            showAlert(message, 'error');
            if (firstError) {
                firstError.focus();
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return false;
        }

        // Show loading state
        $('button[type="submit"]').html('<span class="loading"></span> Saving Questions...');
        return true;
    };

    // Add confirmation for saving questions
    window.confirmSaveQuestions = function() {
        return confirm('Are you sure you want to save all questions and complete the test creation? This will finalize your test.');
    };

    // Add loading animation to buttons
    $('.btn').click(function() {
        var $btn = $(this);
        if (!$btn.hasClass('no-loading') && $btn.attr('type') !== 'button') {
            setTimeout(function() {
                if ($btn.html().indexOf('loading') === -1) {
                    $btn.data('original-text', $btn.html());
                    $btn.html('<span class="loading"></span> Processing...');
                }
            }, 100);
        }
    });

    // Animate table rows on load
    $('.table tbody tr').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(20px)'
        }).delay(index * 100).animate({
            'opacity': '1'
        }, 500).css('transform', 'translateY(0)');
    });

    // Animate stats cards
    $('.stats-card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'scale(0.8)'
        }).delay(index * 200).animate({
            'opacity': '1'
        }, 600).css('transform', 'scale(1)');
    });

    // Form field focus effects
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
        
        // Special handling for answer selects
        if($(this).hasClass('answer-select')) {
            $(this).css('border-color', 'var(--primary-color)');
        }
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
    
    // FIXED: Duration input real-time validation and feedback
    $('#time').on('input', function() {
        const value = parseInt($(this).val());
        const $helpBlock = $(this).siblings('.help-block');
        
        // Remove existing feedback
        $(this).removeClass('duration-warning duration-error duration-success');
        
        if (value) {
            if (value < 1) {
                $(this).addClass('duration-error');
                $helpBlock.html('<span style="color: var(--error-color);">⚠️ Minimum duration is 1 minute</span>');
            } else if (value > 300) {
                $(this).addClass('duration-error');
                $helpBlock.html('<span style="color: var(--error-color);">⚠️ Maximum duration is 300 minutes</span>');
            } else if (value >= 1 && value <= 60) {
                $(this).addClass('duration-success');
                $helpBlock.html('<span style="color: var(--success-color);">✓ Perfect duration for most tests</span>');
            } else {
                $(this).addClass('duration-warning');
                $helpBlock.html('<span style="color: var(--warning-color);">⏰ Long duration - suitable for comprehensive tests</span>');
            }
        } else {
            $helpBlock.html('<span style="color: #6B7280;">Duration must be between 1 and 300 minutes</span>');
        }
    });
    
    // Initialize answer selection styling for edit mode
    $('.answer-select').each(function() {
        if($(this).val()) {
            $(this).addClass('answer-selected');
        }
    });
});

// Delete confirmation function
function confirmDelete(eid, title, attempts) {
    $('#testTitle').text(title);
    $('#attemptCount').text(attempts);
    $('#confirmDeleteBtn').attr('href', 'update.php?q=rmquiz&eid=' + eid);
    $('#deleteModal').modal('show');
}

// Enhanced alert function with better positioning and styling
function showAlert(message, type) {
    // Remove any existing alerts
    $('.alert-floating').remove();
    
    const alertClass = type === 'error' ? 'alert-error-custom' : 
                      type === 'success' ? 'alert-success-custom' : 'alert-warning-custom';
    
    const icon = type === 'error' ? 'exclamation-sign' : 
                 type === 'success' ? 'ok-sign' : 'info-sign';
    
    const alertHtml = '<div class="alert-custom alert-floating ' + alertClass + '" style="position: fixed; top: 80px; right: 20px; z-index: 9999; max-width: 400px; animation: slideInRight 0.3s ease-out;">' +
                      '<span class="glyphicon glyphicon-' + icon + '"></span> ' +
                      message.replace(/\\n/g, '<br>') +
                      '<button type="button" class="close" style="margin-left: 10px; color: inherit;" onclick="$(this).parent().fadeOut()">&times;</button>' +
                      '</div>';
    
    $('body').append(alertHtml);
    
    // Auto-dismiss after 8 seconds for long messages
    setTimeout(function() {
        $('.alert-floating').fadeOut(500, function() {
            $(this).remove();
        });
    }, 8000);
}

// FIXED: Enhanced Questions Success Popup (only shown after questions are added)
function showQuestionsSuccessPopup(testTitle, questionCount) {
    // Generate confetti colors
    const colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#F97316'];
    
    const popupHtml = `
        <div class="questions-success-popup" id="questionsSuccessPopup">
            <div class="questions-success-popup-content">
                <div class="questions-success-icon">🎉</div>
                <h2 class="questions-success-title">Test Completed Successfully!</h2>
                <div class="questions-success-message">
                    <p><strong>"${testTitle}"</strong> has been created and all questions have been added successfully!</p>
                </div>
                <div class="questions-success-details">
                    <p>✅ Test is now ready for students</p>
                    <p>📝 ${questionCount} questions added</p>
                    <p>🎯 All answers configured</p>
                </div>
                <div style="margin-top: 25px;">
                    <button class="btn btn-success btn-lg" onclick="closeQuestionsSuccessPopup()" style="margin-right: 15px;">
                        <span class="glyphicon glyphicon-ok"></span> Great!
                    </button>
                    <a href="dash.php?q=0" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span> Back to Dashboard
                    </a>
                </div>
                ${generateConfettiPieces(colors)}
            </div>
        </div>
    `;
    
    $('body').append(popupHtml);
    
    // Auto-close after 8 seconds
    setTimeout(function() {
        closeQuestionsSuccessPopup();
    }, 8000);
}

// Function to close questions success popup
function closeQuestionsSuccessPopup() {
    $('#questionsSuccessPopup').fadeOut(500, function() {
        $(this).remove();
        // Redirect to dashboard after closing
        window.location.href = 'dash.php?q=0';
    });
}

// Function to generate confetti pieces
function generateConfettiPieces(colors) {
    let confetti = '';
    for(let i = 0; i < 40; i++) {
        const color = colors[Math.floor(Math.random() * colors.length)];
        const delay = Math.random() * 4;
        const duration = 3 + Math.random() * 2;
        const left = Math.random() * 100;
        const size = 10 + Math.random() * 8;
        
        confetti += `<div class="confetti-piece" style="
            background: ${color};
            left: ${left}%;
            animation-delay: ${delay}s;
            animation-duration: ${duration}s;
            width: ${size}px;
            height: ${size}px;
        "></div>`;
    }
    return confetti;
}

// Scroll animations
$(function () {
    $(document).on('scroll', function(){
        if($(window).scrollTop() >= $(".header").height()) {
            $(".navbar").addClass("navbar-fixed-top");
        }
        if($(window).scrollTop() < $(".header").height()) {
            $(".navbar").removeClass("navbar-fixed-top");
        }
    });
});

// Add slideInRight animation
$('<style>').text(`
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`).appendTo('head');
</script>

</body>
</html>
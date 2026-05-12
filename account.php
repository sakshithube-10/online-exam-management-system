<?php
include_once 'dbConnection.php';
session_start();
if(!(isset($_SESSION['email']))){
    header("location:index.php");
    exit();
}
else
{
    $name = $_SESSION['name'];
    $email1 = $_SESSION['email'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Student Dashboard - Online Examiner</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/font.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet'>

<!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

<style>
/* Modern CSS Variables */
:root {
  --primary-color: #667eea;
  --secondary-color: #764ba2;
  --accent-color: #f093fb;
  --success-color: #4ade80;
  --warning-color: #fbbf24;
  --error-color: #f87171;
  --dark-color: #1e293b;
  --light-color: #f8fafc;
  --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  --gradient-success: linear-gradient(135deg, #4ade80 0%, #22d3ee 100%);
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
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
}

.navbar-fixed-top {
  animation: slideDown 0.5s ease-out;
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
  background: rgba(102, 126, 234, 0.05) !important;
}

/* Enhanced Container */
.container {
  animation: fadeInUp 0.8s ease-out;
  margin-top: 20px;
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
}

.table tbody tr:hover {
  background: rgba(102, 126, 234, 0.05) !important;
  transform: translateX(5px);
  box-shadow: inset 3px 0 0 var(--primary-color);
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
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%) !important;
  color: white !important;
}

.btn:hover {
  transform: translateY(-3px) !important;
  box-shadow: var(--shadow-lg) !important;
}

/* Timer Styles */
.quiz-timer {
  position: fixed;
  top: 20px;
  right: 20px;
  background: var(--gradient-primary);
  color: white;
  padding: 15px 25px;
  border-radius: 50px;
  font-size: 18px;
  font-weight: 700;
  box-shadow: var(--shadow-lg);
  z-index: 1000;
  animation: pulse 2s infinite;
}

.quiz-timer.warning {
  background: var(--gradient-secondary);
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0.5; }
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

/* Progress Chart Container */
.chart-container {
  position: relative;
  height: 300px;
  margin: 20px 0;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 12px;
  padding: 20px;
  box-shadow: var(--shadow-md);
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
  background: var(--gradient-secondary);
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

/* Quiz Question Styling */
.quiz-question {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 30px;
  margin: 20px 0;
  box-shadow: var(--shadow-lg);
}

.quiz-options {
  margin: 20px 0;
}

.quiz-options input[type="radio"] {
  margin-right: 10px;
  transform: scale(1.2);
}

.quiz-options label {
  display: block;
  padding: 12px 20px;
  margin: 8px 0;
  background: rgba(248, 250, 252, 0.8);
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.quiz-options label:hover {
  background: rgba(102, 126, 234, 0.1);
  border-color: var(--primary-color);
  transform: translateX(5px);
}

/* Result Display */
.result-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 30px;
  margin: 20px 0;
  box-shadow: var(--shadow-lg);
  text-align: center;
}

.result-score {
  font-size: 3rem;
  font-weight: 700;
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .header { padding: 15px 10px; }
  .container { padding: 0 10px; }
  .panel { margin: 10px 0; border-radius: 12px; }
  .table tbody tr:hover { transform: none; }
  .quiz-timer { position: relative; top: 0; right: 0; margin: 10px 0; }
}

/* Loading Animation */
.loading {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(102, 126, 234, 0.3);
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

/* Animated Icons */
.glyphicon {
  transition: all 0.3s ease;
}

.glyphicon:hover {
  transform: scale(1.2) rotate(5deg);
}

.glyphicon-ok {
  color: var(--success-color) !important;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}
</style>

</head>

<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
</div>
<div class="col-md-4 col-md-offset-2">
<?php
echo '<span class="pull-right top title1" style="font-size:18px;">
<span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
&nbsp;&nbsp;&nbsp;&nbsp;Welcome,</span> 
<a href="account.php?q=1" class="log log1" style="font-size:18px;">'.$name.'</a>
&nbsp;|&nbsp;
<a href="logout.php?q=index.php" class="log" style="font-size:18px;">
<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</a>
</span>';
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
      <a class="navbar-brand" href="account.php?q=1"><b>Student Dashboard</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar left">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->

<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {
$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-list-alt"></span> Available Quizzes</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Total Marks</b></td><td><b>+ve Marks</b></td><td><b>-ve Marks</b></td><td><b>Duration</b></td><td><b>Action</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $total = $row['total'];
    $sahi = $row['sahi'];
    $wrong = $row['wrong'];
    $time = $row['time'];
    $eid = $row['eid'];
    
    $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email1'" )or die('Error98');
    $rowcount=mysqli_num_rows($q12);  
    if($rowcount == 0){
        echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong></td><td><span class="stat-number" style="font-size: 1rem;">'.$total.'</span></td><td><span class="stat-number" style="font-size: 1rem; color: var(--success-color);">'.$sahi*$total.'</span></td><td><span style="color: var(--success-color);">+'.$sahi.'</span></td><td><span style="color: var(--error-color);">-'.$wrong.'</span></td><td><span style="color: var(--warning-color);">'.$time.' min</span></td>';
        echo '<td><button class="btn btn-success start-quiz-btn" data-eid="'.$eid.'" data-total="'.$total.'" data-time="'.$time.'" data-title="'.$title.'"><span class="glyphicon glyphicon-play" aria-hidden="true"></span>&nbsp;Start Quiz</button></td></tr>';
    }
    else
    {
        echo '<tr class="status-completed" style="background: rgba(74, 222, 128, 0.1);"><td><span class="rank-gold">'.$c++.'</span></td><td><strong>'.$title.'</strong>&nbsp;<span title="Quiz completed!" class="glyphicon glyphicon-ok" style="color: var(--success-color);"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>+'.$sahi.'</td><td>-'.$wrong.'</td><td>'.$time.' min</td><td><span style="color: var(--success-color); font-weight: 600;">Completed</span></td></tr>';
    }
}
$c=0;
echo '</tbody></table></div></div>';
}?>

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$time_limit = @$_GET['time'];

$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="quiz-timer" id="timer">Time: <span id="time-display"></span></div>';
echo '<div class="section-spacing">';
echo '<div class="quiz-question">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 15px; margin: -30px -30px 20px -30px; border-radius: 16px 16px 0 0;">';
echo '<h4 style="margin: 0; font-weight: 600;">Question '.$sn.' of '.$total.'</h4>';
echo '</div>';

while($row=mysqli_fetch_array($q) )
{
    $qns=$row['qns'];
    $qid=$row['qid'];
    echo '<div style="font-size: 18px; line-height: 1.6; margin-bottom: 25px;"><strong>'.$qns.'</strong></div>';
}

$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form id="quiz-form" action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST" class="form-horizontal">';
echo '<div class="quiz-options">';

while($row=mysqli_fetch_array($q) )
{
    $option=$row['option'];
    $optionid=$row['optionid'];
    echo '<label><input type="radio" name="ans" value="'.$optionid.'" required>'.$option.'</label>';
}

echo '</div>';
echo '<div style="text-align: center; margin-top: 30px;">';
if($sn < $total) {
    echo '<button type="submit" class="btn btn-primary" style="padding: 15px 30px; font-size: 16px;"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>&nbsp;Next Question</button>';
} else {
    echo '<button type="submit" class="btn btn-success" style="padding: 15px 30px; font-size: 16px;"><span class="glyphicon glyphicon-check" aria-hidden="true"></span>&nbsp;Submit Quiz</button>';
}
echo '</div>';
echo '</form></div></div>';

// Add timer script
echo '<script>
var timeLimit = '.$time_limit.' * 60; // Convert minutes to seconds
var timeLeft = timeLimit;
var timerInterval;

function startTimer() {
    timerInterval = setInterval(function() {
        var minutes = Math.floor(timeLeft / 60);
        var seconds = timeLeft % 60;
        
        document.getElementById("time-display").innerHTML = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        
        // Warning when 5 minutes left
        if(timeLeft <= 300 && timeLeft > 60) {
            document.getElementById("timer").classList.add("warning");
            if(timeLeft % 60 === 0) {
                alert("Warning: " + Math.floor(timeLeft/60) + " minutes remaining!");
            }
        }
        
        // Final warning at 1 minute
        if(timeLeft === 60) {
            alert("Final Warning: Only 1 minute remaining!");
        }
        
        // Auto submit when time is up
        if(timeLeft <= 0) {
            clearInterval(timerInterval);
            alert("Time is up! Quiz will be submitted automatically.");
            document.getElementById("quiz-form").submit();
        }
        
        timeLeft--;
    }, 1000);
}

// Start timer when page loads
window.onload = function() {
    startTimer();
};
</script>';
}

//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email1' " )or die('Error157');
echo '<div class="section-spacing">';
echo '<div class="result-card">';
echo '<h2 style="color: var(--primary-color); margin-bottom: 30px;"><span class="glyphicon glyphicon-trophy"></span> Quiz Results</h2>';

while($row=mysqli_fetch_array($q) )
{
    $s=$row['score'];
    $w=$row['wrong'];
    $r=$row['sahi'];
    $qa=$row['level'];
    
    echo '<div class="result-score">'.$s.'</div>';
    echo '<p style="font-size: 18px; color: var(--dark-color); margin-bottom: 30px;">Your Score</p>';
    
    echo '<div class="row" style="margin-bottom: 30px;">';
    echo '<div class="col-md-3"><div style="background: var(--gradient-primary); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h4>'.$qa.'</h4><p>Total Questions</p></div></div>';
    echo '<div class="col-md-3"><div style="background: var(--gradient-success); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h4>'.$r.'</h4><p>Correct</p></div></div>';
    echo '<div class="col-md-3"><div style="background: var(--gradient-secondary); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h4>'.$w.'</h4><p>Wrong</p></div></div>';
    echo '<div class="col-md-3"><div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h4>'.($qa-$r-$w).'</h4><p>Unanswered</p></div></div>';
    echo '</div>';
    
    // Add pie chart
    echo '<div class="chart-container">';
    echo '<canvas id="resultChart" width="400" height="200"></canvas>';
    echo '</div>';
    
    echo '<script>
    var ctx = document.getElementById("resultChart").getContext("2d");
    var resultChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Correct", "Wrong", "Unanswered"],
            datasets: [{
                data: ['.$r.', '.$w.', '.($qa-$r-$w).'],
                backgroundColor: ["#4ade80", "#f87171", "#fbbf24"],
                borderWidth: 2,
                borderColor: "#fff"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 20,
                        font: {
                            size: 14,
                            weight: "600"
                        }
                    }
                }
            }
        }
    });
    </script>';
}

$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email1' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
    $overall_score=$row['score'];
    echo '<div style="margin-top: 30px; padding: 20px; background: rgba(102, 126, 234, 0.1); border-radius: 12px;">';
    echo '<h4 style="color: var(--primary-color);">Overall Performance</h4>';
    echo '<p style="font-size: 24px; font-weight: 700; color: var(--dark-color);">Total Score: '.$overall_score.'</p>';
    echo '</div>';
}

echo '<div style="margin-top: 30px;">';
echo '<a href="account.php?q=1" class="btn btn-primary" style="margin-right: 10px;"><span class="glyphicon glyphicon-home"></span> Back to Home</a>';
echo '<a href="account.php?q=2" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> View History</a>';
echo '</div>';

echo '</div></div>';
}
?>
<!--quiz end-->

<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email1' ORDER BY date DESC " )or die('Error197');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-history"></span> Quiz History & Progress</h3>';
echo '</div>';

// Progress Overview
$total_quizzes = mysqli_num_rows($q);
$total_score = 0;
$total_correct = 0;
$total_wrong = 0;
$total_questions = 0;

// Reset query pointer
mysqli_data_seek($q, 0);
while($row = mysqli_fetch_array($q)) {
    $total_score += $row['score'];
    $total_correct += $row['sahi'];
    $total_wrong += $row['wrong'];
    $total_questions += $row['level'];
}

if($total_quizzes > 0) {
    $accuracy = round(($total_correct / $total_questions) * 100, 1);
    
    echo '<div style="padding: 30px;">';
    echo '<div class="row" style="margin-bottom: 30px;">';
    echo '<div class="col-md-3"><div style="background: var(--gradient-primary); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h3>'.$total_quizzes.'</h3><p>Quizzes Taken</p></div></div>';
    echo '<div class="col-md-3"><div style="background: var(--gradient-success); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h3>'.$total_score.'</h3><p>Total Score</p></div></div>';
    echo '<div class="col-md-3"><div style="background: var(--gradient-secondary); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h3>'.$accuracy.'%</h3><p>Accuracy</p></div></div>';
    echo '<div class="col-md-3"><div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white; padding: 20px; border-radius: 12px; text-align: center;"><h3>'.$total_correct.'</h3><p>Correct Answers</p></div></div>';
    echo '</div>';
    
    // Overall Progress Chart
    echo '<div class="chart-container">';
    echo '<h4 style="text-align: center; color: var(--primary-color); margin-bottom: 20px;">Overall Performance</h4>';
    echo '<canvas id="overallChart" width="400" height="200"></canvas>';
    echo '</div>';
    
    echo '<script>
    var ctx2 = document.getElementById("overallChart").getContext("2d");
    var overallChart = new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels: ["Correct Answers", "Wrong Answers"],
            datasets: [{
                data: ['.$total_correct.', '.$total_wrong.'],
                backgroundColor: ["#4ade80", "#f87171"],
                borderWidth: 3,
                borderColor: "#fff"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 20,
                        font: {
                            size: 14,
                            weight: "600"
                        }
                    }
                }
            }
        }
    });
    </script>';
    echo '</div>';
}

// History Table
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Questions</b></td><td><b>Correct</b></td><td><b>Wrong</b></td><td><b>Score</b></td><td><b>Accuracy</b></td></tr></thead>';
echo '<tbody>';

// Reset query pointer
mysqli_data_seek($q, 0);
$c=1;
while($row=mysqli_fetch_array($q) )
{
    $eid=$row['eid'];
    $s=$row['score'];
    $w=$row['wrong'];
    $r=$row['sahi'];
    $qa=$row['level'];
    $quiz_accuracy = $qa > 0 ? round(($r / $qa) * 100, 1) : 0;
    
    $q23=mysqli_query($con,"SELECT title FROM quiz WHERE eid='$eid' " )or die('Error208');
    while($row23=mysqli_fetch_array($q23) )
    {
        $title=$row23['title'];
    }
    
    $accuracy_color = $quiz_accuracy >= 80 ? 'var(--success-color)' : ($quiz_accuracy >= 60 ? 'var(--warning-color)' : 'var(--error-color)');
    
    echo '<tr><td><span class="notification-badge">'.$c.'</span></td><td><strong>'.$title.'</strong></td><td>'.$qa.'</td><td><span style="color: var(--success-color);">'.$r.'</span></td><td><span style="color: var(--error-color);">'.$w.'</span></td><td><span style="color: var(--primary-color); font-weight: 700;">'.$s.'</span></td><td><span style="color: '.$accuracy_color.'; font-weight: 600;">'.$quiz_accuracy.'%</span></td></tr>';
    $c++;
}
echo '</tbody></table></div></div>';
}
?>

</div></div></div>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="termsModalLabel"><span class="glyphicon glyphicon-info-sign"></span> Quiz Terms & Conditions</h4>
      </div>
      <div class="modal-body" style="padding: 30px; line-height: 1.6;">
        <h5 style="color: var(--primary-color); margin-bottom: 15px;">Please read and accept the following terms:</h5>
        <ul style="margin-left: 20px;">
          <li style="margin-bottom: 10px;">You must complete the quiz within the allocated time limit.</li>
          <li style="margin-bottom: 10px;">Once you start the quiz, the timer will begin automatically.</li>
          <li style="margin-bottom: 10px;">You cannot pause or restart the quiz once started.</li>
          <li style="margin-bottom: 10px;">If time runs out, the quiz will be submitted automatically.</li>
          <li style="margin-bottom: 10px;">You will receive warnings when 5 minutes and 1 minute remain.</li>
          <li style="margin-bottom: 10px;">Each question must be answered before proceeding to the next.</li>
          <li style="margin-bottom: 10px;">You cannot go back to previous questions.</li>
          <li style="margin-bottom: 10px;">Ensure stable internet connection throughout the quiz.</li>
          <li style="margin-bottom: 10px;">Any form of cheating or unfair means is strictly prohibited.</li>
          <li style="margin-bottom: 10px;">Results will be displayed immediately after completion.</li>
        </ul>
        <div style="background: rgba(102, 126, 234, 0.1); padding: 20px; border-radius: 8px; margin-top: 20px;">
          <p style="margin: 0; font-weight: 600; color: var(--primary-color);">
            <span class="glyphicon glyphicon-exclamation-sign"></span> 
            By clicking "I Agree & Start Quiz", you acknowledge that you have read and understood these terms.
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="agreeAndStart">
          <span class="glyphicon glyphicon-check"></span> I Agree & Start Quiz
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var currentQuizData = {};
    
    // Handle start quiz button click
    $('.start-quiz-btn').click(function() {
        currentQuizData = {
            eid: $(this).data('eid'),
            total: $(this).data('total'),
            time: $(this).data('time'),
            title: $(this).data('title')
        };
        
        // Update modal with quiz specific information
        $('#termsModal .modal-body').prepend(
            '<div class="alert" style="background: var(--gradient-primary); color: white; border: none; border-radius: 8px; margin-bottom: 20px;">' +
            '<h5 style="margin: 0; color: white;"><span class="glyphicon glyphicon-list-alt"></span> Quiz: ' + currentQuizData.title + '</h5>' +
            '<p style="margin: 5px 0 0 0;">Questions: ' + currentQuizData.total + ' | Time Limit: ' + currentQuizData.time + ' minutes</p>' +
            '</div>'
        );
        
        $('#termsModal').modal('show');
    });
    
    // Handle agree and start button
    $('#agreeAndStart').click(function() {
        $('#termsModal').modal('hide');
        // Redirect to quiz
        window.location.href = 'account.php?q=quiz&step=2&eid=' + currentQuizData.eid + '&n=1&t=' + currentQuizData.total + '&time=' + currentQuizData.time;
    });
    
    // Clean up modal when closed
    $('#termsModal').on('hidden.bs.modal', function() {
        $('.alert').remove();
    });
    
    // Add loading animation to buttons
    $('.btn').click(function() {
        var $btn = $(this);
        if (!$btn.hasClass('no-loading') && !$btn.hasClass('start-quiz-btn')) {
            $btn.html('<span class="loading"></span> Processing...');
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
});
</script>

</body>
</html>
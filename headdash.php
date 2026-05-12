<?php
// Start session at the very beginning to avoid warnings
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Online Examiner Dashboard</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/font.css">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet'>

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
  position: relative;
  z-index: 1050; /* Higher z-index to ensure dropdown shows above everything */
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
  position: relative;
  z-index: 1; /* Lower z-index than navbar */
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
  z-index: 1; /* Lower than navbar */
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

/* Animated Icons */
.glyphicon {
  transition: all 0.3s ease;
}

.glyphicon:hover {
  transform: scale(1.2) rotate(5deg);
}

.glyphicon-trash:hover {
  color: var(--error-color) !important;
  transform: scale(1.3);
}

.glyphicon-folder-open:hover {
  color: var(--warning-color) !important;
  transform: scale(1.3);
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

/* Enhanced Forms */
.form-horizontal {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  padding: 30px;
  border-radius: 16px;
  box-shadow: var(--shadow-lg);
  margin: 20px 0;
}

.form-control {
  border: 2px solid rgba(102, 126, 234, 0.2) !important;
  border-radius: 12px !important;
  padding: 12px 16px !important;
  font-size: 14px !important;
  transition: all 0.3s ease !important;
  background: rgba(248, 250, 252, 0.8) !important;
}

.form-control:focus {
  border-color: var(--primary-color) !important;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
  transform: translateY(-2px) !important;
  background: white !important;
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

.btn-primary::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.btn-primary:hover::before {
  width: 300px;
  height: 300px;
}

.btn-primary:hover {
  transform: translateY(-3px) !important;
  box-shadow: var(--shadow-lg) !important;
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

/* Ranking Styles */
.rank-gold { color: #ffd700 !important; font-weight: 700 !important; }
.rank-silver { color: #c0c0c0 !important; font-weight: 700 !important; }
.rank-bronze { color: #cd7f32 !important; font-weight: 700 !important; }

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

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .header { padding: 15px 10px; }
  .container { padding: 0 10px; }
  .panel { margin: 10px 0; border-radius: 12px; }
  .table tbody tr:hover { transform: none; }
  .form-horizontal { padding: 20px; }
}

/* Scrollbar Styling */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(248, 250, 252, 0.5);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: var(--gradient-primary);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--gradient-secondary);
}

/* Dropdown Enhancements - FIXED Z-INDEX */
.dropdown-menu {
  border: none !important;
  box-shadow: var(--shadow-lg) !important;
  border-radius: 12px !important;
  padding: 8px 0 !important;
  background: rgba(255, 255, 255, 0.95) !important;
  backdrop-filter: blur(10px) !important;
  animation: dropdownSlide 0.3s ease-out !important;
  z-index: 2000 !important; /* Very high z-index to ensure it shows above everything */
}

.dropdown {
  position: static !important; /* Prevent dropdown from being cut off */
}

.navbar-nav .dropdown-menu {
  position: absolute !important;
  z-index: 2000 !important;
}

@keyframes dropdownSlide {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.dropdown-menu > li > a {
  padding: 10px 20px !important;
  transition: all 0.3s ease !important;
}

.dropdown-menu > li > a:hover {
  background: var(--gradient-primary) !important;
  color: white !important;
  transform: translateX(5px) !important;
}

/* Enhanced Title Styling */
.title1 {
  font-family: 'Inter', sans-serif !important;
  font-weight: 600 !important;
}

/* Feedback Section */
.feedback-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  box-shadow: var(--shadow-lg);
  padding: 25px;
  margin: 20px 0;
  border-left: 4px solid var(--primary-color);
}

.feedback-header {
  background: var(--gradient-primary);
  color: white;
  padding: 20px 25px;
  margin: -25px -25px 20px -25px;
  border-radius: 12px 12px 0 0;
}

/* Stats Cards */
.stat-card {
  background: var(--gradient-primary);
  color: white;
  padding: 20px;
  border-radius: 16px;
  text-align: center;
  box-shadow: var(--shadow-lg);
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px) scale(1.02);
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 700;
  line-height: 1;
}

.stat-label {
  font-size: 0.9rem;
  opacity: 0.8;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Action Buttons */
.action-btn {
  display: inline-block;
  padding: 8px 12px;
  margin: 0 2px;
  border-radius: 8px;
  transition: all 0.3s ease;
  background: rgba(102, 126, 234, 0.1);
  border: 1px solid rgba(102, 126, 234, 0.2);
}

.action-btn:hover {
  background: var(--primary-color);
  color: white !important;
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

/* Enhanced spacing */
.section-spacing {
  margin: 40px 0;
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

/* SUCCESS MESSAGE STYLES */
.success-message {
  position: fixed;
  top: 20px;
  right: 20px;
  background: var(--gradient-success);
  color: white;
  padding: 20px 30px;
  border-radius: 16px;
  box-shadow: var(--shadow-xl);
  z-index: 9999;
  transform: translateX(400px);
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  font-weight: 600;
  min-width: 300px;
}

.success-message.show {
  transform: translateX(0);
}

.success-message::before {
  content: '🎉';
  position: absolute;
  left: -10px;
  top: -10px;
  font-size: 2rem;
  animation: celebrate 1s ease-in-out infinite alternate;
}

@keyframes celebrate {
  0% { transform: rotate(-10deg) scale(1); }
  100% { transform: rotate(10deg) scale(1.1); }
}

.success-message .close-btn {
  position: absolute;
  top: 5px;
  right: 10px;
  background: none;
  border: none;
  color: white;
  font-size: 18px;
  cursor: pointer;
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.success-message .close-btn:hover {
  opacity: 1;
}

.success-content {
  display: flex;
  align-items: center;
  gap: 15px;
}

.success-icon {
  font-size: 2rem;
  animation: pulse 1.5s infinite;
}

.success-text {
  flex: 1;
}

.success-title {
  font-size: 1.1rem;
  margin-bottom: 5px;
  font-weight: 700;
}

.success-subtitle {
  font-size: 0.9rem;
  opacity: 0.9;
}

/* Confetti Animation */
.confetti {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 10000;
}

.confetti-piece {
  position: absolute;
  width: 10px;
  height: 10px;
  background: #f093fb;
  animation: confetti-fall 3s ease-out forwards;
}

.confetti-piece:nth-child(odd) {
  background: #667eea;
  animation-delay: 0.5s;
}

.confetti-piece:nth-child(3n) {
  background: #4ade80;
  animation-delay: 1s;
}

@keyframes confetti-fall {
  0% {
    transform: translateY(-100vh) rotate(0deg);
    opacity: 1;
  }
  100% {
    transform: translateY(100vh) rotate(720deg);
    opacity: 0;
  }
}
</style>

<script>
$(function () {
    // Enhanced scroll behavior with smooth animations
    $(document).on('scroll', function(){
        if($(window).scrollTop() >= $(".logo").height()) {
            $(".navbar").addClass("navbar-fixed-top");
        }
        if($(window).scrollTop() < $(".logo").height()) {
            $(".navbar").removeClass("navbar-fixed-top");
        }
    });

    // Add loading animation to buttons
    $('.btn').click(function() {
        var $btn = $(this);
        if (!$btn.hasClass('no-loading')) {
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

    // Add hover sound effect (optional)
    $('.btn, .action-btn').hover(
        function() { $(this).addClass('hover-effect'); },
        function() { $(this).removeClass('hover-effect'); }
    );

    // Smooth scrolling for anchor links
    $('a[href^="#"]').click(function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 70
            }, 800, 'easeInOutCubic');
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Add ripple effect to buttons
    $('.btn').on('click', function(e) {
        var $btn = $(this);
        var $ripple = $('<span class="ripple"></span>');
        var offset = $btn.offset();
        var x = e.pageX - offset.left;
        var y = e.pageY - offset.top;
        
        $ripple.css({
            position: 'absolute',
            left: x,
            top: y,
            width: 0,
            height: 0,
            borderRadius: '50%',
            background: 'rgba(255, 255, 255, 0.5)',
            transform: 'translate(-50%, -50%)',
            animation: 'ripple 0.6s linear'
        });
        
        $btn.append($ripple);
        setTimeout(() => $ripple.remove(), 600);
    });

    // SUCCESS MESSAGE FUNCTIONALITY
    function showSuccessMessage() {
        // Create confetti
        createConfetti();
        
        // Create success message
        var successHtml = `
            <div class="success-message" id="successMessage">
                <button class="close-btn" onclick="closeSuccessMessage()">&times;</button>
                <div class="success-content">
                    <div class="success-icon">✨</div>
                    <div class="success-text">
                        <div class="success-title">Teacher Added Successfully!</div>
                        <div class="success-subtitle">Welcome to the team 🎓</div>
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(successHtml);
        
        // Show the message with animation
        setTimeout(function() {
            $('#successMessage').addClass('show');
        }, 100);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            closeSuccessMessage();
        }, 5000);
    }

    function createConfetti() {
        var confetti = $('<div class="confetti"></div>');
        $('body').append(confetti);
        
        for (var i = 0; i < 50; i++) {
            var piece = $('<div class="confetti-piece"></div>');
            piece.css({
                left: Math.random() * 100 + '%',
                animationDelay: Math.random() * 2 + 's'
            });
            confetti.append(piece);
        }
        
        // Remove confetti after animation
        setTimeout(function() {
            confetti.remove();
        }, 4000);
    }

    // Make close function global
    window.closeSuccessMessage = function() {
        $('#successMessage').removeClass('show');
        setTimeout(function() {
            $('#successMessage').remove();
        }, 500);
    };

    // Check for success parameter in URL
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'teacher_added') {
        showSuccessMessage();
        
        // Clean URL without refreshing
        var url = new URL(window.location);
        url.searchParams.delete('success');
        window.history.replaceState({}, '', url);
    }

    // Enhanced dropdown behavior for admin menu
    $('.dropdown').on('click', 'a[href*="q=4"], a[href*="q=5"]', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        window.location.href = href;
    });

    // Fix dropdown menu positioning
    $('.dropdown').on('shown.bs.dropdown', function() {
        var dropdown = $(this).find('.dropdown-menu');
        dropdown.css('z-index', 2000);
    });
});

// Add CSS for ripple animation
$('<style>').text(`
    @keyframes ripple {
        to {
            width: 200px;
            height: 200px;
            opacity: 0;
        }
    }
    .btn { position: relative; overflow: hidden; }
`).appendTo('head');
</script>
</head>

<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
</div>
<?php
include_once 'dbConnection.php';

// Fix: Check if session email exists before using it
if(!(isset($_SESSION['email']))) {
    header("location:index.php");
    exit();
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';

if($email) {
    echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="headdash.php" class="log log1">'.$email.'</a>&nbsp;|&nbsp;<a href="logout.php?q=index.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</a></span>';
}
?>
</div></div>

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
      <a class="navbar-brand" href="headdash.php?q=0"><b>Dashboard</b></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="headdash.php?q=0"><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="headdash.php?q=1"><span class="glyphicon glyphicon-user"></span> Users</a></li>
		<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="headdash.php?q=2"><span class="glyphicon glyphicon-stats"></span> Ranking</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="headdash.php?q=3"><span class="glyphicon glyphicon-envelope"></span> Feedback</a></li>
        <li class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active'; ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="headdash.php?q=4"><span class="glyphicon glyphicon-plus"></span> Add Teacher</a></li>
            <li><a href="headdash.php?q=5"><span class="glyphicon glyphicon-minus"></span> Remove Teacher</a></li>
          </ul>
        </li>
      </ul> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navigation menu closed-->

<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">
<!--home start-->

<?php if(@$_GET['q']==0) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-list-alt"></span> Available Quizzes</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Questions</b></td><td><b>Total Marks</b></td>
<td><b>+ve Marks</b></td><td><b>-ve Marks</b></td><td><b>Duration</b></td></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
  $wrong = $row['wrong'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$title.'</strong></td><td><span class="stat-number" style="font-size: 1rem;">'.$total.'</span></td><td><span class="stat-number" style="font-size: 1rem; color: var(--success-color);">'.$sahi*$total.'</span></td><td><span style="color: var(--success-color);">+'.$sahi.'</span></td><td><span style="color: var(--error-color);">-'.$wrong.'</span></td><td><span style="color: var(--warning-color);">'
  .$time.' min</span></td></tr>';
}
else
{
echo '<tr class="status-completed" style="background: rgba(74, 222, 128, 0.1);"><td><span class="rank-gold">'.$c++.'</span></td><td><strong>'.$title.'</strong>&nbsp;<span title="Quiz completed!" class="glyphicon glyphicon-ok" style="color: var(--success-color);"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>+'.$sahi.'</td><td>-'.$wrong.'</td><td>'.$time.' min</td><td><span style="color: var(--success-color); font-weight: 600;">Completed</span></td></tr>';
}
}
$c=0;
echo '</tbody></table></div></div>';
}

//ranking start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-trophy"></span> Student Rankings</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Stream</b></td><td><b>Score</b></td></tr></thead>';
echo '<tbody>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
$rankClass = '';
if($c == 1) $rankClass = 'rank-gold';
elseif($c == 2) $rankClass = 'rank-silver';
elseif($c == 3) $rankClass = 'rank-bronze';

echo '<tr><td><span class="'.$rankClass.'" style="font-size: 1.2rem; font-weight: 700;">#'.$c.'</span></td><td><strong>'.$name.'</strong></td><td>'.$gender.'</td><td>'.$college.'</td><td><span class="stat-number" style="font-size: 1.1rem; color: var(--success-color);">'.$s.'</span></td></tr>';
}
echo '</tbody></table></div></div>';
}

?>

<!--home closed-->
<!--users start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM user") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-users"></span> Registered Users</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Stream</b></td><td><b>Email</b></td><td><b>Mobile</b></td><td><b>Actions</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$mob = $row['mob'];
	$gender = $row['gender'];
    $email_user = $row['email'];
	$college = $row['college'];

	echo '<tr><td><span class="notification-badge">'.$c++.'</span></td><td><strong>'.$name.'</strong></td><td>'.$gender.'</td><td>'.$college.'</td><td><a href="mailto:'.$email_user.'" style="color: var(--primary-color);">'.$email_user.'</a></td><td><a href="tel:'.$mob.'" style="color: var(--primary-color);">'.$mob.'</a></td>
	<td><a title="Delete User" href="update.php?demail='.$email_user.'" class="action-btn" style="color: var(--error-color);"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td></tr>';
}
$c=0;
echo '</tbody></table></div></div>';
}?>
<!--user end-->

<!--feedback start-->
<?php if(@$_GET['q']==3) {
$result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-comment"></span> User Feedback</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Email</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td><b>View</b></td><td><b>Action</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$subject = $row['subject'];
	$name = $row['name'];
	$email_feedback = $row['email'];
	$id = $row['id'];
	 echo '<tr><td><span class="notification-badge">'.$c++.'</span></td>';
	echo '<td><a title="Click to open feedback" href="headdash.php?q=3&fid='.$id.'" style="color: var(--primary-color); font-weight: 600;">'.$subject.'</a></td><td><a href="mailto:'.$email_feedback.'" style="color: var(--primary-color);">'.$email_feedback.'</a></td><td><span style="color: var(--dark-color);">'.$date.'</span></td><td><span style="color: var(--dark-color);">'.$time.'</span></td><td><strong>'.$name.'</strong></td>
	<td><a title="Open Feedback" href="headdash.php?q=3&fid='.$id.'" class="action-btn" style="color: var(--warning-color);"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a></td>';
	echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'" class="action-btn" style="color: var(--error-color);"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td></tr>';
}
echo '</tbody></table></div></div>';
}
?>
<!--feedback closed-->

<!--feedback reading portion start-->
<?php if(@$_GET['fid']) {
echo '<div class="section-spacing">';
$id=@$_GET['fid'];
$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$subject = $row['subject'];
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$feedback = $row['feedback'];
	
echo '<div class="feedback-card">';
echo '<div class="feedback-header">';
echo '<a title="Back to Feedback List" href="headdash.php?q=3" style="color: white; float: right;"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</a>';
echo '<h2 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-comment"></span> '.$subject.'</h2>';
echo '</div>';
echo '<div style="margin: 20px 0; padding: 15px; background: rgba(102, 126, 234, 0.05); border-radius: 8px; border-left: 4px solid var(--primary-color);">';
echo '<div style="display: flex; gap: 20px; margin-bottom: 15px; flex-wrap: wrap;">';
echo '<span style="color: var(--dark-color);"><strong>Date:</strong> '.$date.'</span>';
echo '<span style="color: var(--dark-color);"><strong>Time:</strong> '.$time.'</span>';
echo '<span style="color: var(--dark-color);"><strong>From:</strong> '.$name.'</span>';
echo '</div>';
echo '</div>';
echo '<div style="line-height: 1.6; padding: 20px; background: rgba(248, 250, 252, 0.8); border-radius: 8px; margin-top: 20px;">';
echo '<h4 style="color: var(--primary-color); margin-bottom: 15px;">Feedback Content:</h4>';
echo '<p style="color: var(--dark-color); font-size: 16px;">'.$feedback.'</p>';
echo '</div>';
echo '</div>';
}
echo '</div>';
}?>
<!--Feedback reading portion closed-->

<!--add admin start-->
<?php
if(@$_GET['q']==4) {
echo '<div class="section-spacing">';
echo '<div class="row">';
echo '<div class="col-md-3"></div>';
echo '<div class="col-md-6">';
echo '<div style="text-align: center; margin-bottom: 30px;">';
echo '<div style="background: var(--gradient-primary); color: white; padding: 25px; border-radius: 16px 16px 0 0; margin-bottom: 0;">';
echo '<h2 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-plus-sign"></span> Add New Teacher</h2>';
echo '<p style="margin: 10px 0 0 0; opacity: 0.9;">Welcome a new educator to our platform</p>';
echo '</div>';
echo '</div>';
echo '<form class="form-horizontal title1" name="form" action="signadmin.php?q=headdash.php?q=4" method="POST">';
echo '<fieldset>';
echo '<div class="form-group">';
echo '<label class="col-md-12 control-label" style="text-align: left; color: var(--dark-color); font-weight: 600;">Teacher Email Address</label>';  
echo '<div class="col-md-12">';
echo '<input id="email" name="email" placeholder="Enter teacher email address" class="form-control input-md" type="email" required>';
echo '</div>';
echo '</div>';
echo '<div class="form-group">';
echo '<label class="col-md-12 control-label" style="text-align: left; color: var(--dark-color); font-weight: 600;">Password</label>';  
echo '<div class="col-md-12">';
echo '<input id="password" name="password" placeholder="Create a secure password" class="form-control input-md" type="password" required>';
echo '</div>';
echo '</div>';
echo '<div class="form-group">';
echo '<div class="col-md-12" style="text-align: center;">';
echo '<input type="submit" class="btn btn-primary" value="Add Teacher" style="width: 100%; padding: 15px; font-size: 16px;"/>';
echo '</div>';
echo '</div>';
echo '</fieldset>';
echo '</form>';
echo '</div>';
echo '<div class="col-md-3"></div>';
echo '</div>';
echo '</div>';
}
?>
<!--add admin end-->

<!--remove admin start-->
<?php if(@$_GET['q']==5) {

$result = mysqli_query($con,"SELECT * FROM admin where role ='admin' ") or die('Error');
echo '<div class="section-spacing">';
echo '<div class="panel">';
echo '<div style="background: var(--gradient-secondary); color: white; padding: 20px; margin: -1px -1px 0 -1px; border-radius: 15px 15px 0 0;">';
echo '<h3 style="margin: 0; font-weight: 600;"><span class="glyphicon glyphicon-minus-sign"></span> Remove Teachers</h3>';
echo '</div>';
echo '<table class="table table-striped title1">';
echo '<thead><tr><td><b>Teacher Email</b></td><td><b>Actions</b></td></tr></thead>';
echo '<tbody>';
$c=1;
while($row = mysqli_fetch_array($result)) {
    $email_admin = $row['email'];
    echo '<tr><td><strong>'.$email_admin.'</strong></td>';
    echo '<td><a title="Remove Teacher" href="update.php?demail1='.$email_admin.'" class="action-btn" style="color: var(--error-color);" onclick="return confirm(\'Are you sure you want to remove this teacher?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove</a></td></tr>';
}
$c=0;
echo '</tbody></table></div></div>';
}?>
<!--remove admin end-->

</div><!--col-md-12 closed-->
</div><!--row closed-->
</div><!--container closed-->

<!-- Add some footer space -->
<div style="height: 100px;"></div>

</body>
</html>
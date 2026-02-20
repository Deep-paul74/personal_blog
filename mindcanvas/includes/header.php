<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/../config/db.php";

$allowed_pages = ['login.php','register.php'];
$current_page = basename($_SERVER['PHP_SELF']);

if(!isset($_SESSION['user_id']) && !in_array($current_page, $allowed_pages)){
    header("Location: /mindcanvas/login.php");
    exit;
}

if(strpos($_SERVER['PHP_SELF'], '/admin/') !== false){
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
        header("Location: /mindcanvas/index.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>MindCanvas Blog</title>
<link rel="stylesheet" href="/mindcanvas/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Dancing+Script:wght@400..700&family=Gravitas+One&display=swap" rel="stylesheet">
</head>
<body>

<div class="topbar">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="left-box">
      <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
        <a href="/mindcanvas/admin/dashboard.php" class="btn btn-dark btn-sm">Dashboard</a>
      <?php endif; ?>
    </div>

    <div class="center-box">
      <img src="/mindcanvas/images/logo.jpg" class="rounded-circle" alt="Logo">
      <span class="logo-text">MindCanvas</span>
    </div>

    <div class="right-box">
         <div class="social-icons">
                <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="mailto:mindcanvas@gmail.com"><i class="bi bi-envelope"></i></a>
        </div>

      <?php if(isset($_SESSION['user_id'])): ?>
        <span class="user-name">Welcome,<br> <?php echo $_SESSION['user_name']; ?></span>
        <a href="/mindcanvas/logout.php" class="btn btn-danger btn-sm">Logout</a>
      <?php else: ?>
        <a href="/mindcanvas/login.php" class="btn btn-dark btn-sm">Login</a>
        <a href="/mindcanvas/register.php" class="btn btn-light btn-sm">Register</a>
      <?php endif; ?>
    </div>

  </div>
</div>

<div class="menu">
 <div class="container d-flex justify-content-between align-items-center">
  <div>
    <a href="/mindcanvas/index.php">Home</a>
    <a href="/mindcanvas/about.php">About</a>
    <a href="/mindcanvas/contact.php">Contact</a>
    <a href="/mindcanvas/privacy.php">Privacy</a>
  </div>
  <form action="/mindcanvas/search.php" method="get" class="search-form">
    <input type="text" name="q" placeholder="Search posts..." required>
    <button type="submit">🔍</button>
  </form>
 </div>
</div>

<?php
$show_slider = ['index.php','category.php'];
if(in_array(basename($_SERVER['PHP_SELF']), $show_slider)):
?>
<div class="slider">
    <img src="/mindcanvas/images/font.jpeg" alt="Slider">
</div>
<?php endif; ?>

<div class="container mt-3">
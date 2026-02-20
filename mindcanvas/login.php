<?php
session_start(); 
include "config/db.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass  = md5($_POST['password']); 

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
    if($res->num_rows==1){
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['role'] = $row['role']; 
        
        header("Location: index.php");
        exit();
    }else{
        $msg = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 col-md-4">
<div class="post-box">
<h3>Login</h3>

<?php if(isset($msg)) echo "<div class='alert alert-danger'>$msg</div>"; ?>

<form method="post">
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button name="login" class="btn btn-warning w-100">Login</button>
</form>

<p class="mt-2 text-center">
Don't have an account? 
<a href="register.php" class="btn btn-sm btn-secondary">Register</a>
</p>

</div>
</div>

</body>
</html>
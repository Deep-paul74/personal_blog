<?php
include "config/db.php";

$msg = "";

if(isset($_POST['register'])){

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);

    $check = $conn->query("SELECT id FROM users WHERE email='$email'");

    if($check->num_rows > 0){
        $msg = "<div class='alert alert-danger text-center'>Email already exists!</div>";
    }else{
        $conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
        header("Location: login.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 col-md-4">
<div class="post-box">

<h3 class="text-center">Register</h3>

<?= $msg ?>

<form method="post">

<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>

<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

<button name="register" class="btn btn-warning w-100">Register</button>

<p class="mt-2 text-center">
Already have an account? 
<a href="login.php" class="btn btn-sm btn-secondary">Login</a>
</p>

</form>

</div>
</div>

</body>
</html>
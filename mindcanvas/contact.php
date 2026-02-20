<?php
include "config/db.php";
include "includes/header.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$success = false;

if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = mysqli_query($conn, "INSERT INTO contacts(name, email, message) 
                                   VALUES('$name', '$email', '$message')");
    
    if($insert){
        $success = true;
    }
}
?>

<div class="container mt-4">
    <div class="card shadow col-md-6 mx-auto">
        <div class="card-body">
            <h4 class="text-center mb-4">Contact Us</h4>

            <?php if($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your message has been sent successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Your Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                
                <div class="mb-3">
                    <label>Your Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label>Your Message</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="How can we help you?" required></textarea>
                </div>

                <button name="send" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
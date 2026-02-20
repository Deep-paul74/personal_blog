<?php
include "../config/db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM contacts WHERE id='$id'");

header("Location: messages.php");
exit;
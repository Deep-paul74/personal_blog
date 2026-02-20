

<?php
$conn = new mysqli("localhost","root","","mindcanvas");
if($conn->connect_error) die("DB Error");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
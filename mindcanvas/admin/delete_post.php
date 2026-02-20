<?php
include "../config/db.php";
if(!isset($_SESSION['user_id'])){ header("Location: ../login.php"); exit; }

$id=(int)$_GET['id'];
$conn->query("DELETE FROM posts WHERE id=$id");

header("Location: dashboard.php");
<?php
include "../config/db.php";
if(!isset($_SESSION['user_id'])){ header("Location: ../login.php"); exit; }

$id = (int)$_GET['id'];
$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){

$title=$_POST['title'];
$content=$_POST['content'];

$conn->query("UPDATE posts SET title='$title',content='$content' WHERE id=$id");
header("Location: dashboard.php");
}
include "../includes/header.php";
?>

<h3>Edit Post</h3>

<form method="post">
<input type="text" name="title" class="form-control mb-2" value="<?php echo $post['title']; ?>">
<textarea name="content" class="form-control mb-2" rows="6"><?php echo $post['content']; ?></textarea>
<button name="update" class="btn btn-warning">Update</button>
</form>

<?php include "../includes/footer.php"; ?>
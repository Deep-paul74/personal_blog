





<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../config/db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){ 
    header("Location: ../index.php"); 
    exit; 
}

include "../includes/header.php";
?>

<h3>Admin Dashboard</h3>
<a href="add_post.php" class="btn btn-success mb-3">Add New Post</a>
<a href="messages.php" class="btn btn-info mb-3">View Messages</a>

<table class="table table-bordered bg-white">
<tr class="table-dark">
<th>ID</th><th>Title</th><th>Action</th>
</tr>

<?php
$q=$conn->query("SELECT * FROM posts ORDER BY id ASC");
while($row=$q->fetch_assoc()):
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td>
<a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="delete_post.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>

<?php endwhile; ?>
</table>

<?php include "../includes/footer.php"; ?>
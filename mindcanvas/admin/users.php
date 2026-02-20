<?php
include "../config/db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

include "../includes/header.php";

$res = mysqli_query($conn,"SELECT id,name,email,created_at FROM users ORDER BY id DESC");
?>

<div class="container mt-4">
<h3>All Users</h3>

<table class="table table-bordered table-striped">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Joined</th>
<th>Action</th>
</tr>

<?php while($u = mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?= $u['id'] ?></td>
<td><?= $u['name'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['created_at'] ?></td>
<td>
    <a href="view_user.php?id=<?= $u['id'] ?>" class="btn btn-primary btn-sm">
        View
    </a>
</td>
</tr>
<?php } ?>

</table>
</div>

<?php include "../includes/footer.php"; ?>
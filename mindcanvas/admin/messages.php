<?php
include "../config/db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

include "../includes/header.php";

$result = mysqli_query($conn,"SELECT * FROM contacts ORDER BY id DESC");
?>

<div class="container mt-4">
    <h3>Contact Messages</h3>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['message']; ?></td>
            <td><?= $row['created_at']; ?></td>
            <td>
                <a href="delete_message.php?id=<?= $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this message?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>
</div>

<?php include "../includes/footer.php"; ?>
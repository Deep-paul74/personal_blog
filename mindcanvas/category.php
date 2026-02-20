<?php include "includes/header.php"; ?>

<div class="row">
<div class="col-md-8">

<?php
$cid = (int)$_GET['id'];
$sql = $conn->query("SELECT * FROM posts WHERE category_id=$cid ORDER BY id DESC");

while($row=$sql->fetch_assoc()):
?>

<div class="post-box">
 <div class="post-title"><?php echo $row['title']; ?></div>
 <br>
 <?php echo substr(strip_tags($row['content']),0,200); ?>...
 <br><br>
 <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Read More</a>
</div>

<?php endwhile; ?>

</div>

<?php include "includes/sidebar.php"; ?>
</div>

<?php include "includes/footer.php"; ?>
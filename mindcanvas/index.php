<?php
include "includes/header.php";
?>

<div class="row">

<div class="col-md-8">

<?php
$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

$start = ($page - 1) * $limit;

$total = $conn->query("SELECT id FROM posts")->num_rows;
$total_pages = ceil($total / $limit);

$sql = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT $start,$limit");

while($row = $sql->fetch_assoc()):
?>

<div class="single-post">

    <h2><?php echo $row['title']; ?></h2>

    <p class="meta">
        <?php echo date("F d, Y, h:i a", strtotime($row['created_at'])); ?>
    </p>

    <div class="post-content">

        <div class="post-img">
            <img src="uploads/<?php echo $row['image']; ?>">
        </div>

        <div class="post-text">
            <?php echo substr(strip_tags($row['content']),0,300); ?>...
            <br><br>
            <a href="post.php?id=<?php echo $row['id']; ?>" class="read-more">Read More</a>
        </div>

    </div>

</div>

<?php endwhile; ?>

<div class="pagination">
<?php for($i=1; $i<=$total_pages; $i++): ?>
    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>
</div>

</div>

<?php include "includes/sidebar.php"; ?>

</div>

<?php include "includes/footer.php"; ?>
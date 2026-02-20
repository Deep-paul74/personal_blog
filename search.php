<?php include "includes/header.php"; ?>

<div class="row">
<div class="col-md-8">

<div class="post-box">
<h3>Search Results</h3>

<?php
if(isset($_GET['q'])){
    $key = $conn->real_escape_string($_GET['q']);

    $sql = $conn->query("SELECT * FROM posts 
    WHERE title LIKE '%$key%' OR content LIKE '%$key%'
    ORDER BY id DESC");

    if($sql->num_rows > 0){

        while($row = $sql->fetch_assoc()):
        ?>

        <div class="single-post">
            <h2><?php echo $row['title']; ?></h2>
            <p class="meta"><?php echo $row['created_at']; ?></p>

            <div class="post-content">
                <div class="post-img">
                    <img src="uploads/<?php echo $row['image']; ?>">
                </div>

                <div class="post-text">
                    <?php echo substr(strip_tags($row['content']),0,250); ?>...
                    <br><br>
                    <a href="post.php?id=<?php echo $row['id']; ?>" class="read-more">Read More</a>
                </div>
            </div>
        </div>

        <?php endwhile;

    }else{
        echo "<div class='alert alert-warning'>No result found!</div>";
    }
}
?>

</div>

</div>

<?php include "includes/sidebar.php"; ?>
</div>

<?php include "includes/footer.php"; ?>
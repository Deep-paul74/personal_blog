<?php if(!isset($conn)) include __DIR__."/../config/db.php"; ?>

<div class="col-md-4">

    <div class="sidebar">
        <div class="sidebar-title">Categories</div>
        <ul class="sidebar-list">
        <?php
        $c = $conn->query("SELECT * FROM categories");
        while($row = $c->fetch_assoc()):
        ?>
            <li>
                <a href="/mindcanvas/category.php?id=<?php echo $row['id']; ?>">
                    <?php echo $row['name']; ?>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>

    <br>

    <div class="sidebar">
        <div class="sidebar-title">Latest Posts</div>
        <ul class="sidebar-list">
        <?php
        $l = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
        while($row = $l->fetch_assoc()):
        ?>
            <li>
                <a href="/mindcanvas/post.php?id=<?php echo $row['id']; ?>">
                    <?php
                    if(!empty($row['thumbnail'])): ?>
                        <img src="/mindcanvas/uploads/<?php echo $row['thumbnail']; ?>" class="sidebar-thumb" alt="thumb">
                    <?php endif; ?>
                    <?php echo $row['title']; ?>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>

</div>

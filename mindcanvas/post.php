<?php
include "../includes/db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category_id = (int)$_POST['category_id'];
    $image = "";

    if(!empty($_FILES['image']['name'])){

        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_size = $_FILES['image']['size'];

        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];

        if(in_array($ext, $allowed)){
            if($img_size < 3000000){ 

                $new_name = time().".".$ext;
                move_uploaded_file($tmp_name, "../uploads/".$new_name);
                $image = $new_name;

            } else {
                echo "<div style='color:red;'>Image too large (Max 3MB)</div>";
            }
        } else {
            echo "<div style='color:red;'>Invalid image format</div>";
        }
    }

    $stmt = $conn->prepare("INSERT INTO posts (user_id, category_id, title, content, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("iisss", $user_id, $category_id, $title, $content, $image);

    if($stmt->execute()){
        echo "<div style='color:green;'>Post Added Successfully!</div>";
    } else {
        echo "<div style='color:red;'>Error: ".$stmt->error."</div>";
    }

    $stmt->close();
}
?>

<h2>Add New Post</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Title</label><br>
    <input type="text" name="title" required><br><br>

    <label>Category</label><br>
    <select name="category_id" required>
        <option value="">Select Category</option>

        <?php
        $cats = $conn->query("SELECT * FROM categories");
        while($cat = $cats->fetch_assoc()){
            echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
        }
        ?>
    </select><br><br>

    <label>Content</label><br>
    <textarea name="content" rows="6" required></textarea><br><br>

    <label>Image</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Publish Post</button>

</form>
<?php
include "../config/db.php";
if(!isset($_SESSION['user_id'])){ header("Location: ../login.php"); exit; }

if(isset($_POST['add'])){

$title=$_POST['title'];
$content=$_POST['content'];
$cat=$_POST['category'];

$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

if($img){
 move_uploaded_file($tmp,"../uploads/".$img);
}

$conn->query("INSERT INTO posts(user_id,category_id,title,content,image)
VALUES('{$_SESSION['user_id']}','$cat','$title','$content','$img')");

header("Location: dashboard.php");
}
include "../includes/header.php";
?>

<h3>Add Post</h3>

<form method="post" enctype="multipart/form-data">
<input type="text" name="title" class="form-control mb-2" placeholder="Post Title" required>

<select name="category" class="form-control mb-2">
<?php
$c=$conn->query("SELECT * FROM categories");
while($row=$c->fetch_assoc()):
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php endwhile; ?>
</select>

<textarea name="content" class="form-control mb-2" rows="6" placeholder="Post Content"></textarea>

<input type="file" name="image" class="form-control mb-2">

<button name="add" class="btn btn-success">Publish</button>
</form>

<?php include "../includes/footer.php"; ?>
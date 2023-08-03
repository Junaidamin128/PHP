<?php
require_once "conn.php";

if (!$uid) {
    header("Location: " . BASE_URL);
}
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $filename = uniqid() . $_FILES['image']['name'];
    // d($_FILES);
    move_uploaded_file($_FILES['image']['tmp_name'], "./upload/$filename");
    $query = "INSERT INTO `article` (`title`, `body`, `image`, `author`) VALUES ('$title', '$body', '$filename', '$uid')";
    $query = mysqli_query($conn, $query);
    if (!$query) {
        $msg = "";
    } else {
        $id = mysqli_insert_id($conn);
        $catValues = [];
        foreach ($_POST['category'] as $cid) {
            $catValues[] = "($cid, $id)";
        }
        $catQuery = "INSERT INTO `category_article` (`cid`, `aid`) VALUES " . implode(", ", $catValues);
        $catQuery = mysqli_query($conn, $catQuery);
        header("location: " . BASE_URL . '/post.php?id=' . $id);
    }
}



$categories = getCategories();
?>

<?php
require "./Components/navbar.php";

?>
<div class=" container m-auto text-center">
    <form method="POST" class="d-flex flex-column p-5 w-50 m-auto login_form jumbotron" enctype="multipart/form-data">
        <label class="w-100 " for="title">Title:
            <input class="w-100 p-2 rounded" type="text" name="title" placeholder="title">
        </label>
        <label class="w-100 " for="body">Body:
            <textarea class="w-100 p-2 rounded" type="text" name="body" placeholder="body"></textarea>
        </label>
        <label class="w-100 " for="image">Image:
            <input class="w-100 p-2 rounded" type="file" name="image">
        </label>
        <div>
            <?php foreach ($categories as $category) : ?>
                <label class="al">
                    <?= $category['name'] ?>
                    <input type="checkbox" name="category[]" value="<?php echo $category['cid']; ?>" />
                </label>
                <br>
            <?php endforeach; ?>
        </div>
        <input type="submit" name="submit" value="Submit" class="p-2 align-self-lg-stretch mt-4 w-100  bg-transparent rounded  ">
    </form>


</div>


<?php
require "./Components/footer.php";

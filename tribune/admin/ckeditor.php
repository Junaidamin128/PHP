<?php
require_once "../conn.php";


$categories = getCategoryTree(0);
$categories = getCategoryOptions($categories);
if (isset($_POST['submit'])) {
    $filename = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/$filename");

    $id = $_SESSION['uid'];
    $title = $_POST['name'];
    $body = $_POST['body'];
    $category[] = $_POST['cat'];
    $sql = $conn->prepare("INSERT INTO `news`( `author`, `title`, `body`, `image`) VALUES (:id,:title,:body,:image)");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':title', $title);
    $sql->bindParam(':body', $body);
    $sql->bindParam(':image', $filename);
    $result = $sql->execute();
    $nid = $conn->lastInsertId();
    foreach($category as $c){
        foreach($c as $cat){
        $cid = $cat;
        $catsql = $conn->prepare("INSERT INTO `newscategory`(`nid`,`cid`) VALUES (:nid,:cid)");
        $catsql->bindParam(':nid', $nid);
        $catsql->bindParam(':cid', $cid);
        $catresult = $catsql->execute();
        }
    }
    header("location:".BASE_URL."/admin/admin-news.php");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CKEditor</title>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <label class="w-100 p-2" for="title">Title:
            <input class="w-75 rounded-pill p-2" name="name" type="text" />
        </label>
        <input type="file" name="image" id="" />
            <?php foreach ($categories as $cat) : ?>
                <div>
                    <label>
                        <?= str_repeat("--", $cat['level']) ?> <?= $cat['name'] ?>
                        <input type="checkbox" name="cat[]" value="<?= $cat['cid'] ?>">
                    </label>
                </div>
            <?php endforeach; ?>
        <textarea name="body"></textarea>
        <input class="btn btn-success my-2 p-2" name="submit" type="submit" value='save' />
        <a class="btn btn-success my-2 p-2" href="./admin.php">cancel</a>
    </form>
    <script>
        CKEDITOR.replace('body', {
            height: 300,
            filebrowserUploadUrl: "upload.php",
            filebrowserUploadMethod: "form",
        });
    </script>
</body>

</html>
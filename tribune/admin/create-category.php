<?php
require_once "../conn.php";
include "../Components/header.php";
$error = "";
$id = Null;
$categories = getCategoryTree(0);
$categories = getCategoryOptions($categories);




if (isset($_POST['create-category'])) {
    $category = $_POST['categoryname'];
    $pcat = $_POST['category'];

    $catsql = $conn->prepare("INSERT INTO `category`( `parent`, `name`) VALUES (:parent,:name)");
    $catsql->bindParam(':parent',$pcat);
    $catsql->bindParam(':name',$category);
    $catsql->execute();
    header("location:".BASE_URL."/admin/admin-category.php");
}
?>
<form class="w-50 m-auto bg-light p-5 " method="post">
    <label class="w-100 p-2" for="title">Category Name:
        <input class="w-75 rounded-pill p-2" name="categoryname" type="text" />
    </label>
    <label class="w-100 p-2" for="title">Parent Category Name:
        <select name="category">
            <option value="0">--None--</option>
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat['cid']?>"><?= str_repeat("--", $cat['level'])?> <?= $cat['name']?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <input class="btn btn-success my-2 p-2 " name="create-category" type="submit" value='save' />
</form>
<h2><?= $error ?></h2>
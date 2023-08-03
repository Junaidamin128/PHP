<?php
require_once "../conn.php";

$stmt = $conn->prepare("SELECT * FROM `category`");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
include "../Components/header.php";
?>
<div class="container-fluid row p-0 m-0" style="height:100vh;">
    <?php include "./admin-nav.php" ?>
    <section class="content col-10 p-0">

        <h3>Category</h3>
        <table class="table table-striped m-auto w-100 text-center">
            <thead>
                <tr>
                    <th style="width: 70px;">sr no.</th>
                    <th>category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $category) : ?>
                    <tr>
                        <td><?= $category['cid'] ?></td>
                        <td><?= $category['name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create-category.php" class="btn btn-success">Create Category</a>
    </section>
</div>

<?php
include "../Components/footer.php";
?>
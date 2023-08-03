<?php
require_once "../conn.php";
include "../Components/header.php";
$asql = $conn->prepare("SELECT * FROM `author`");
$asql->execute();
$results = $asql->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid row p-0 m-0" style="height:100vh;">
    <?php include "./admin-nav.php"?>
    <section class="content col-10 p-0">
    <h3>Author</h3>
    <table class="table table-striped m-auto w-100 text-center">
        <thead>
            <tr>
                <th style="width: 70px;">sr no.</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $result):?>
                <tr>
                <td><?= $result['aid']?></td>
                <td><?= $result['name']?></td>
            </tr>
                <?php endforeach;?>
        </tbody>
    </table>
    <a href="create_author.php" class="btn btn-success">Create Post</a>
    </section>
</div>

<?php 
include "../Components/footer.php";
?>
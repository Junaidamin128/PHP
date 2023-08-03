<?php
require_once "../conn.php";

$sql = $conn->prepare("SELECT * FROM `news`");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);


include "../Components/header.php";
?>
<div class="container-fluid row p-0 m-0" style="height:100vh;">
    <?php include "./admin-nav.php"?>
    <section class="content col-10 p-0">
    <table class="table table-striped m-auto w-100 text-center">
        <thead>
            <tr>
                <th style="width: 70px;">sr no.</th>
                <th>Title</th>
                <th>Body</th>
                <th>Image</th>
                <th>Author</th>
                <th>Timestamp</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?=$result['nid']?></td>
                <td><?=$result['title']?></td>
                <td><?= $result['body']?></td>
                <td><img width="100px" src="../images/<?=$result['image']?>" alt=""></td>
                <td><?= $result['author']?></td>
                <td>created</td>
                <td><a href="" class="btn btn-primary m-1">Edit</a><a href="" class="btn btn-primary m-1">Delete</a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <a href="create_post.php" class="btn btn-success">Create Post</a>
    </section>
</div>

<?php 
include "../Components/footer.php";
?>
<?php
require_once "../conn.php";

if (!isset($_SESSION['uid'])) {
    header("location:login.php");
}

$stmt = $conn->prepare("SELECT * FROM `category`");
$stmt->execute();
$category = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = $conn->prepare("SELECT * FROM `news`");
$sql->execute();
$news = $sql->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM `author`");
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);


include "../Components/header.php";
?>
<div class="container-fluid row p-0 m-0" style="height:100vh;">
    <?php include "./admin-nav.php"?>
    <section class="content col-10 p-0">
    
    <div class="card-wrapper row m-auto">
        <div class="card col-3  text-center border-info m-1">
            <h3>NEWS</h3>
            <p><?= count($news)?>
            </p>
        </div>
        <div class="card col-3  text-center border-info m-1">
            <h3>Author</h3>
            <p><?= count($authors)?></p>
        </div>
        <div class="card col-3  text-center border-info m-1">
            <h3>Category</h3>
            <p><?= count($category)?></p>
        </div>
    </div>
    </section>
</div>

<?php 
include "../Components/footer.php";
?>
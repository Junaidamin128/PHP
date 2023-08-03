<?php
require_once "conn.php";


$id = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$post = getPost($id);

require "./Components/navbar.php";
?>
<?php if (!$post) : ?>
    <div>post not found</div>
<?php else : ?>
    <div>
        <h4><?= $post['author_info']['name']?></h4>
        <img src="<?= BASE_URL . "/upload/" . $post['image'] ?>" />
        <h3><?= $post['title']; ?></h3>
        <p><?= $post['body']; ?></p>
    </div>
<?php endif; ?>
<?php 
require "./Components/footer.php"
?>
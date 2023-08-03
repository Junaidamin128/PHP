<?php
require_once "conn.php";

$user = null;
if (isset($_GET['id'])) {
    $uid = $_GET['id'];
    if ($uid) {
        $sql = "SELECT * FROM `user` WHERE `uid`='$uid'";
        $query = $conn->query($sql);
        $user = mysqli_fetch_assoc($query);
    }
}

if (!$user) {
    echo 'User not found';
    exit;
}


include "Components/header.php"
?>

<h1><?= $user['fullname'] ?></h1>

<div class="friend-status">
    <?= renderFriendStatutsButtons($user); ?>
</div>
<section class="col-10 border">
    <?php 
        foreach (get_posts("user", $user['uid']) as $post) {
            render_post($post);
        }
    ?>
</section>

<?php
include "Components/footer.php";
?>
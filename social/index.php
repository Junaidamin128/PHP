<?php
require_once "conn.php";
if (!$current_user) {
    header("location: login.php");
    exit;
}


include "./Components/header.php";
?>
<div class="container-fluid">
    <div class="row">
        <aside class="border col-2">
            <a href="./profile.php" class="text-uppercase text-reset ">
                <img class="w-100 rounded-circle m-2" src="./images/10x-featured-social-media-image-size.png" alt="">
                <h3 class="text-center"><?= $current_user['fullname'] ?></h3>
            </a>
            <h3 class="m-auto"><a class="btn btn-primary text-decoration-none text-body border p-2 rounded" href="./create-post.php">Create Post</a></h3>
        </aside>
        <section class="col-8 border">
            <?php
            foreach (get_posts("all") as $post) {
                render_post($post);
            }
            ?>
            <button class="load">Load More</button>
        </section>
        <section class="col-2 border ">
            <?php include "friendlist.php" ?>
        </section>
    </div>
</div>
<!-- Button trigger modal -->
<div id="post-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
include "./Components/footer.php"
?>
<?php
require_once "conn.php";

include "./Components/header.php";

if (isset($_POST['submit'])) {
    $filename = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], BASE_URL."/images/$filename");
    $query = mysqli_query($conn, "UPDATE `user` SET `profileimg`='$filename' WHERE uid = $current_user[uid]");
    if ($query) {
        $postSql = "INSERT INTO `posts` (`pid`, `author`,`type`, `created`) VALUES (NULL, '$current_user[uid]','profile', current_timestamp())";
        $query = $conn->query($postSql);
        $pid = mysqli_insert_id($conn);
        $imgsSql = "INSERT INTO `postimages` (`pimgid`, `pid`, `imgname`) VALUES (NULL, '$pid', '$filename')";
        $query = $conn->query($imgsSql);
    }
}
?>
<div class="container border ">
    <div class="w-100 d-block"><img src="./images/10x-featured-social-media-image-size.png" alt=""></div>
    <button class="profile-img">Upload Image</button>

</div>

<!-- modal -->
<div id="profile-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body d-flex flex-column">
                <form enctype="multipart/form-data" method="post">
                    <?php if ($current_user['profileimg']) : ?>
                        <img src="./images/<?= $current_user['profileimg'] ?>" alt="">
                    <?php endif; ?>
                    <input class="p-2" type="file" name="file" id="">
                    <input class="m-1 profile-imgsubmit" name="submit" type="submit" value="Upload">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
include "./Components/footer.php";
?>
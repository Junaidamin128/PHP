<?php
require_once "conn.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `uid`= $id");
$userinfo = $query->fetch_all(MYSQLI_ASSOC);

include "./Components/header.php";

?>
<style>
    .msg {
        display: flex;
    }

    .msg-content {
        background-color: grey;
        padding: 5px;
        border-radius: 5px;
        min-width: 200px;
        color: white;
    }

    .msg-status {
        width: 20px;
        height: 20px;
        border: 1px solid black;
        border-radius: 50%;
    }

    .msg-status.sent {
        background: blue;
        border: 1px solid black;
    }

    .msg-send {
        flex-direction: row-reverse;
    }

    .msg-send .msg-content {
        background-color: blue;
    }
    .chat-container{
        height: 50vh;
        overflow: scroll;
        scroll-behavior: smooth;
    }
</style>
<div class="container chat border">
    <h3><?= $userinfo[0]['fullname'] ?></h3>
    <div data-id="<?= $id?>" class="chat-container">
        <div class="msg msg-send">
            <div class="msg-content">Hello</div>
            <div class="msg-status"></div>
        </div>
        <div class="msg">
            <div class="msg-content">Hello</div>
        </div>
    </div>
    <form class="row" method="post" enctype="multipart/form-data">
        <input type="text" name="id" hidden id="rid" value="<?= $userinfo[0]['uid'] ?>">
        <input type="text" id="sid" hidden value="<?= $current_user['uid'] ?>">
        <textarea name="msg" id="msg" class="col-12" placeholder="Enter your message"></textarea>
        <button class="msg-submit btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<?php
include "./Components/footer.php";
?>
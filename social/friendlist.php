<?php
require_once "conn.php";

$query = "SELECT * FROM `friends` WHERE `accepted` = 1";
$query = mysqli_query($conn, $query);
$results = $query->fetch_all(MYSQLI_ASSOC);


$friends = [];
foreach ($results as $result) {
    if ($current_user['uid'] == $result['sender']) {
        $reciever = $result['reciever'];
        $sql = mysqli_query($conn, "SELECT * FROM `user` WHERE `uid` = $reciever");
        $friends[] = $sql->fetch_all(MYSQLI_ASSOC)[0];
    }
    if ($current_user['uid'] == $result['reciever']) {
        $sender = $result['sender'];
        $sql = mysqli_query($conn, "SELECT * FROM `user` WHERE `uid` = $sender");
        $friends[] = $sql->fetch_all(MYSQLI_ASSOC)[0];
    }
}




?>
<div>
    <h4>Friends</h4>
    <ul>
        <?php foreach ($friends as $friend) : ?>
            <li class="list-unstyled "><a href="chat.php?id=<?= $friend['uid'] ?>" class="text-decoration-none text-dark"><?= $friend['fullname'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
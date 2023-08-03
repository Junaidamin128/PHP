<?php
include "../conn.php";
$uid = $current_user['uid'];
$id = $_POST['id'];
$query = mysqli_query($conn,"SELECT * FROM `message` WHERE (`sid`=$uid AND `rid`=$id) OR (`sid`=$id AND `rid`=$uid)  ORDER BY `created`");

$result = $query->fetch_all(MYSQLI_ASSOC);

echo json_encode(['success'=>true, 'msgs'=>$result]);
<?php
include "../conn.php";
$rid = $_POST['rid'];
$sid = $current_user['uid'];
$msg = $_POST['msg'];
$msg = htmlentities($msg);

// sleep(5);
$msgsql = "INSERT INTO `message`(`mid`, `sid`, `rid`, `msg`) VALUES (NULL,'$sid','$rid','$msg')";
$msgsql = mysqli_query($conn,$msgsql);
if($msgsql){
    echo json_encode(["success" => 1, "msg"=>"message sent"]);
}else{
    echo json_encode(["success" => 0, "msg" => "message failed"]);
}   

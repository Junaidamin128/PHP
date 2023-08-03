<?php
include "../conn.php";

$comment = $_POST['comment'];
$pid = $_POST['pid'];

$query = "INSERT INTO `comment`(`cid`, `pid`, `uid`, `body`) VALUES (NULL,'$pid','$uid','$comment')";
$query = mysqli_query($conn,$query);
if($query){
    echo json_encode(["success" => 1, "msg"=>"","pid" => $pid]);
}else{
    echo json_encode(["success" => 0, "msg" => "comment failed"]);
}
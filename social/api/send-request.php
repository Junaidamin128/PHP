<?php
require_once "../conn.php";
if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $op = $_POST['op'];
    $cid = $current_user['uid'];
    
    $sql = "SELECT * FROM `user` WHERE `uid`='$uid'";
    $query = $conn->query($sql);
    $user = mysqli_fetch_assoc($query);
    
    $output = "";
    switch ($op) {
        case 'SEND-REQUEST':
            $sql = "INSERT INTO `friends` (`sender`, `reciever`, `accepted`) VALUES ('$cid', '$uid', FALSE)";
            $query = $conn->query($sql);
            if (!$query) {
                echo json_encode(["success" => false, "msg" => "Failed to execute query"]);
                exit;
            }

            $output = json_encode(["success" => true, "msg" => renderFriendStatutsButtons($user)]);
            break;
        case "ACCEPT-REQUEST":
            $sql = "UPDATE `friends` SET `accepted`= TRUE";
            $query = mysqli_query($conn, $sql);
            if($query){
                $output = json_encode(["success" => true, "msg" => renderFriendStatutsButtons($user)]);
            }
            break;
        case "CANCEL-REQUEST":
            $friendSql = "DELETE FROM `friends` WHERE (sender = $current_user[uid] AND reciever = $user[uid]) OR (sender = $user[uid] AND reciever = $current_user[uid])";
            $query = mysqli_query($conn, $friendSql);
            $output = json_encode(["success" => true, "msg" => renderFriendStatutsButtons($user)]);
            break;
    }


    echo $output;
}

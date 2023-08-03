<?php
include "../conn.php";

$pids = $_POST['pids'];


$query = $conn->query("SELECT * FROM `comment` WHERE pid IN (" . implode(", ", $pids) . ") ORDER BY cid DESC;");
$result = $query->fetch_all(MYSQLI_ASSOC);

$postComments = [];
foreach ($result as $comment) {
    if (!isset($postComments[$comment['pid']])) {
        $postComments[$comment['pid']] = "";
    }
    $postComments[$comment['pid']] .= render_comment($comment);
}

echo json_encode(["success"=>true, "post_comments"=>$postComments]); 
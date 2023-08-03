<?php
include "../conn.php";

if (!$current_user) {
    exit;
}

$body = $_POST['body'];

//transform array
$files = [];
for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
    if (!$_FILES['files']['error'][$i]) {
        $ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
        $name = pathinfo($_FILES['files']['name'][$i], PATHINFO_FILENAME);
        $files[] = [
            'name' => substr($name, 0, 10) . uniqid() . ".$ext",
            'tmp_name' => $_FILES['files']['tmp_name'][$i],
        ];
    }
}



$postSql = "INSERT INTO `posts` (`pid`, `body`, `author`, `created`) VALUES (NULL, '$body', '$current_user[uid]', current_timestamp())";
$query = $conn->query($postSql);
if ($query) {

    $pid = mysqli_insert_id($conn);

    if ($files) {
        $imgsSql = "INSERT INTO `postimages` (`pimgid`, `pid`, `imgname`) VALUES ";
        $subSql = [];
        foreach ($files as $file) {
            $name = $file['name'];
            $tmp_name = $file['tmp_name'];
            move_uploaded_file($tmp_name, "../images/" . $name);
            $subSql[] = "(NULL, '$pid', '$name')";
        }
        $imgsSql .= implode(", ", $subSql);

        $query = $conn->query($imgsSql);
    }

    echo json_encode(["success" => 1, "msg" => "Post created", "pid" => $pid]);
} else {
    echo json_encode(["success" => 0, "msg" => "Post creation failed"]);
}

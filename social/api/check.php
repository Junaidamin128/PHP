<?php
include "../conn.php";
$output = [];
switch($_POST['op'])
{
    case "EMAIL":
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM user WHERE email='$email'";
        $query = $conn->query($sql);
        $result = $query->fetch_assoc();
        if($result)
        {
            $output['exists'] = true;
        }else{
            $output['exists'] = false;
        }
        break;
}

echo json_encode($output);
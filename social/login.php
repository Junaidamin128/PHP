<?php
$error = "";

require_once "conn.php";
if(isset($uid)){
    header("location: index.php");
}
if (isset($_POST['login'])) {
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $password = hash('sha256', $password);

    $query = "SELECT * FROM `user` WHERE `username` = '$username' and `password` = '$password'";
    $query = mysqli_query($conn, $query);   
    if ($query) {
        $results = $query->fetch_all(MYSQLI_ASSOC);
        if (count($results) == 0) {
            $error = "User not found";
        } else {
            $result = $results[0];
            $uid = $result["uid"];  
            $_SESSION['uid'] = $uid;
            header("location: index.php");
        }
    } else {
        $error = "User not found";
    }
}

if (isset($_POST['signup'])) {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $username = mysqli_escape_string($conn, $_POST['username']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $conpass = mysqli_escape_string($conn, $_POST['conpass']);
    $number = mysqli_escape_string($conn, $_POST['number']);
    if ($password == $conpass) {
        $password = hash('sha256', $password);
        $query = "INSERT INTO `user`(`fullname`, `username`, `password`, `email`,`number`) VALUES ('$name','$username','$password','$email','$number')";
        $query = mysqli_query($conn, $query);
    }
    else{
        $error= "Password isn't matched";
    }
}

include "./Components/header.php";

require "./signup.php";

?>
<h1><?= $error ?></h1>
<?php


include "./Components/footer.php";
?>
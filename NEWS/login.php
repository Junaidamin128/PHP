<?php
require_once "conn.php";
$error = "";
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM `user` WHERE name = \"$username\" and password=\"$password\"";
    $query = mysqli_query($conn, $query);
    if ($query) {
        $results = $query->fetch_all(MYSQLI_ASSOC);
        if (count($results) == 0) {
            $error = "User not found";
        } else {
            $result = $results[0];
            $uid = $result["uid"];
            $_SESSION['uid'] = $uid;
        }
    }else{
        $error = "User not found";
    }
}

if (isset($_SESSION['uid'])) {
    // $uid = $_SESSION['uid'];
    header("location: index.php");
}
require "./Components/navbar.php"
?>
<div class=" container m-auto text-center">
    <form method="POST" class="d-flex flex-column p-5 w-50 m-auto login_form jumbotron">
        <label class="w-100 " for="username">Username:
            <input class="w-100 p-2 rounded" type="text" name="username" placeholder="Username">
        </label>
        <label class="w-100 " for="password">Password:
            <input class="w-100 p-2 rounded" type="password" name="password" placeholder="Password">
        </label>
        <input type="submit" name="submit" value="Log in" class="p-2 align-self-lg-stretch mt-4 w-100  bg-transparent rounded  ">
    </form>
    <h3><?= $error; ?></h3>

</div>
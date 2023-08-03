<?php

require_once "conn.php";
if (isset($_SESSION['uid'])) {
    // $uid = $_SESSION['uid'];
    header("location: index.php");
}
$msg = "";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO `user`(`uid`, `name`, `email`, `password`) VALUES ('','$name','$username','$password')";
    if(mysqli_query($conn, $query)){
        $msg = "Records inserted successfully.";
    } else{
        $msg = "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
   
}
require "./Components/navbar.php"
?>

<div class="container m-auto ">
<form class="d-flex flex-column p-5 w-50 text-center m-auto align-items-lg-center jumbotron" method="post">
        <label class="w-100" for="name">Name:
            <input class="p-2 w-100 " type="text" name="name" placeholder="Enter your name">
        </label>
        <label class="w-100" for="username">Username:
            <input class="p-2 w-100 " type="email" name="username" placeholder="Enter the email">
        </label>
        <label class="w-100" for="password">Password:
            <input class="p-2 w-100 " type="password" name="password" placeholder="Enter your password">  
        </label>
        <input class="p-2 align-self-lg-stretch mt-4 w-100 bg-transparent rounded " type="submit" value="Signup" name="submit">
    </form>
    <h3><?= $msg; ?></h3>
</div>
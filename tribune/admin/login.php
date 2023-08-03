<?php
require_once "../conn.php";
include "../Components/header.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $query = $stmt->execute([$username, $password]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $uid = $result['uid'];
    $_SESSION['uid'] = $uid;
    header("location:admin.php");
}
?>
<div class="container m-auto">
<form class="m-auto text-center w-50  bg-dark text-white p-5 rounded" action="" method="post">
    <label class="w-100" for="username">Username:
        <input class="w-100 border-info rounded-pill p-1"  type="text" name="username" id="username">
    </label>
    <label class="w-100" for="password">Password:
        <input  class="w-100 border-info rounded-pill p-1" type="password" name="password" id="password">
    </label>
    <input class="btn btn-outline-info w-25" type="submit" name="submit" value="Log In">
</form>
</div>
<?
include "../Components/footer.php";
?>
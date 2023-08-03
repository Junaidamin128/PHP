<?php
require_once "../conn.php";
include "../Components/header.php";

$error="";
// $authors = $conn->prepare("SELECT * FROM `author`");
// $authors->execute();
// $authorsresult = $authors->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['create-author'])) {
    $name = $_POST['name'];
    // foreach($authorsresult as $author){
    //     if($name == $author['name']){
    //         $error = "authour already exist";   
    //     }
    //     else{
            
    //     }
    // }
    $asql = $conn->prepare("INSERT INTO `author`( `name`) VALUES (:name)");
    $asql->bindParam(':name', $name);
    $asql->execute();
    header("location:" . BASE_URL . "/admin/admin-author.php");
}
?>
<form class="w-50 m-auto bg-light p-5 " method="post">
    <label class="w-100 p-2" for="title">Name:
        <input class="w-75 rounded-pill p-2" name="name" type="text" />
    </label>
    <input class="btn btn-success my-2 p-2 " name="create-author" type="submit" value='save' />
</form>
<h2><?= $error ?></h2>
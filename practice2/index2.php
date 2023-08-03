<!-- <?php

$page = "home";

if(isset($_GET['page']))
{
    $page = $_GET['page'];
}

if(!file_exists( "./pages/$page.php" ))
{
    $page = "404";
}


include "./include/header.php";
include "./include/aside.php";


?>

<?php
    include "./pages/$page.php";
?>

<?php
include "./include/footer.php"
?> -->
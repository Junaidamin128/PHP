<?php
session_start();
define("BASE_URL", "http://localhost/news");
$conn = mysqli_connect("localhost","root","","news");

if(mysqli_errno($conn)){
    echo "Connection failed: " . mysqli_error($conn);
    exit;
}

$uid = null;
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
}



function getCategories()
{
    global $conn;
    $query = "SELECT * FROM category ORDER BY name";
    $query =  mysqli_query($conn, $query);
    $result = $query->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function getUser($uid){
    global $conn;
    $query = mysqli_query($conn,"SELECT * FROM `user` WHERE uid = $uid ");
    $result = mysqli_fetch_assoc($query);
    return $result;
}

function  getPost($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM `article` WHERE `aid`=$id");
    $result = $query -> fetch_all(MYSQLI_ASSOC);
    $post = null;
    if(count($result)){
        $post = $result[0];
        $post['author_info'] = getUser($post['author']);
        $query = mysqli_query($conn, "SELECT * FROM category_article JOIN category ON category.cid=category_article.cid WHERE aid=$post[aid]");
        $result = $query->fetch_all(MYSQLI_ASSOC);
        $post['categories'] = $result;
        d($post);
    }
    return $post;
}
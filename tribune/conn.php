<?php
session_start();
define('BASE_URL', "http://localhost/tribune");
$user = "root";
$pass = "";
try{
$conn = new PDO('mysql:host=localhost;dbname=tribune', $user, $pass);
} catch(PDOException $e){
    print "ERROR!". $e->getMessage() . "<br/>";
}
$uid = null;
if(isset($_SESSION['uid'])){
$uid = $_SESSION['uid'];
$stmt = $conn->prepare("SELECT * FROM user WHERE uid = $uid");
$query = $stmt->execute();
$current_user = $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCategoryTree($pid)
{
    $categories = getCategoryByParent($pid);
    foreach($categories as $key=>$cat)
    {
        $cid = $cat['cid'];
        $categories[$key]['child'] = getCategoryTree($cid);
    }
    return $categories;
}



function getCategoryOptions($categories, $level=0)
{
    $cats = [];
    foreach($categories as $key=>$cat)
    {
        $cats[] = [
            'cid' => $cat['cid'],
            'name' => $cat['name'],
            'level' => $level,
        ];
        $sub_cat = getCategoryOptions($cat['child'], $level+1);
        $cats = array_merge($cats, $sub_cat);
    }
    return $cats;
}

function getCategoryByParent($pid)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM category WHERE parent=?");
    $query = $stmt->execute([$pid]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result; 
}

function getnews(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `news`");
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $news;
}

function getauthors($id){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `author` WHERE aid = ?");
    $stmt->execute([$id]);
    $author = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $author;
}

function getsportsnews($id){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `news` JOIN `newscategory` on news.nid = newscategory.nid where newscategory.cid = ?");
    $stmt->execute([$id]);
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $news;
}

class News{
    public static function getsportsnews($id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `news` JOIN `newscategory` on news.nid = newscategory.nid where newscategory.cid = ?");
        $stmt->execute([$id]);
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $news;
    }
}
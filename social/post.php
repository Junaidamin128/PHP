 <?php
    require_once "conn.php";
    if (!$current_user) {
        header("location:login.php");
    }
    $pid = $_GET['pid'];
    include "./Components/header.php";
    
   foreach(get_post($pid) as $post){
    render_post($post);
   }

    
    ?>

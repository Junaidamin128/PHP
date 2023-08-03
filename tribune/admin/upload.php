<?php
if(isset($_FILES['upload']))
{
    $name = $_FILES['upload']['name'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $name = pathinfo($name, PATHINFO_FILENAME);

    $name .= uniqid().".".$ext;
    
    move_uploaded_file($tmp_name, "../images/$name");

    $url = "http://localhost/tribune/images/$name";
    $message = "Image uploaded";
    echo '<script>window.parent.CKEDITOR.tools.callFunction('.$_GET['CKEditorFuncNum'].', "'.$url.'", "'.$message.'")</script>';
}
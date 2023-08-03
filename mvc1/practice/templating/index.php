<?php

//replace home.html with home.php


function render($template, $vars=[])
{

    $path = "./$template.html";

    $content = file_get_contents($path);

    $content = preg_replace("/\{%\s*(.+?)\s*%\}/", "<?php $1 ?>", $content);

    $content = preg_replace("/\{\s*(.+)\s*\}/", "<?= $1;?>", $content);

    file_put_contents("$template.php", $content);


    extract($vars);
    ob_start();
    include "home.php";

    $output = ob_get_clean();

    return $output;

}


echo render("home", ["title"=>"Hello world", "content"=>"Lorem ipsum"]);
<?php

function getCurrentPath()
{
    $script_name = $_SERVER['SCRIPT_NAME'];
    $script_dir = dirname($script_name);

    $uri = $_SERVER['REQUEST_URI'];
    $act_path = str_replace($script_dir, "", $uri);
    return $act_path;
}


function getCurrentRoute($act_path_split, $routes)
{
    $route = null;

    foreach ($routes as $rou_path => $fn) {
        $rou_path_split = explode("/", $rou_path);
        array_shift($rou_path_split);

        if (count($rou_path_split) != count($act_path_split)) {
            continue;
        }
        $allmatched = true;
        $params = [];
        foreach ($rou_path_split as $i => $value) {
            $path_part = $act_path_split[$i];

            if (@$value[0] == "{" && @$value[strlen($value) - 1 == "}"]) {
                $params[$value] = $path_part;
            } else if ($path_part != $value) {
                $allmatched = false;
                break;
            }
        }
        if ($allmatched) {
            $route = ['params' => $params, 'fn' => $fn];
            break;
        }
    }

    return $route;
}


function render($template, $vars = [])
{

    //template path
    $path = "./templates/$template.html";
    if (!file_exists($path)) {
        throw new Error("Template $path not found.");
    }

    $content = file_get_contents($path);

    //replace php 
    $content = preg_replace("/\{%\s*(.+?)\s*%\}/", "<?php $1 ?>", $content);

    //replace echo 
    $content = preg_replace("/\{\s*(.+?)\s*\}/", "<?= $1;?>", $content);

    file_put_contents("./templates/php/$template.php", $content);

    //create variables from array
    extract($vars);
    ob_start();
    include "./templates/php/$template.php";
    $output = ob_get_clean();
    return $output;
}

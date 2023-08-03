<?php
$script_name = $_SERVER["PHP_SELF"];
$script_dir = dirname($script_name);
$requesturi = $_SERVER['REQUEST_URI'];
$path =  str_replace($script_dir, "", $requesturi);

$path_split  = explode("/", $path);
array_shift($path_split);



$routes = [];
require "route.php";
$route = null;
foreach ($routes as $p => $fn) {
    $psplit = explode("/", $p);
    array_shift($psplit);


    if (count($path_split) != count($psplit)) {
        continue;
    }

    $all_matched = true;
    $params = [];
    foreach ($psplit as $i => $part) {
        $path_part = $path_split[$i];

        //match {var}
        if ($part[0] == "{" && $part[strlen($part) - 1] == "}") {
            $params[$part] = $path_part;
        }else if ($path_part != $part) {
            $all_matched = false;
            break;
        }
    }

    if ($all_matched) {
        $route = ['params' => $params, 'fn' => $fn];
        break;
    }
}


if (!$route) {
    echo "404";
    exit;
}


echo call_user_func_array($route['fn'], $route['params']);

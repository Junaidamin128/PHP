<?php
require "fns.php";
$act_path = getCurrentPath();
$act_path_split = explode("/", $act_path);
array_shift($act_path_split);

$routes = [];
require "routes.php";

$route = getCurrentRoute($act_path_split, $routes);

if (!$route) {
    echo "404";
    exit;
}
echo call_user_func_array($route['fn'], $route['params']);

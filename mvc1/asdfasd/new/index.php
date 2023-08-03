<?php
$scriptname = $_SERVER['SCRIPT_NAME'];
$scriptdir = dirname($scriptname);
$uri = $_SERVER['REQUEST_URI'];
$path = str_replace($scriptdir, "", $uri);

$routes = [];
$routes["/"] = function () {
    return "Hello";
};
$routes["/about"] = function () {
    return "about";
};
$routes["/item/1"] = function () {
    return "item 1";
};
$routes["/about/{var}"] = function ($var = 0) {
    return "about " . $var;
};
$routes["/user/{uid}/comment/{cid}"] = function($uid, $cid){
    return "comment " . $uid . " " . $cid;
};

$pathsplit  = explode("/", $path);
array_shift($pathsplit);

$route = null;

foreach ($routes as $p => $fn) {
    $psplit = explode("/", $p);
    array_shift($psplit);
    if (count($pathsplit) != count($psplit)) {
        continue;
    };
    $allmatch = true;
    $params = [];
    foreach ($psplit as $i => $part) {
        $pathpart = $pathsplit[$i];
        if (@$part[0] == "{" && @$part[strlen($part) - 1] == "}") {
            $params[$part] = $pathpart;
        } else if ($pathpart != $part) {
            $allmatch = false;
            break;
        };
    }

    if ($allmatch) {
        $route = ['params'=>$params,'fn'=>$fn];
        break;
    }
}

if (!$route) {
    echo "404";
    exit;
};
echo call_user_func_array($route['fn'], $route['params']);

<?php
//set constants
define("ROUTES_DIR", "./routes");
define("TEMPLATES_DIR", "./templates");

//require files
require_once "fns.php";

//init global variables


////find path
//current path
$path = init_path();

//make parts of it
$path_split = explode("/", $path);
//remove first empty part
array_shift($path_split);

//init database


//init routing
$routes = [];
//scan routes folder for php files
$files = scandir(ROUTES_DIR);
//remove current and previous directory from list
$files = array_diff($files, array('.', '..'));
//loop over all files and include them
foreach ($files as $file) {
    include_once ROUTES_DIR . "/" . $file;
}

//find the current route
$route = null;
//loop over all routes
foreach ($routes as $_route => $info) {
    $route_split = $info['split'];
    //skip if not same length
    if (count($route_split) !== count($path_split)) {
        continue;
    }
    d($route_split);

    //variable to save parameters
    $params = [];
    //flag to check if all path parts matched
    $all_matched = true;
    for ($i = 0; $i < count($route_split); $i++) {
        $r = $route_split[$i];
        $p = $path_split[$i];
        //dynmaic match 
        if (@$r[0] == "%") {
            $params[$r] = $p;
        } else if ($p !== $r) { //check if part doesn't match
            $all_matched = false;
            break;
        }
    }
    //if it is matched set route
    if ($all_matched) {
        $route = ["path" => $path, "route" => $_route, "fn" => $info['fn'], 'info' => $info, "params" => $params];
    }
}
//handle 404
if (!$route) {
    echo "404 handle";
    exit;
}

//get the function to execute for current route
$fn = $route['fn'];
//params to pass to that function
$params = $route['params'];

//call the function and output
$output = call_user_func_array($fn, $params);
echo $output;
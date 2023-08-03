<?php
function init_path()
{
    //get current file path
    /**
     * PHP_SELF reference to current file that executed which is index.php 
     */
    d($_SERVER);
    $self = $_SERVER['PHP_SELF'];
    //get current file directory
    $self_dir = dirname($self);
    //get the requested URI which is called from browser
    $request_uri = $_SERVER['REQUEST_URI'];
    $path = str_replace($self_dir, "", $request_uri);
    $path = "/" . trim($path, "/");
    return $path;
}

function route($path, $fn)
{
    if (is_array($path)) {
        foreach ($path as $p) {
            _route($p, $fn);
        }
    } else {
        _route($path, $fn);
    }
}
function _route($path, $fn)
{
    global $routes;
    if ($path[0] !== "/") {
        throw new Error("Route must start with / but path is \"" . $path . "\"");
    }
    $route_split = explode("/", $path);
    array_shift($route_split);
    $routes[$path] = [
        'fn' =>  $fn,
        'split' => $route_split
    ];
}


function render($tpl, $vars = [])
{
    $file = TEMPLATES_DIR . "/" . $tpl . '.twig';
    $target = TEMPLATES_DIR . "/_php/$tpl.php";
    if (!file_exists(TEMPLATES_DIR . "/_php")) {
        mkdir(TEMPLATES_DIR . "/_php");
    }
    if (!file_exists($file)) {
        throw new Error("Template $tpl not found . tried $file .");
    }
    $contents = file_get_contents($file);

    //replace single else
    $contents = preg_replace("/\{%\s*else\s*\%}/", "<?php else:?>", $contents);


    //first replace endstatments
    $contents = preg_replace("/\{%\s*end(.+?)\s*\%}/", "<?php end$1;?>", $contents);
    //replace if/for/foreach
    $contents = preg_replace("/\{\%(.+?) (.+)\%\}/", "<?php $1($2):?>", $contents);

    //find echo parts
    $contents = preg_replace("/\{(.+?)\}/", "<?= $1;?>", $contents);

    file_put_contents($target, $contents);
    extract($vars);
    //Store result in output buffer
    ob_start();
    include $target;
    //clean output buffer and return value
    return ob_get_clean();
}

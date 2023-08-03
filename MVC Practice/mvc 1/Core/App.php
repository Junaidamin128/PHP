<?php

class App
{
    public function __construct()
    {
        require_once BASE_PATH . "/Core/Route.php";
        require_once BASE_PATH . "/Core/ControllerBase.php";
        require_once BASE_PATH . "/routing.php";
    }

    public function findRoute($url)
    {
        //check the request is post,get,delete or update
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                $collection = Route::$gets;
                break;
            case "POST":
                $collection = Route::$posts;
                break;
            case "DELETE":
                $collection = Route::$deletes;
                break;
            case "PATCH":
                $collection = Route::$patchs;
                break;
            default:
                $collection = [];
        }

        $urlParts = explode("/", $url);
        array_shift($urlParts);
        $route = null;
        //loop over all routes in site
        foreach ($collection as $path => $fn) {
            $pathParts = explode("/", $path);
            array_shift($pathParts);
            //if the url and route path is not of same length
            if (count($pathParts) !== count($urlParts)) {
                continue;
            }
            $matched = true;
            $args = [];
            for ($i = 0; $i < count($urlParts); $i++) {
                $u = $urlParts[$i];
                $p = $pathParts[$i];
                $plength = strlen($p);
                if (isset($p[0], $p[$plength - 1]) && $p[0] == "{" && $p[$plength - 1] == "}") {
                    //remove { } from key
                    $argKey = substr($p, 1, $plength - 2);
                    $args[$argKey] = $u;
                } else if ($u != $p) {
                    $matched = false;
                    break;
                }
            }
            if ($matched) {
                $route = [
                    'route' => $fn,
                    'args' => $args
                ];
                break;
            }
        }
        return $route;
    }

    public function handleRequest($url)
    {
        //Add forward slash to start
        $url = "/" . ltrim($url, "/");

        $route = $this->findRoute($url);
        //if route is null set 404 handler
        if (!$route) {
            if (Route::$handle404) {
                $route = [
                    'route' => Route::$handle404,
                    'args' => ['url' => $url],
                ];
            } else {
                echo "404";
                exit;
            }
        }
        //if is array handle class::method
        if (is_array($route['route'])) {
            $className = $route['route'][0];
            $method = $route['route'][1];
            require_once "./Controllers/" . $className . ".php";
            if (!method_exists($className, $method)) {
                throw new Error("Method doesn't exists $className::$method");
            }
            $class = new $className();
            $output = call_user_func_array([$class, $method,], $route['args']);
        } else {
            $output = call_user_func_array($route['route'], $route['args']);
        }

        if (is_string($output)) {
            echo $output;
        }
    }
}

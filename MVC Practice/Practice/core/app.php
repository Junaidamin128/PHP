<?php
class App
{
    public function __construct()
    {
        require_once BASE_PATH . "/core/route.php";
        require_once BASE_PATH . "/core/basecontroller.php";
        require_once BASE_PATH . "/routing.php";
    }
    public function findRoute($url)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                $collection = Route::$gets;
                break;
            default:
                $collection = [];
        }
        $urlparts = explode("/", $url);
        array_shift($urlparts);
        $route = null;
        foreach ($collection as $path => $fn) {
            $pathparts = explode("/", $path);
            array_shift($pathparts);
            if (count($pathparts) !== count($urlparts)) {
                continue;
            }
            $matched = true;
            $args = [];
            for ($i = 0; $i < count($urlparts); $i++) {
                $u = $urlparts[$i];
                $p = $pathparts[$i];
                $plength = strlen($p);
                if (isset($p[0], $p[$plength - 1]) && $p[0] == "{" && $p[$plength - 1] == "}") {
                    $argkey = substr($p, 1, $plength - 2);
                    $args[$argkey] = $u;
                } else if ($u != $p) {
                    $matched = false;
                    break;
                }
            }
            if($matched){
                $route = [
                    'route'=>$fn,
                    'args'=> $args
                ];
                break;
            }
        }
        return $route;
    }
    public function handleRequest($url)
    {
        $url = "/" . ltrim($url, "/");

        $route = $this->findRoute($url);
        if(!$route){
            if(Route::$handle404){
                $route = [
                    'route'=>Route::$handle404,
                    'args'=>['url'=>$url]
                ];
            }else{
                echo "404";
                exit;
            }
        }

        if(is_array($route['route']))
        {
            $class = $route['route'][0];
            $method = $route['route'][1];
            require BASE_PATH."/controllers/$class.php";
            if(!method_exists($class, $method))
            {
                throw new Error("Method $method doesn't exists in class $class");
            }
            $obj = new $class;
           $output =  call_user_func_array([$obj, $method], $route['args']);
        }else{
           $output =  call_user_func_array($route['route'], $route['args']);
        }

        echo $output;
    }
}

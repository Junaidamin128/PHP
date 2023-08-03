<?php

class Route{
    public static $routes = [];
    public static function create($path, $fn)
    {
        SELF::$routes[$path] = $fn;
    }
}
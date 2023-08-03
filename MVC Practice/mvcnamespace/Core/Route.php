<?php
namespace Core;


class Route
{
    public static $gets = [];
    public static $posts = [];
    public static $deletes = [];
    public static $patchs = [];
    public static $handle404 = null;
    public static function handle404($fn)
    {
        SELF::$handle404 = $fn;
    }

    public static function get($path, $fn)
    {
        if ($path[0] !== "/") {
            throw new \Error("Route must start with / ");
        }
        SELF::$gets[$path] = $fn;
    }

    public static function post($path, $fn)
    {
        if ($path[0] !== "/") {
            throw new \Error("Route must start with / ");
        }
        SELF::$posts[$path] = $fn;
    }

    public static function delete($path, $fn)
    {
        if ($path[0] !== "/") {
            throw new \Error("Route must start with / ");
        }
        SELF::$deletes[$path] = $fn;
    }

    public static function patch($path, $fn)
    {
        if ($path[0] !== "/") {
            throw new \Error("Route must start with / ");
        }
        SELF::$patchs[$path] = $fn;
    }
}

<?php

class Route
{
    public static $gets = [];

    public static function get($path, $fn)
    {
        if ($path[0] !== "/") {
            throw new Error("Route must start with / ");
        }
        SELF::$gets[$path] = $fn;
    }

}

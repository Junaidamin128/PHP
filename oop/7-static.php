<?php

// class Maths{
//     public function add($a, $b)
//     {
//         return $a+$b;
//     }
// }

// $ob = new Maths;
// d($ob->add(1, 4));

class Maths
{
    // public static $PI = 3.1415;
    const PI = 3.1415;
    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function calculateDiameter($r)
    {
        return 2* self::PI * $r;
    }
}

d( Maths::add(1, 5) );
d( Maths::PI );
d( Maths::calculateDiameter(5));

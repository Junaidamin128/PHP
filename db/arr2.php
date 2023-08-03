<?php
echo "<pre>";


// $color = array(12 => 'white', 6 => 'green', 11=> 'red');
// print_r($color);
// echo reset($color)."\n";

// s(array_keys($color));
// s(array_values($color));


$a = [1,2,3,4,5];
$b = [1,4,6,7,8];

// s(array_merge($a, $b));
// s(array_combine($a, $b));
// s(array_intersect($a, $b));
// s(array_diff($a, $b));
// s(array_diff($b, $a));


// $a1=array("a"=>"red","b"=>"green");
// $a2=array("a"=>"blue","yellow");
// s(array_replace($a1,$a2));


// $x = 10;
// $y = 20;
// $name = "Moin";


// s( compact("x", "y", "name") );


// $arr = ["test" => 10, "test2" => 100];

// extract($arr);

// s($test);
// s($test2);

date_default_timezone_set('Asia/Karachi');

s(date("Y-m-d H:i:s"));

$timestamp = strtotime("+1day");
s($timestamp);
s(date("Y-m-d H:i:s", $timestamp));

s(localtime());

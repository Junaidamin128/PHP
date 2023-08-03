<?php


// file_put_contents("./test.txt", "1,2,3,4");

$contents = file_get_contents("./test.json");

$json = json_decode($contents, true);
s($json);
s($contents);
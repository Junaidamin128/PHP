<?php

$routes["/"] = function () {
    return "Hello";
};

$routes["/about"] = function () {
    return "about";
};

$routes["/item/1"] = function () {
    return "item 1";
};

$routes["/about/{var}"] = function ($var=0) {
    return "about " . $var;
};

$routes["/user/{uid}/comment/{cid}"] = function($uid, $cid){
    return "comment " . $uid . " " . $cid;
};


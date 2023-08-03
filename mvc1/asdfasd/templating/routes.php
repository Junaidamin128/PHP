<?php

$routes["/"] = function () {
    
    
    // $card = render("card", ['name'=> "Moin", 'bio'=>"Lorem"]);

    $output = render("home", ['title'=>"Home page", 'content'=>"Hello world <br/>"]);


    return $output;
};
$routes["/about"] = function () {
    $content = render("about");
    return render("home", ['title'=> "About page", 'content'=> $about]);
};
$routes["/test"] = function () {
    $content = render("test", ['data'=>[1,2,4,5,6,7]]);
    return render("home", ['title'=> "test", 'content'=> $content]);
};
$routes["/contact/1"] = function () {
    return "contact";
};
$routes["/user/{var}"] = function ($var) {
    return "user ".$var;
};
<?php

use Core\Route;
use Controller\Form;

//set 404 handler
Route::handle404([\Controller\PageNotFound::class, "index"]);
//get Requests
Route::get("/", function () {
    return "Home";
});
Route::get("/about", [\Controller\About::class, "index"]);
Route::get("/about/{name}", [\Controller\About::class, "index"]);
Route::get("/form", [Form::class, 'index']);

//post
Route::post("/form", [Form::class, 'data']);

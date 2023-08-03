<?php
//set 404 handler
Route::handle404([PageNotFound::class, "index"]);
//get Requests
Route::get("/", function(){
    return "Home";
});
Route::get("/about", [About::class, "index"]);
Route::get("/about/{name}", [About::class, "index"]);
//post
// Route::post("/form", [Form::class, 'data']);
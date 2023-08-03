<?php


route(
    ["/", "/home"],
    function () {
        $content = render("home", [
            'title' => "Hello world",
            'data' => [1,2,3,4]
        ]);

        return render("page", [
            'title' => "Home",
            'content' => $content,
        ]);
    }
);

route("/test/1", function(){
    return "test";
});

route("/about", function(){
    return "About";
});

route("/about/%var1", function($var1){
    return "About ".$var1;
});

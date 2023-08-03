<?php
namespace app\core;

class Controller{
    public function render($view,$params=[]){
        return \app\core\App::$app->router->renderView($view,$params);

    }
}
<?php

abstract class Controller{
    public $path;
    abstract public function index();
    public function sayHello(){
        d("Helolo world");
    }

}

class HomeController extends Controller{
    public function index(){
        return "Hello";
    }
}

$ob = new HomeController();
d($ob);
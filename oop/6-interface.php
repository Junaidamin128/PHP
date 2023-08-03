<?php

interface Controller{
    public $path;
    public function index();
   
}

class Home implements Controller{
    public function index(){

    }
}


$ob = new Home();
d($ob);
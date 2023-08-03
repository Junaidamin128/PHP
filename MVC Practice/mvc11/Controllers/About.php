<?php


class About extends ControllerBase{
    public function index($name=null){
        echo "About";
        // return $this->view("about", ['name'=>$name]);
    }
}
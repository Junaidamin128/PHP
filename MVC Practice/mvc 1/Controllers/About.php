<?php


class about extends ControllerBase{
    public function index($name=null){
        return $this->view("about", ['name'=>$name]);
    }
}
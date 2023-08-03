<?php
namespace Controller;

class about extends \Core\ControllerBase{
    public function index($name=null){
        return $this->view("about", ['name'=>$name]);
    }
}
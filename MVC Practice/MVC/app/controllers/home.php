<?php
class home extends controller{

    public function index($name = ''){
       $user = $this->modal('user');
       $user->name= $name;
       $this->view('home/index',$data = []);
    } 
}
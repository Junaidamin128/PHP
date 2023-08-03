<?php
class controller{
    public function modal($modal){
       require_once '../app/modals/'.$modal.'.php';
       return new $modal();
    }
    public function view($view,$data){
        require_once "../app/views/". $view.".php";
    }
}

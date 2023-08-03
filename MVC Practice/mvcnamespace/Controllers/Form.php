<?php
namespace Controller;

class Form extends \Core\ControllerBase{
    public function index()
    {
        return $this->view("form");
    }
    public function data()
    {
        d($_POST);
    }
}
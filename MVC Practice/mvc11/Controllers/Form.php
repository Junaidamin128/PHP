<?php

class Form extends ControllerBase{
    public function index()
    {
        return $this->view("form");
    }
    public function data()
    {
        d($_POST);
    }
}
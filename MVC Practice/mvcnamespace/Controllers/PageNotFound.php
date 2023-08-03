<?php
namespace Controller;

class PageNotFound extends \Core\ControllerBase{
    public function index($url)
    {
        return $this->view('404', ["url"=>$url]);
    }
}
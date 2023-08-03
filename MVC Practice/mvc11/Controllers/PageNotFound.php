<?php

class PageNotFound extends ControllerBase{
    public function index($url)
    {
        return $this->view('404', ["url"=>$url]);
    }
}
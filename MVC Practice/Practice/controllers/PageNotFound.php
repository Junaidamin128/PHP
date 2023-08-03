<?php
class PageNotFound extends Controller{
    public function index($url){
        return $this->view('404',['url'=>$url]);
    }
}
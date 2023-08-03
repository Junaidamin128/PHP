<?php

namespace app\controllers;

use app\core\Request;
use Controller;

class AuthController extends \app\core\Controller
{
    public function login(){
        return $this->render('login');
    }
    public function register(Request $request){
        if($request->isPost()){
            return 'handle submitted data';
        }
        return $this->render('register');
    }
}

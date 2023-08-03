<?php

namespace app\controllers;

use app\core\Request;
use Controller;

class SiteController extends \app\core\Controller
{
    public function home()
    {
        $params = [
            'name' => 'Junaid'
        ];
        return $this->render('home', $params);
    }
    public function contact()
    {
        return $this->render('contact');
    }
    public function handleConntact(Request $request)
    {
        $body = $request->getBody();
        return "handling submited data";
    }
}

<?php
namespace app\core;



class App{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static App $app;

    public function __construct($rootPath)
    {
        SELF::$ROOT_DIR = $rootPath;
        SELF::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);

    }
    public function run(){
        echo $this->router->resolve();
    }
}
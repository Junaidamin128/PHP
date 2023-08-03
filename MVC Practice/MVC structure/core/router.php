<?php
namespace app\core;


    class Router
    {
        public Request $request;
        public Response $response;
        protected array $routes = [];


        public function __construct(Request $request, Response $response){
            $this->request = $request;
            $this->respone = $response;
        }

        public function get($path, $callback)
        {
            $this->routes['get'][$path] = $callback;
        }


        public function post($path, $callback)
        {
            $this->routes['post'][$path] = $callback;
        }


        public function resolve(){

            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path]?? false;
            if($callback === false){
                App::$app->response->setStatusCode(404);
                return $this->renderView("_404page");
            }
            if(is_string($callback)){
                return $this->renderView($callback);
            }
            if(is_array($callback)){
                $callback[0] = new $callback[0]();
            }
            
            return call_user_func($callback,$this->request);

        }
        public function renderView($view, $params=[]){
            $viewContent = $this->renderOnlyView($view,$params);
            $layoutContent= $this->layoutContent();
            return str_replace('{{content}}', $viewContent,$layoutContent);
        }
        protected function layoutContent(){
            ob_start();
            require_once App::$ROOT_DIR."/Views/layout/main.php";
            return ob_get_clean();
        }
        protected function renderOnlyView($view,$params){
            foreach($params as $key=>$param){
                $$key = $param;
            }
            ob_start();
            require_once App::$ROOT_DIR."/Views/$view.php";
            return ob_get_clean();
        }
        public function renderContent($viewContent){
            $layoutContent= $this->layoutContent();
            return str_replace('{{content}}', $viewContent,$layoutContent);
        }
    }

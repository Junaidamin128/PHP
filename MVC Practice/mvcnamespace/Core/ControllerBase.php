<?php
namespace Core;


class ControllerBase{
    public function view($view, $vars=[])
    {
        $file = BASE_PATH."/Views/".$view.".php";
        if(!file_exists($file))
        {
            throw new Error("View $view not found ");
        }
        extract($vars);
        ob_start();
        include $file;
        return ob_get_clean();
    }
}
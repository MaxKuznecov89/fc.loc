<?php


namespace vendor\core\base;


class View
{
    public $route =[];
    public $view;
    public $layout;

    public function __construct($route,$layout='',$view='')
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
    }

    public function render(){


        $pathView = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        $pathLayout = APP ."/views/layout/{$this->layout}.php";

        ob_start();

        if(file_exists($pathView)){
            include "$pathView";
        }else{
            echo "<p>View <b>$pathView</b> not found</p>";
        }

        $view = ob_get_clean();

        if(file_exists($pathLayout)){
            include "$pathLayout";
        }else{
            echo "<p>Layout <b>$pathLayout</b> not found</p>";
        }


    }

}
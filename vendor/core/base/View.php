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

        if(file_exists($pathView)){

            include "$pathView";
        }else{
            echo "<p>controller <b>$pathView</b> not found</p>";
        }

    }

}
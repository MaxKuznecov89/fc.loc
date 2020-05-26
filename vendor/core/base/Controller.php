<?php


namespace vendor\core\base;


abstract class Controller
{
    public $route =[];

    public function __construct($route)
    {
        $this->route = $route;
        include APP . "/views/{$route['controller']}/{$route['action']}.php" ;
    }
}


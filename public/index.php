<?php
error_reporting(-1);
use vendor\core\Router;
require_once "../vendor/libs/functions.php";
require_once "../config/init.php";
spl_autoload_register(function ($className){

    $file = ROOT . "/$className.php";
    $file = str_replace('\\','/',$file);
    if(file_exists($file)){require_once "$file";}

});


Router::add('#^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$#', ["controller" => "Page"]);
Router::add('#^page/(?P<alias>[a-z-]+)$#', ["controller" => "Page","action"=>"view"]);


Router::add('#^$#', ["controller" => "Main", "action"=>"index"]);
Router::add('#^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i');

$param = rtrim($_SERVER["QUERY_STRING"],"/");



Router::dispatch($param);
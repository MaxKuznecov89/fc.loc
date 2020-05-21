<?php

//require_once "../vendor/core/Router.php";
require_once "../vendor/libs/functions.php";
//require_once "../app/controllers/Posts.php";
//require_once "../app/controllers/Main.php";
//require_once "../app/controllers/PostNew.php";
require_once "../config/init.php";
spl_autoload_register(function ($className){

    $file = ROOT . "/$className.php";
    $file = str_replace('\\','/',$file);


//    if(file_exists($file)){
//
//        require_once "$file";
//    }
    var_dump($file);

});

use vendor\core\Router;

Router::add('#^$#', ["controller" => "Main", "action"=>"index"]);

Router::add('#^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i');
$param = rtrim($_SERVER["QUERY_STRING"],"/");



Router::dispatch($param);
<?php

require_once "../vendor/core/Router.php";
require_once "../vendor/libs/functions.php";



Router::add('#^$#', ["controller" => "Main", "action"=>"index"]);

Router::add('#^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i');
$param = rtrim($_SERVER["QUERY_STRING"],"/");
Router::dispatch($param);

//debug(Router::getRoute());
//debug(Router::getRoutes());
//echo
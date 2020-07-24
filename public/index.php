<?php


error_reporting(-1);
use fs\core\Router;
use fs\core\App;

require_once "../vendor/autoload.php";

require_once "../vendor/fs/libs/functions.php";
require_once "../config/init.php";

$config = require CONF . "/config.php";

//$config1 = require_once CONF . "/config.php";
//$config1 = require_once ROOT . "/vendor/fs/core/base/test.php";



new App($config);

//
//
//
//Router::add('#^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$#', ["controller" => "Page"]);
//Router::add('#^page/(?P<alias>[a-z-]+)$#', ["controller" => "Page","action"=>"view"]);


Router::add('#^admin$#', ["controller" => "Main", "action"=>"index","prefix"=>"admin"]);
Router::add('#^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i', ["prefix"=>"admin"]);
Router::add('#^$#', ["controller" => "Main", "action"=>"index"]);
Router::add('#^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i');

$param = rtrim($_SERVER["QUERY_STRING"],"/");



Router::dispatch($param);
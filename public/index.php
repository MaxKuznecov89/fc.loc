<?php


error_reporting(-1);
use fs\core\Router;
use fs\core\App;

require_once "../vendor/autoload.php";

require_once "../vendor/fs/libs/functions.php";
require_once "../config/init.php";

$config = require CONF . "/config.php";



new App($config);


Router::add('#^admin$#', ["controller" => "Main", "action"=>"index","prefix"=>"admin"]);
Router::add('#^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i', ["prefix"=>"admin"]);
Router::add('#^$#', ["controller" => "Main", "action"=>"index"]);
Router::add('#^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$#i');

$param = rtrim($_SERVER["QUERY_STRING"],"/");



Router::dispatch($param);
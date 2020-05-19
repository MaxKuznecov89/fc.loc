<?php

require_once "../vendor/core/Router.php";
require_once "../vendor/libs/functions.php";


Router::add("bla", ["controller" => "Posts", "action"=>"add"]);
Router::add("bla/doc", ["controller" => "Doc", "action"=>"remove"]);
$param = rtrim($_SERVER["QUERY_STRING"],"/");
Router::matchRoute($param);

debug(Router::getRoute());
//echo
<?php

namespace vendor\core;

class Router
{
    protected static $routes=[];
    protected static $route=[];

    public static function add($regexp, $route=[]){
        self::$routes[$regexp] = $route;
}

    public static function getRoutes(){
        return self::$routes;
    }

    public static function getRoute(){
        return self::$route;
    }

    public static function matchRoute($url){

        $url = self::urlFreeGetParam($url);


        foreach (self::$routes as $pattern=>$route){
            if(preg_match($pattern, $url,$matches)){
               foreach ($matches as $key => $value){
                   if(is_string($key)){
                            $route[$key] = $value;
                   }
               }

                if(!isset($route["action"])){
                    $route["action"] = "index";
                }

                $route["controller"] = self::upperCamelCase($route["controller"]);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url){
        if(self::matchRoute($url)){
            $controller = "app\controllers\\" . self::$route['controller'];

            if(class_exists($controller)){
                $inst = new $controller(self::$route);
                $action = self::lowerFirstUpperNext(self::$route['action']) . "Action";

                if(method_exists($inst, $action)){
                    $inst->$action();
                    $inst->getView();
//
                } else{
                    echo "Method $action is not exists!";
                }

            }
            else{
                echo "class not exists";
            }
        }else{
            http_response_code(404);
            include "404.html";
        }
    }

    protected static function upperCamelCase($controller){

        $controllerArr =  explode("-", $controller);
        $controller = "";
        foreach ($controllerArr as $value){
            $controller .= ucfirst( $value);
        }
        return $controller;
    }

    protected static function lowerFirstUpperNext($action){
      return lcfirst(self::upperCamelCase($action));
    }

    protected static function urlFreeGetParam($url){
        if(false != $url){
            
            $arr = explode("&", $url,2);

            if(stripos ($arr[0],"=") !== false){
                return "";
            }
            return rtrim($arr[0], "/");
        }

        return $url;
    }
}
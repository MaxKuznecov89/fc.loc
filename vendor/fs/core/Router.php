<?php

namespace fs\core;

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
                if(!isset($route["prefix"])){
                    $route["prefix"] = "";
                }else{
                    $route["prefix"] = "\\" . $route["prefix"];
                }

                $route["controller"] = self::upperCamelCase($route["controller"]);
                self::$route = $route;

                              return true;
            }
        }
        return false;
    }

    public static function dispatch($url){

        $url = self::urlFreeGetParam($url);
        if(self::matchRoute($url)){
            $controller = "app\controllers" . self::$route['prefix']. "\\" . self::$route['controller'] . "Controller";
//            echo $controller;



            if(class_exists($controller)){
                $inst = new $controller(self::$route);
                $action = self::lowerFirstUpperNext(self::$route['action']) . "Action";

                if(method_exists($inst, $action)){
                    $inst->$action();
                    $inst->getView();
//
                } else{
                    throw new \Exception("Method $action is not exists!",404);
                }

            }
            else{
                throw new \Exception("Class not exists",404);
            }
        }else{
            $controller = "app\controllers" . self::$route['prefix']. "\\" . self::$route['controller'] . "Controller";
            var_dump( self::$route['controller']);
            throw new \Exception("Controller not exists",404);
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


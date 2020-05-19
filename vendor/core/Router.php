<?php


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
                if($url ===""){
                    self::$route = $route;
                    return true;
                }
                $result = ["controller" => $matches["controller"],"action" => $matches["action" ]];
                self::$route = $result;
                return true;
            }
        }
        return false;
    }
    public static function dispatch($url){
        if(self::matchRoute($url)){
            echo "OK";
        }else{
            http_response_code(404);
            include "404.html";
        }
    }

}
<?php


namespace vendor\core;


class Registry
{

    protected $objects = [];
    private static $instance;
    public function __construct($config)
    {
        foreach ($config["cached"] as $name=>$namespace){

            $fullName = $namespace . '\\' . $name;
            $this->objects[$name] = new $fullName;
        }

    }

    public static function getInstance($config)
    {
        if(!self::$instance){
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function __get($name)
    {
        if(is_object($this->objects[$name])){
            return $this->objects[$name];
        }
    }
    public function __set($name, $value)
    {
        if(!isset($this->objects[$name])){

            $this->objects[$name] = $value;
        }
    }

}
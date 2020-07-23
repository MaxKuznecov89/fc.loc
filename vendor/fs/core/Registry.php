<?php


namespace fs\core;


class Registry
{
use TSingleton;
    protected $objects = [];

    public function __construct($config)
    {
        foreach ($config["cached"] as $name=>$namespace){

            $fullName = $namespace . '\\' . $name;
            $this->objects[$name] = new $fullName;
        }

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
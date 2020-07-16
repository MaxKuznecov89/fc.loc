<?php

namespace vendor\core;

trait TSingleton{
    private static $instance;
    public static function getInstance($config)
    {
        if(!self::$instance){
            self::$instance = new self($config);
        }
        return self::$instance;
    }
}
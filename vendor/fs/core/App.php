<?php


namespace fs\core;


use Valitron\Validator;

class App
{
    public static $app;
    public function __construct($config)
    {
        session_start();
        self::$app = Registry::getInstance($config);
        Validator::lang("ru");
    }
}
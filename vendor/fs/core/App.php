<?php


namespace fs\core;


class App
{
    public static $app;
    public function __construct($config)
    {
        self::$app = Registry::getInstance($config);
        new ErrorHandler();
    }
}
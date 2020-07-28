<?php


namespace fs\core;


class App
{
    public static $app;
    public function __construct($config)
    {
        session_start();
        self::$app = Registry::getInstance($config);
    }
}
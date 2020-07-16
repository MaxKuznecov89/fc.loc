<?php


namespace vendor\core;


class ErrorHandler
{

public function __construct()
{
    ob_start();
    if(DEBUG){
        error_reporting(-1);
    }else{
        error_reporting(0);
    }
    set_error_handler([$this,$errorHandler]);
    set_exception_handler([$this,$exceptionHandler]);
    register_shutdown_function([$this,$criticalErrorHandler]);
}

public function errorHandler(){}
public function exceptionHandler(){}
public function criticalErrorHandler(){}



}
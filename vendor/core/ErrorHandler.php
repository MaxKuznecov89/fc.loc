<?php


namespace vendor\core;


class ErrorHandler
{

public function __construct()
{

    if(DEBUG){
        error_reporting(-1);
    }else{
        error_reporting(0);
    }
    set_error_handler([$this,"errorHandler"]);
    set_exception_handler([$this,"exceptionHandler"]);


}

public function errorHandler($errno, $errstr, $errfile, $errline){
//    header("HTTP/1.0 505 Inner error");
    $strErr = $this->createErrMes($errno, $errstr, $errfile, $errline);
    $this->selectIncludeFile($strErr,505);

}
public function exceptionHandler($exception){
    $errno = $exception->getCode()?:503;
//    header("HTTP/1.0 $errno");
    $strErr = $this->createErrMes($errno, $exception->getMessage(), $exception->getFile(),
        $exception->getLine(),$exception->getTrace());

    $this->selectIncludeFile($strErr,$errno, true);
}


public function createErrMes($errno, $errstr, $errfile, $errline,$errstack=false){
    $stack ="";
    if($errstack){
        foreach ($errstack as $value){
            if(!isset($value['file'])){
                break;
            }
            $stack.="<em>{$value['function']}</em><br> Ошибка произошла в файле: {$value['file']} <br>
                На строке: {$value['line']} <br>++++++++++++++++++++++++<br>";
        }
    }
    if(DEBUG) {
        return "Сообщение ошибки: $errstr <br> Ошибка произошла в файле: $errfile <br> 
                На строке: $errline <br> Код ошибки: $errno <br>=========================<br> 
                $stack ";
    }

    return date(DATE_ATOM)."  \n Сообщение ошибки: $errstr \n Ошибка произошла в файле: $errfile \n На строке: $errline \n Код ошибки: $errno \n=========================\n";

}
public function selectIncludeFile($strErr,$errno,$criticalError = false){
    if(DEBUG){
        require_once  ERROR."/errorDev.php";
        die();
    } else if(!DEBUG & $errno==404){
        include ERROR."/404.html";
        die();
    }
    else if(!DEBUG & !$criticalError){
        error_log($strErr,3,ERROR."/log_error.txt");
    } else{
        require_once  ERROR."/errorProd.php";
        error_log($strErr,3,ERROR."/log_error.txt");
        die();
    }
}

}
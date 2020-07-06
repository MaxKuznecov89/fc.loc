<?php
namespace app\controllers;


class MainController extends AppController
{
//    public function __construct($route)
//    {
//        parent::__construct($route);
//        $this->layout = "mainTest";
//        $this->view = "bla";
//
//    }

    public function indexAction(){
        echo "Main:index";
    }
    public function testAction(){
        $sex = "man";
        $age = 36;
        $this->view = "bla";
        $this->set(compact("sex","age"));
        debug($this->vars);
    }
    public function testPageAction(){
        echo "olala";
    }

}
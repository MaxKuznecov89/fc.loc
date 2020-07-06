<?php
namespace app\controllers;


class Main extends App
{
    public function indexAction(){
        echo "Main:index";
    }
    public function testAction(){
        $this->layout = "mainTest";
//        $this->view = "bla";
    }
    public function testPageAction(){
        echo "olala";
    }

}
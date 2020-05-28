<?php
namespace app\controllers;



class Posts extends App
{
    public function indexAction(){
        echo "Posts:index";
        var_dump($this->route);
    }
    public function testAction(){
        echo "Posts:test";
    }
    public function testPageAction(){
        echo "Posts:testPage";
    }

}
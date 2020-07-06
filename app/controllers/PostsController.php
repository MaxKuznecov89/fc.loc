<?php
namespace app\controllers;



class PostsController extends AppController
{
    public function indexAction(){
        echo "Posts:index";

    }
    public function testAction(){
        echo "Posts:test";
    }
    public function testPageAction(){
        echo "Posts:testPage";
    }

}
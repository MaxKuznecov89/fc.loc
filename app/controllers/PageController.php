<?php


namespace app\controllers;


class PageController extends AppController
{
    public function viewAction(){
        echo "view";
    }
    public function indexAction(){
        debug($_POST);
    }
}
<?php
namespace app\controllers;
use app\model\Main;

class MainController extends AppController
{

    public function indexAction(){
        $instDb = new Main();
        $arrData = $instDb->findAll();

        $name = $arrData[0]["name"];
        $age = $arrData[0]["age"];

        $this->set(compact("name","age"));
    }


}
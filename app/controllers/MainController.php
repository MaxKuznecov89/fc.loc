<?php
namespace app\controllers;
use app\model\Main;

class MainController extends AppController
{

    public function indexAction(){
        $instDb = new Main();
//        $arrData = $instDb->findOne('Dima');
//        $sql = "SElECT name FROM $instDb->table WHERE name LIKE ?";
//
//        $arrData = $instDb->findBySql($sql,['%a%']);
        $arrData = $instDb->findLike("%a%", "name");
        debug($arrData);
//        $name = $arrData[0]["name"];
//        $age = $arrData[0]["age"];
//
//        $this->set(compact("name","age"));
    }


}
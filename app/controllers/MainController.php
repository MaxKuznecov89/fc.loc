<?php
namespace app\controllers;
use app\model\Main;
use vendor\core\App;
class MainController extends AppController
{

    public function indexAction(){


         new Main();
        $res = \R::find("hookers", "name = ?", ["Jasica"]);
        $name = $res[5]["name"];
        $age = $res[5]["id"];
        $this->set(compact("name","age"));
    }

 public function testAction(){

 }
}
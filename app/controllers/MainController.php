<?php
namespace app\controllers;
use app\model\Main;
use vendor\core\App;
class MainController extends AppController
{

    public function indexAction(){


         new Main();
        $res = \R::find("people", "name = ?", ["Dima"]);
        $name = $res[1]["name"];
        $age = $res[1]["id"];
        $this->set(compact("name","age"));
    }

 public function testAction(){

        if($this->getIsAjaxRequest()){
            $this->layout = false;
            $myDate = $_POST["a"];
//            $this->set(compact("myDate"));
            $this->getView("test",compact("myDate"));
            die();

        }

 }
}
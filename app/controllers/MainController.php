<?php
namespace app\controllers;
use app\model\Main;
use fs\core\App;
use fs\core\base\View;
use fs\core\widgets\menu\Menu;


class MainController extends AppController
{

    public function indexAction(){


        new Main();

        View::setMeta("ШлюхинДоволен","fuck you ass", "hookers");
        $res = \R::find("people", "id = 1");
        $name = $res[1]["name"];
        $age = $res[1]["id"];

        $this->set(compact("name","age"));

    }

 public function testAction(){

        if($this->getIsAjaxRequest()){
            $this->layout = false;
            $myDate = $_POST["a"];
            $this->loadView("test",compact("myDate"));
            die();

        }

 }
}
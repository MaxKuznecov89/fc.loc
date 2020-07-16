<?php
namespace app\controllers;
use app\model\Main;
use vendor\core\App;
use vendor\core\base\View;


class MainController extends AppController
{

    public function indexAction(){

        $config = require_once CONF . "/config.php";
        new Main($config);
        View::setMeta("ШлюхинДоволен","fuck you ass", "hookers");
        $res = \R::find("people", "name = ?", ["Dima"]);
        $name = $res[3]["name"];
        $age = $res[3]["id"];
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
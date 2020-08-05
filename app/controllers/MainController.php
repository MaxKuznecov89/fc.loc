<?php
namespace app\controllers;
use app\model\Main;
use fs\core\App;
use fs\core\base\View;
use fs\core\widgets\menu\Menu;
use fs\libs\Pagination;


class MainController extends AppController
{

    public function indexAction(){


        new Main();

        View::setMeta("ШлюхинДоволен","fuck you ass", "hookers");
        $total = \R::count("products");
        $perpage = 5;
        $currentPage = isset($_GET["page"])? $_GET["page"] : 1;
        $pag = new Pagination($perpage, $currentPage, $total);

        $start = $pag->getStart();
        $res = \R::findAll("products", "LIMIT $start, $perpage");

//        $name = $res[1]["name"];
//        $age = $res[1]["id"];

        $this->set(compact("res","pag"));

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
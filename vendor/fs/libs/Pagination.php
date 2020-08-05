<?php


namespace fs\libs;


class Pagination
{
    public $currentPage = null; //текущая страница
    public $total = null;       //кол-во всего постов
    public $countPages = null;  // всего страниц
    public $uri = null;         // параметры
    public $perpage = null; // количесво постов вывода на страницу

    public function __construct($perpage,$currentPage,$total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($currentPage);
        $this->uri = $this->getParam();

    }
    public function getCurrentPage($currentPage){
        if(!isset($currentPage) || $currentPage < 1 ){
            $currentPage = 1;
        }
        if($currentPage > $this->countPages){
            $currentPage = $this->countPages;
        }
        return $currentPage;
    }

    public function getCountPages(){
        return ceil($this->total/$this->perpage)? : 1;

    }

    public function getParam(){
        $url = $_SERVER["REQUEST_URI"];
        $url  = explode("?", $url);
        $uri = $url[0] . "?";

        $arrParam  = @explode("&", $url[1]);
        foreach ($arrParam as $param){
            if(!preg_match("#page=#", $param)){
                $uri = $uri . $param . "&amp";
            }
        }
        return $uri;
    }

    public function getHtml(){
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left= null;
        $page2right= null;
        $page1right= null;

        if($this->currentPage > 1){
            $back = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage - 1)."'>&lt;</a></li>";
        }

        if($this->currentPage < $this->countPages){
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" .($this->currentPage + 1)."'>&gt;</a></li>";
        }

        if($this->currentPage > 3){
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }

        if($this->currentPage < ($this->countPages - 2)){
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }

        if($this->currentPage - 2 > 0){
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" .
                ($this->currentPage - 2)."'>". ($this->currentPage - 2) . "</a></li>";
        }

        if($this->currentPage - 1 > 0){
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=" .
                ($this->currentPage - 1)."'>". ($this->currentPage - 1) . "</a></li>";
        }

        if($this->currentPage + 1 <= $this->countPages){
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=" .
                ($this->currentPage + 1)."'>". ($this->currentPage + 1) . "</a></li>";
        }

        if($this->currentPage + 2 <= $this->countPages){
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" .
                ($this->currentPage + 2)."'>". ($this->currentPage + 2) . "</a></li>";
        }

        return '<ul class = "pagination">' .$startpage.$back.$page2left.$page1left.'<li class="active"><li>'.$this->currentPage
            . '<a/></li>' . $page1right.$page2right.$forward.$endpage.'</ul>';

    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getStart(){
        return ($this->currentPage - 1) * $this->perpage;
    }
}
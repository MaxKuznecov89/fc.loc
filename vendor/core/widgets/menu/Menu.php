<?php


namespace vendor\core\widgets\menu;



use vendor\libs\Cache;

class Menu
{
    protected $date;
    protected $tree;
    protected $menuhtml;
    protected $tpl;
    protected $container = "ul";
    protected $cache = 3600;
    protected $table = "categories";

    public function __construct($options = [])
    {
        $this->tpl = "menu_tpl/category_template.php";
        $this->getOptions($options);
        $this->run();
    }

    public function getOptions($options){
        foreach ($options as $key=>$val){
            if(property_exists($this, $key)){
                $this->$key = $val;
            }
        }
    }

    public function run(){
        $cache = new Cache();
        $this->menuhtml = $cache->get("widget_menu");

        if(!$this->menuhtml){
            $date = \R::getAssoc("select * from $this->table");
            $this->tree = $this->map_tree($date);
            $this->menuhtml = $this->categories_to_string($this->tree);
            $cache->set("widget_menu", $this->menuhtml);
        }
        $this->output();

    }

    public function output(){
        echo "<$this->container id=\"accordion\" class=\"menu\">";
            echo $this->menuhtml;
        echo "</$this->container>";
    }

    public function map_tree($dataset) {
        $tree = array();

        foreach ($dataset as $id=>&$node) {
            if (!$node['parent']){
                $tree[$id] = &$node;
            }else{
                $dataset[$node['parent']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

    public function categories_to_string($data){
        $string="";
        foreach($data as $key=>$item ){
            $string .= $this->categories_to_template($item,$key);
        }

        return $string;
    }


    public function categories_to_template($category,$id){

        ob_start();
        include 'menu_tpl/category_template.php';
        return ob_get_clean();
    }
}
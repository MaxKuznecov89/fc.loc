<?php


namespace fs\core\base;


class View
{
    public $route = [];
    public $view;
    public $layout;
    private $arrScripts =[];
    private static $metaARR=["title"=>'',"desc"=>'',"keywords"=>''];

    public function __construct($route, $layout = '', $view = '')
    {

        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function sanitize_output($buffer) {

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }

    public function render($vars)
    {
       if(is_array($vars)) {
           extract($vars);
       }

        $pathView = APP . "/views/{$this->route['controller']}/{$this->view}.php";

        ob_start();

        if (file_exists($pathView)) {

            include "$pathView";
        } else {
            echo "<p>View <b>$pathView</b> not found</p>";
        }

        $view = ob_get_clean();
    
        if ($this->layout !== false) {
            $pathLayout = APP . "/views/layout/{$this->layout}.php";

            if (file_exists($pathLayout)) {
                $view = $this->getScript($view);
                $scripts = [];
                if(!empty($this->arrScripts)){
                    $scripts=$this->arrScripts[0];
                }
                ob_start("gzencode");
                ob_start([$this,"sanitize_output"]);
                header('Content-Encoding: gzip');
                include "$pathLayout";
                ob_end_flush();
                ob_end_flush();

            } else {
                echo "<p>Layout <b>$pathLayout</b> not found</p>";
            }

        }

    }

    protected function getScript($content){

        $regRule = '#<script.*?>.*?</script>#s';
        preg_match_all($regRule, $content,$this->arrScripts);
        if(!empty($this->arrScripts)){
            $content = preg_replace ($regRule,"",$content);

        }
        return $content;
    }
    public static function getMeta(){
        echo "<title>" . self::$metaARR["title"]. "</title> \n";
//        echo "\n";
        echo "<meta name = 'description' content = " . self::$metaARR["desc"] . "> \n";
        echo "<meta name = 'keywords' content = " . self::$metaARR["keywords"]. "> \n";
    }

    public static function setMeta($title = '',$desc = '', $keywords = '' )
    {
        self::$metaARR["title"] = $title;
        self::$metaARR["desc"] = $desc;
        self::$metaARR["keywords"] = $keywords;
    }

}
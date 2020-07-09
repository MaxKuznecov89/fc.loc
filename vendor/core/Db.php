<?php


namespace vendor\core;


class Db
{
    private static $instDb;
    private $pdo;
    public static $countSql = 0;
    public static $queries = [];
    private function __construct()
    {
        $conf = require CONF . "/config_db.php";
        $arrOptions = [\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC
            ];

        $this->pdo = new \PDO($conf["dsn"],$conf["userName"],$conf["password"],$arrOptions);

    }
    public function execute($sql){
        self::$countSql++;
        self::$queries[]=$sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();

    }

public function query($sql){
    $stmt = $this->pdo->prepare($sql);
    $res =  $stmt->execute();
    self::$countSql++;
    self::$queries[]=$sql;
    if($res !== false){
        return $stmt->fetchAll();
    }
    return [];
}

    static public function instance(){
        if(!self::$instDb){
            self::$instDb = new self();
        }
            return self::$instDb;


    }
}
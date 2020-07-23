<?php


namespace fs\core;


class Db
{

  use TSingleton;
    private $pdo;
    public static $countSql = 0;
    public static $queries = [];
    private function __construct()
    {
        $confDb = require CONF . "/config_db.php";
        require_once LIBS . "/rb-mysql.php";
        \R::setup($confDb["dsn"],$confDb["userName"],$confDb["password"]);
        \R::freeze(true);

//        \R::fancyDebug(TRUE);



    }
    public function execute($sql,$pram=[]){
        self::$countSql++;
        self::$queries[]=$sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($pram);

    }

public function query($sql,$pram=[]){
    $stmt = $this->pdo->prepare($sql);
    $res =  $stmt->execute($pram);

    self::$countSql++;
    self::$queries[]=$sql;
    if($res !== false){
        return $stmt->fetchAll();
    }
    return [];
}




}
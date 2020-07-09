<?php


namespace vendor\core\base;

use vendor\core\Db;

abstract class Model
{
    private $pdo;
    protected $table;
    public function __construct()
    {
        $this->pdo = Db::instance();
    }
    public function query($sql){
        $this->pdo->execute($sql);
    }
    public function findAll(){
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql);
    }
}
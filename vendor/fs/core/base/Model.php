<?php


namespace fs\core\base;

use fs\core\Db;

abstract class Model
{
    private $pdo;
    protected $table;
    protected $pk = 'id';

    public function __construct($config)
    {
        $this->pdo = Db::getInstance($config);
    }
    public function query($sql){
        $this->pdo->execute($sql);
    }
    public function findAll(){
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql);
    }
    public function findOne($id,$field = ''){
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field=? LIMIT 1";
        return $this->pdo->query($sql,[$id]);
    }

    public function findBySql($sql,$param=[]){
        return $this->pdo->query($sql,$param);
    }
    public function findLike($str,$field,$table =''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";

        return $this->pdo->query($sql,[$str]);
    }
}
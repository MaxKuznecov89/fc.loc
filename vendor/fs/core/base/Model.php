<?php

namespace fs\core\base;

use fs\core\Db;
use Valitron\Validator;

abstract class Model
{
    private $pdo;
    protected $table;
    protected $pk = 'id';
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {

        $config = require "../config/config_db.php";
        $this->pdo = Db::getInstance($config);
    }

    public function validate($dataArr){
        $validator = new Validator($dataArr);
        $validator->rules($this->rules);
        if($validator->validate()){
             return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public function load($dataArr){
        foreach ($this->attributes as $key=>$value){
            if(isset($dataArr[$key])){
                $this->attributes[$key] = $dataArr[$key];
            }
        }
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
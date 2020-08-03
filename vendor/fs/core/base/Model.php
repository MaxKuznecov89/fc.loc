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


    public function getErrors()
    {
        $errors = '<ul>';
        foreach($this->errors as $errorGroup){
            foreach($errorGroup as $error){
                $errors .=  '<li>' . $error . '</li>';
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;

        return $this->errors;
    }


    public function save($table)
    {

            $tbl = \R::dispense($table);
            foreach ($this->attributes as $key => $value) {
                $tbl->$key = $value;
            }
            return \R::store($tbl);

    }

}
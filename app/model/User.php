<?php


namespace app\model;

use fs\core\base\Model;

class User extends Model
{
    public $attributes = [
        "name"=>"",
        "email"=>"",
        "login"=>"",
        "password"=>"",
        "role"=>"user"
    ];
}
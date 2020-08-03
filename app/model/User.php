<?php


namespace app\model;

use fs\core\base\Model;

class User extends Model
{
    public $attributes = [
        "name"     => "",
        "email"    => "",
        "login"    => "",
        "password" => "",
        "role"     => "user",
    ];

    public $rules = [
        'email'     => [['email']],
        'required'  => [['email'], ['name'], ['login'], ['password']],
        'LengthMin' => [['password', 6]],
    ];

    public function checkUnique(){

        $res = \R::findOne("users","login = ? OR email = ? LIMIT 1", [$this->attributes["login"],$this->attributes["email"]]);
        if($res) {
            if ($res["login"] == $this->attributes["login"]) {

                $this->errors["unique"][] = "Логин существует";
            }

            if ($res["email"] == $this->attributes["email"]) {
                $this->errors["unique"][] = "Мыло существует";
            }
            return false;
        }
        return true;
    }
}
<?php
require "rb-mysql.php";
$confDb = require "../../config/config_db.php";
R::setup($confDb["dsn"],$confDb["userName"],$confDb["password"]);
$res = R::find("hookers", "name = ?", ["Jasica"]);
var_dump($res);
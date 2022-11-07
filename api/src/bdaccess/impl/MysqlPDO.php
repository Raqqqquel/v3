<?php

namespace App\bdaccess\impl;

use App\bdaccess\IConnection;

class MysqlPDO implements IConnection{

    public static function connect(): \PDO{
        $pdo = new \PDO($_ENV["DB_TYPE"].":host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_NAME"],$_ENV["DB_USER"],$_ENV["DB_PASSWORD"]);
        $pdo -> exec("set names utf8");
        $pdo -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;

        throw new \Exception("Error al conectar a la base de datos");
    }
}
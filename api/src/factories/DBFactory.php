<?php

namespace App\factories;
use App\bdaccess\impl\MysqlPDO;

class DBFactory{

    static function getConnection(): MysqlPDO{
        return new MysqlPDO();
    }
}

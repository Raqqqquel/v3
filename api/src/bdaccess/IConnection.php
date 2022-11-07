<?php
namespace App\bdaccess;

interface IConnection{

    // Conexión a la Base de Datos
    public static function connect(): \PDO;
}
<?php

namespace App\factories;

use App\services\impl\MoviesService;

use App\bdaccess\IConnection;
use App\DAO\impl\MoviesDBDAO;

class MoviesFactory {

    static function getService(): MoviesService{
        return new MoviesService();
    }

    static function getDAO(): MoviesDBDAO{
        return new MoviesDBDAO();
    }

    static function getConnection(): IConnection{
        return new IConnection();
    }
}
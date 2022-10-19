<?php
namespace App\controllers;

use App\factories\MoviesFactory;
use App\response\HTTPResponse;

class MoviesController{
        
    public function all(){
        echo "Listado de todas las películas";
        HTTPResponse::json(200, MoviesFactory::getService()->all());
    }

    public function find($id){
        echo "Detalle de la película con id $id";
        
        try {
            HTTPResponse::json(200, MoviesFactory::getService()->find($id));
        } catch (\Exception $e){
            HTTPResponse::json(400, $e->getMessage());
        }
    }
}
<?php

namespace App\controllers;

use App\factories\MoviesFactory;
use App\response\HTTPResponse;
use App\DTO\MovieDTO;

class MoviesController{
        
    public function all(){
        HTTPResponse::json(200, MoviesFactory::getService()->all());
    }

    public function create(){
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $movie = new MovieDTO(null, $data['titulo'], $data['anyo'], $data['duracion']);
            MoviesFactory::getService()->create($movie);
            HTTPResponse::json(201, "Recurso creado");
        } catch (\Exception $e){
            HTTPResponse::json($e->getCode(), $e->getMessage());
        }
    }

    public function find($id){
        try {
            HTTPResponse::json(200, MoviesFactory::getService()->find($id));
        } catch (\Exception $e){
            HTTPResponse::json(400, $e->getMessage());
        }
    }

    public function update($id){
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            HTTPResponse::json(200, MoviesFactory::getService()->update($id, new MovieDTO(null, $data['titulo'], $data['anyo'], $data['duracion'])));
        } catch (\Exception $e){
            HTTPResponse::json(400, $e->getMessage());
        }
    }

    public function delete($id){
        try {
            //$data = json_decode(file_get_contents('php://input'), true);
            //$movie = new MovieDTO(null, $data['titulo'], $data['anyo'], $data['duracion']);
            HTTPResponse::json(200, MoviesFactory::getService()->delete($id));
        } catch (\Exception $e){
            HTTPResponse::json(400, $e->getMessage());
           }
    }
}
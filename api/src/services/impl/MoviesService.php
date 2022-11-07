<?php

namespace App\services\impl;
 
use App\services\IMoviesService;
use App\DTO\MovieDTO;
use App\factories\MoviesFactory;

class MoviesService implements IMoviesService {

    public function all():array {
        return MoviesFactory::getDAO()->read();
    }
 
    /**
     *
     * @param mixed $id
     *
     * @return \App\DTO\MovieDTO
    */

    function find($id):MovieDTO {
        return MoviesFactory::getDAO()->findById($id);
    }
    
    function create($movie){
        return MoviesFactory::getDAO()::create($movie);
    }

    function update($id, $movie){
        return MoviesFactory::getDAO()::update($id, $movie);
    }

    function delete($id){
        return MoviesFactory::getDAO()::delete($id);
    }
}
    
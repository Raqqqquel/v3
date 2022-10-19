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
}
    
<?php

namespace App\DAO\impl;

use App\DTO\MovieDTO;
use App\DAO\IMoviesDAO;

class MoviesJSON
{

    public function __construct()
    {
        $data = file_get_contents(base_path("src/data/peliculas.json"));
        $this->peliculas = json_decode($data, true);
    }

    /**
     *
     * @param MovieDTO $movie
     *
     * @return bool
     */
    function create(MovieDTO $movie): bool
    {
        return false;
    }

    /**
     *
     * @return array
     */
    function read(): array
    {
        $result = array();

        foreach ($this->peliculas as $movie) {
            array_push(
                $result,
                new MovieDTO(
                    $movie['id'],
                    $movie['titulo'],
                    $movie['anyo'],
                    $movie['duracion']
                )
            );
        }

        return $result;
    }

    /**
     *
     * @param int $id
     *
     * @return MovieDTO
     */

    function findById(int $id): MovieDTO
    {
        foreach ($this->peliculas as $movies) {
            if ($movies['id'] == $id) {
                return new MovieDTO(
                    $movies['id'],
                    $movies['titulo'],
                    $movies['anyo'],
                    $movies['duracion'],
                );
            }
        }

        throw new \Exception("No se ha podido encontrar la pelicula con id " . $id);
        
    }

    /**
     *
     * @param int $id
     * @param MovieDTO $movie
     *
     * @return bool
     */
    function update(int $id, MovieDTO $movie): bool
    {
        return false;
    }

    /**
     *
     * @param int $id
     *
     * @return bool
     */
    function delete(int $id): bool
    {
        return false;
    }
}
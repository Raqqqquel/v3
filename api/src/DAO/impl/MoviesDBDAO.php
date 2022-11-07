<?php

namespace App\DAO\impl;

use App\bdaccess\orm\DB;
use App\DAO\IMoviesDAO;
use App\DTO\MovieDTO;


class MoviesDBDAO implements IMoviesDAO {
 
    public static function create(MovieDTO $movie): bool {
        $params = [
            ':titulo' => $movie->titulo(),
            ':anyo' => $movie->anyo(),
            ':duracion' => $movie->titulo(),
            
        ];
        $sql = "INSERT INTO peliculas (id, titulo, anyo, duracion) VALUES (null, :titulo, :anyo, :duracion)";
        return DB::insert($sql, $params);
    }
    
    public static function read(): array {
        $result = array();
        $db_data = DB::table('peliculas')->select('*')->get();
        foreach ($db_data as $movie) {
            $result[] = new MovieDTO(
                $movie->id, 
                $movie->titulo, 
                $movie->anyo, 
                $movie->duracion
            );            
        }
        return $result;
    }
     
    static function findById(int $id): MovieDTO {
        $db_data = DB::table('peliculas')->find($id);
        $result = new MovieDTO(
                $db_data->id, 
                $db_data->titulo, 
                $db_data->anyo, 
                $db_data->duracion
            );            
        return $result;
    }
 
    static function update(int $id, MovieDTO $movie): bool {
        $updaterow = DB::table("peliculas")->update([
            'id'=>$id,
            'titulo'=>$movie->titulo(),
            'anyo'=>$movie->anyo(),
            'duracion'=>$movie->duracion()
        ]);

        return ($updaterow > 0) ? true:false;
    }
     
    static function delete(int $id): bool {
        $deletedrow = DB::table("peliculas")->delete([
            'id'=>$id,
            'titulo'=>$movie->titulo(),
        ]);

        return ($deletedrow >0) ? true:false;
    }
}
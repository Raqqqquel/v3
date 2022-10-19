<?php 

$router = new \Bramus\Router\Router();
 
 
$router->setNamespace('\App');
 
/**
 * Definimos nuestras rutas
 */
$router->get('/', function() { echo "Bienvenido a la API de películas"; });
$router->get('/peliculas', 'controllers\MoviesController@all');
$router->get('/peliculas/(\d+)', 'controllers\MoviesController@find');


/* Muestra error
 *
 */
$router->set404(function() { 
    http_response_code(404);
    echo json_encode('No se encontró la página'); 
});

 
$router->run();
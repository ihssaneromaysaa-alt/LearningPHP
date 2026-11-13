<?php
/** LISTA BLANCA DE RUTAS: solo las URLs registradas aquí son accesibles */

// Las rutas fijas van antes que las que tienen parámetros (:id)
// Este nombre sería más adecuado para esta ruta: Router::add('get', 'usuario/nuevo', [AuthController::class, 'create']
// y lo mismo ocurre con procesar que lo modificaremos cuando tengamos la base de datos

/*
Router::add('post', 'usuario/procesar', [AuthController::class, 'procesar']);
Router::add('get', 'usuario/:id', [AuthController::class, 'show']);
Router::add('post', 'usuario/save', [AuthController::class, 'save']);
*/


use Controllers\AuthController;
use Controllers\HomeController;
use Core\Router;

Router::add('get', '/', [HomeController::class, 'index']);

Router::add('get', 'usuario/nuevo', [AuthController::class, 'formulario']);

Router::add('post', 'usuario/nuevo', [AuthController::class, 'formulario']);
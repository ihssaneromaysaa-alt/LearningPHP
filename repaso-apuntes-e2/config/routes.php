<?php
use Controllers\ImagenController;
use Core\Router;

// inicio
Router::add('get',  '/',         [ImagenController::class, 'inicio']);

Router::add('post', 'cargarImagen', [ImagenController::class, 'cargarImagen']);
Router::add('post', 'eliminarImagen', [ImagenController::class, 'eliminarImagen']);
Router::add('post', 'eliminarGaleria', [ImagenController::class, 'eliminarGaleria']);

/*
Router::add('get', 'form', [ContactoController::class, 'form']);
Router::add('post', 'form', [ContactoController::class, 'form']);
Router::add('post', 'vaciar', [ContactoController::class, 'vaciar']);
*/
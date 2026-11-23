<?php
 use Controllers\AuthController;
 use Controllers\ImagenController;
 
use Core\Router;

Router::add('get',  '/', [AuthController::class, 'index']);
Router::add('post',  '/usuario/nuevo', [AuthController::class, 'nuevo']);

Router::add('get',  '/usuario/registrar', [AuthController::class, 'mostrarRegistro']);
Router::add('post',  '/usuario/nuevoUsuario', [AuthController::class, 'registrar']);

// mostrar formulario

Router::add('get',  '/form/MostrarViviendas', [ImagenController::class, 'inicio']); 

Router::add('post',  '/form/viviendas', [ImagenController::class, 'cargarImagen']);

Router::add('post', '/eliminarImagen', [ImagenController::class, 'eliminarImagen']);
Router::add('post', '/eliminarGaleria', [ImagenController::class, 'eliminarGaleria']);

// registro e inicio de sesion

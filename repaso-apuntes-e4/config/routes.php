<?php
 use Controllers\AuthController;
use Core\Router;

Router::add('get',  '/', [AuthController::class, 'index']);
Router::add('post',  '/usuario/nuevo', [AuthController::class, 'nuevo']);

Router::add('get',  '/usuario/registrar', [AuthController::class, 'mostrarRegistro']);
Router::add('post',  '/usuario/nuevoUsuario', [AuthController::class, 'registrar']);


// registro e inicio de sesion

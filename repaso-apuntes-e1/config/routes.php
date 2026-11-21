<?php
use Controllers\ContactoController;
use Core\Router;

Router::add('get',  '/',         [ContactoController::class, 'index']);
Router::add('post', 'guardar', [ContactoController::class, 'guardar']);
Router::add('get', 'form', [ContactoController::class, 'form']);
Router::add('post', 'form', [ContactoController::class, 'form']);
Router::add('post', 'vaciar', [ContactoController::class, 'vaciar']);
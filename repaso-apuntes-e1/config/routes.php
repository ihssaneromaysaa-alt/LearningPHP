<?php
use Controllers\ContactoController;
use Core\Router;

Router::add('get',  '/',         [ContactoController::class, 'index']);
Router::add('post', 'contactos', [ContactoController::class, 'guardar']);
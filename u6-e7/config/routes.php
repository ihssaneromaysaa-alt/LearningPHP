<?php
/** LISTA BLANCA DE RUTAS: solo las URLs registradas aquí son accesibles */

use Controllers\CarritoController;
use Core\Pages;
use Core\Router;

Router::add('get', '/', [CarritoController::class, 'index']);

Router::add('post', 'carrito/anadir', [CarritoController::class, 'anadir']);

Router::add('get', 'carrito/pedidos', [CarritoController::class, 'pedidos']);
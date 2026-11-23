<?php
declare(strict_types=1);

// Ruta absoluta a la raíz del proyecto.
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/autoloader.php';
require BASE_PATH . '/config/config.php';
require BASE_PATH . '/config/routes.php';
require_once BASE_PATH . '/src/Core/helpers.php';

use Core\Router;

// ejercicio sin sesiones 1

// siempre escribir esta linea al final del bootstrap.
Router::dispatch();

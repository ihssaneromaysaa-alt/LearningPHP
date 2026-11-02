<?php
declare(strict_types=1);
// punto de entrada unico de la aplicacion
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../autoloader.php';

use Controllers\FrontController;

FrontController::main();
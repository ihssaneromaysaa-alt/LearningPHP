<?php
declare(strict_types=1);
// punto de entrada unico de la aplicacion
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../autoloader.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

use Controllers\FrontController;

FrontController::main();

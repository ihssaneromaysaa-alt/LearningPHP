<?php
declare(strict_types=1);
define('BASE_PATH',dirname(__DIR__));
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/autoloader.php';

use Controllers\FrontController;

FrontController::main();
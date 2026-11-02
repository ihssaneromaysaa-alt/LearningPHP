<?php

require_once __DIR__ . '/../config/config.php';

require_once ROOT_PATH . '/autoloader.php';

use Controllers\ProductoController;

$controller = new ProductoController();

$controller->index();

?>
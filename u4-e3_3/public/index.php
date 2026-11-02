<?php

require_once __DIR__ . '/../config/config.php';

require_once ROOT_PATH . '/autoloader.php';

use Controllers\BibliotecaController;

// Crear controlador
$controller = new BibliotecaController();

// Obtener acción de la URL
$accion = $_GET['accion'] ?? 'inicio';

// Comprobar qué acción ejecutar
switch ($accion) {

    case 'libros':

        $controller->libros();

        break;

    case 'libro':

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $controller->libro($id);

        break;

    case 'autor':

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $controller->autor($id);

        break;

    case 'disponibles':

        $controller->disponibles();

        break;

    case 'inicio':

        $controller->inicio();

        break;

    default:

        $controller->inicio();

        break;
}

?>
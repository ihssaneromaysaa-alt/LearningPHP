<?php
/** ARCHIVO DE ARRANQUE  */
declare(strict_types=1);

// Ruta absoluta a la raíz del proyecto.
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/autoloader.php';
require BASE_PATH . '/config/config.php';
require BASE_PATH . '/config/routes.php';
require_once BASE_PATH . '/src/Core/helpers.php';

use Core\Router;
use Core\Session;

// La sesión se inicia UNA sola vez por petición, antes de cualquier salida.
Session::iniciar();
// Session::set('secret', '1234');
/*
echo '<pre>';
echo 'Ruta de sesiones: ' . session_save_path() . "\n";
echo 'ID de sesión: ' . session_id() . "\n";
echo '</pre>';
*/
// Etapa 6: aquí se llamará a Session::comprobarCaducidad();

// Session::comprobarCaducidad();
Router::dispatch();
// Evalúa la URL recibida y ejecuta la función/controlador asociado
Router::dispatch();

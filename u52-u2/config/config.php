<?php
declare(strict_types=1);

// configura la ruta inicial de la aplicación
if (!defined('CONTROLLER_DEFAULT')) {
    define('CONTROLLER_DEFAULT', 'articulo');
}

if (!defined('ACTION_DEFAULT')) {
    define('ACTION_DEFAULT', 'index');
}

// elige uno de los temas disponibles en style.css
if (!defined('TEMA')) {
    define('TEMA', 'azul');
}

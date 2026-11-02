<?php
declare(strict_types=1);

namespace Controllers;

/**
 * Controlador frontal: único punto de entrada de la aplicación.
 */
class FrontController
{
    public static function main(): void
    {
        $controller_name = $_GET['controller'] ?? CONTROLLER_DEFAULT;
        $action_name     = $_GET['action'] ?? ACTION_DEFAULT;

        $nombre_controlador = 'Controllers\\' . ucfirst($controller_name) . 'Controller';

        // Nombres prohibidos (como string, no hace falta que la clase exista aún)
        $prohibidos = [
            self::class,                    // Controllers\FrontController
            'Controllers\ErrorController',  // string → no fuerza el autoload aquí
        ];

        if (!class_exists($nombre_controlador) || in_array($nombre_controlador, $prohibidos, true)) {
            // Aquí sí se necesita la clase; class_exists + autoload o require
            if (class_exists(ErrorController::class)) {
                ErrorController::show_error404();
            } else {
                // Fallback por si el autoload falla también aquí
                http_response_code(404);
                echo 'Error 404: página no encontrada';
            }
            return;
        }

        $controlador = new $nombre_controlador();

        if (is_callable([$controlador, $action_name])) {
            $controlador->$action_name();
        } else {
            if (class_exists(ErrorController::class)) {
                ErrorController::show_error404();
            } else {
                http_response_code(404);
                echo 'Error 404: página no encontrada';
            }
        }
    }
}
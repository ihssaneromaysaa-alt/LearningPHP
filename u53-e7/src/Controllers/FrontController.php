<?php
declare(strict_types=1);

namespace Controllers;

/**
 * Controlador frontal: único punto de entrada de la aplicación.
 *
 * Lee ?controller=...&action=... de la URL, comprueba que existen
 * y llama a la acción. Si no es válido, muestra un error 404.
 *
 * Requiere las constantes CONTROLLER_DEFAULT y ACTION_DEFAULT (config/config.php).
 */
class FrontController
{
    public static function main(): void
    {
        $controller_name = $_GET['controller'] ?? CONTROLLER_DEFAULT;
        $action_name     = $_GET['action'] ?? ACTION_DEFAULT;

        // Solo letras en controlador y acción (evita rutas raras y métodos mágicos como __construct)
        if (
            !is_string($controller_name) || !preg_match('/^[A-Za-z]+$/', $controller_name)
            || !is_string($action_name) || !preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $action_name)
        ) {
            self::error404();
            return;
        }

        // auth -> Controllers\AuthController
        $nombre_controlador = 'Controllers\\' . ucfirst($controller_name) . 'Controller';

        // El controlador debe existir y no pueden invocarse el frontal ni el de errores
        if (
            !class_exists($nombre_controlador)
            || in_array($nombre_controlador, [self::class, ErrorController::class], true)
        ) {
            self::error404();
            return;
        }

        $controlador = new $nombre_controlador();

        // is_callable respeta la visibilidad: los métodos privados no cuentan
        if (is_callable([$controlador, $action_name])) {
            $controlador->$action_name();
        } else {
            self::error404();
        }
    }

    private static function error404(): void
    {
        (new ErrorController())->show_error404();
    }
}

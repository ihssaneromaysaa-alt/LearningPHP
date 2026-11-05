<?php
declare(strict_types=1);

namespace Controllers;

// controlador frontal: recibe la ruta y llama al controlador correspondiente
class FrontController
{
    public static function main(): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'POST') {
            $controller_name = $_POST['controller'] ?? CONTROLLER_DEFAULT;
            $action_name = $_POST['action'] ?? ACTION_DEFAULT;
        } else {
            $controller_name = $_GET['controller'] ?? CONTROLLER_DEFAULT;
            $action_name = $_GET['action'] ?? ACTION_DEFAULT;
        }
        // solo se admiten nombres sencillos para controlador y acción
        if (
            !is_string($controller_name)
            || !preg_match('/^[a-zA-Z]+$/D', $controller_name)
            || !is_string($action_name)
            || !preg_match('/^[a-zA-Z]+$/D', $action_name)
        ) {
            ErrorController::show_error404();
            return;
        }

        $nombre_controlador = 'Controllers\\' . ucfirst($controller_name) . 'Controller';

        if (
            !class_exists($nombre_controlador)
            || in_array($nombre_controlador, [self::class, ErrorController::class], true)
        ) {
            ErrorController::show_error404();
            return;
        }

        $controlador = new $nombre_controlador();

        if (is_callable([$controlador, $action_name])) {
            $controlador->$action_name();
            return;
        }

        ErrorController::show_error404();
    }
}

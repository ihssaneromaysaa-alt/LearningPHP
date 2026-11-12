<?php
declare(strict_types=1);

namespace lib;

// carga una vista dentro de la estructura común de cabecera y pie
class Pages
{
    public static function render(string $vista, array $datos = [], string $titulo = 'aplicación'): void
    {
        // función de escape disponible en todas las vistas
        $e = fn(mixed $valor): string => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

        extract($datos, EXTR_SKIP);

        $raiz = dirname(__DIR__, 2) . '/Views/';

        require $raiz . 'layout/header.php';
        require $raiz . $vista . '.php';
        require $raiz . 'layout/footer.php';
    }
}

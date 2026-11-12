<?php
declare(strict_types=1);

namespace lib;

// clase auxiliar que pinta una vista dentro del layout (cabecera + vista + pie)
class Pages
{
    public static function render(string $vista, array $datos = [], string $titulo = 'aplicación'): void
    {
        // funcion de escape disponible en todas las vistas como $e(...)
        $e = fn(mixed $valor): string => htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

        // convierte las claves del array en variables para la vista
        extract($datos, EXTR_SKIP);

        $raiz = dirname(__DIR__, 2) . '/Views/';

        require $raiz . 'layout/header.php';
        require $raiz . $vista . '.php';
        require $raiz . 'layout/footer.php';
    }
}
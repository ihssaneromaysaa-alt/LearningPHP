<?php
declare(strict_types=1);

namespace lib;

class Pages
{
    private const VIEWS_DIR = __DIR__ . '/../../Views/';

    public function render(string $pageName, ?array $params = null, string $titulo = 'Login'): void
    {
        // función de escape disponible en todas las vistas
        $e = static fn(mixed $valor): string =>
            htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

        // los parámetros pasan a ser variables de la vista (sin pisar $e ni $titulo)
        extract($params ?? [], EXTR_SKIP);

        $base   = self::VIEWS_DIR;
        $header = $base . 'layout/header.php';
        $vista  = $base . $pageName . '.php';
        $footer = $base . 'layout/footer.php';

        if (!file_exists($vista)) {
            die('No existe la vista: ' . $vista);
        }

        require $header;
        require $vista;
        require $footer;
    }
}

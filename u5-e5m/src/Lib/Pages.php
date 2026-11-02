<?php
declare(strict_types=1);

namespace Lib;

class Pages
{
    private const string VIEWS_DIR = __DIR__ . '/../../Views/';

    public function render(string $pageName, ?array $params = null): void
    {
        // convierte las claves del array en variables para la vista
        if ($params !== null) {
            foreach ($params as $name => $value) {
                $$name = $value;
            }
        }

        $base = self::VIEWS_DIR;

        // la carpeta se llama layout en minusculas
        require $base . 'layout/header.php';
        require $base . $pageName . '.php';
        require $base . 'layout/footer.php';
    }
}
<?php
declare(strict_types=1);
namespace lib;
class Pages{
    private const string VIEWS_DIR = __DIR__ . '/../../Views/';
    public function render(string $pageName, ?array $params = null): void
    {
        if ($params !== null) {
            foreach ($params as $name => $value) {
                $$name = $value;
            }
        }

        $base = self::VIEWS_DIR;

        $header = $base . 'Layout/header.php';
        $vista = $base . $pageName . '.php';
        $footer = $base . 'Layout/footer.php';

        if (!file_exists($vista)) {
            die('No existe la vista: ' . $vista);
        }

        require $header;
        require $vista;
        require $footer;
    }
}

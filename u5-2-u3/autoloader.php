<?php
declare(strict_types=1);

// registra la autocarga de clases del proyecto
spl_autoload_register(function (string $clase): void {
    $archivo = __DIR__ . '/src/'
        . str_replace('\\', '/', $clase)
        . '.php';

    if (is_file($archivo)) {
        require_once $archivo;
    }
});

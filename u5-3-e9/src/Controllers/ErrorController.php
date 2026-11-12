<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;

// controlador de errores: lo usa el controlador frontal
class ErrorController
{
    public static function show_error404(): void
    {
        http_response_code(404);
        Pages::render('error/error404', [], 'error 404');
    }
}
<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;

class ErrorController
{
    private Pages $page;

    public function __construct()
    {
        $this->page = new Pages();
    }

    public function show_error404(): void
    {
        http_response_code(404);
        $this->page->render('error/error404', [], 'Error 404');
    }
}

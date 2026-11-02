<?php
declare(strict_types=1);

namespace Controllers;

use Lib\Pages;
use Models\Usuario;
use Requests\UsuarioRequests;

class UsuarioController
{
    private Pages $page;

    public function __construct()
    {
        $this->page = new Pages();
    }

    public function formulario(): void
    {
        // Por defecto sin datos ni errores (primera carga o GET)
        $this->page->render('usuario/formulario', [
            'errores' => [],
            'datos'   => [],
        ]);
    }
}
<?php
declare(strict_types=1);

namespace Controllers;

use Lib\Pages;
class ContactoController
{
    private Pages $page;

    public function __construct()
    {
        $this->page = new Pages();
    }

    

    // Ya no hace falta el redirect si no usas sesiones.
    // Lo dejo por si lo usas en otro sitio, pero no se usa aquí.
    public function redirigir(string $ruta): never{
        header('Location: index.php?controller=contacto&action=' . $ruta);
        exit;
    }
}
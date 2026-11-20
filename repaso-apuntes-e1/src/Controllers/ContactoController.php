<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;

final class ContactoController
{
    public function index(): void
    {
        (new Pages())->render('contactos/index', []);
    }
    public function form(): void
    {
        (new Pages())->render('contactos/form', []);
    }

    public function guardar(): void
    {
        // Aquí más adelante: validar POST y guardar
    }
}
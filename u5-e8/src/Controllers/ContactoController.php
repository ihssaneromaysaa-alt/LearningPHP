<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Contacto;

class ContactoController
{
    // get: formulario vacio. post: valida y muestra errores o datos limpios
    public function formulario(): void
    {
        $nombre = '';
        $telefono = '';
        $correo = '';
        $errores = [];
        $correcto = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $this->leer('nombre');
            $telefono = $this->leer('telefono');
            $correo = $this->leer('correo');

            $errores = Contacto::validar($nombre, $telefono, $correo);
            $correcto = !$errores;
        }

        Pages::render('contacto/formulario', compact('nombre', 'telefono', 'correo', 'errores', 'correcto'), 'nuevo contacto');
    }

    private function leer(string $clave): string
    {
        $valor = $_POST[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }
}
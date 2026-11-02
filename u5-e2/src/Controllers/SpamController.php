<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;

class SpamController
{
    public function formulario(): void
    {
        Pages::render('spam/formulario', [], 'spam');
    }

    // recoge los tres datos y construye el mensaje (ficticio, no envia nada)
    public function enviar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=spam&action=formulario');
            return;
        }

        $nombre = $this->leer('nombre');
        $telefono = $this->leer('telefono');
        $correo = $this->leer('correo');

        if ($nombre === '' || $telefono === '' || $correo === '') {
            Pages::render('spam/formulario', [
                'error' => 'Debes rellenar los tres campos.',
                'nombre' => $nombre,
                'telefono' => $telefono,
                'correo' => $correo,
            ], 'spam');
            return;
        }

        Pages::render('spam/mensaje', compact('nombre', 'telefono', 'correo'), 'spam');
    }

    // lee un campo post como texto limpio
    private function leer(string $clave): string
    {
        $valor = $_POST[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }
}
<?php
declare(strict_types=1);

namespace Models;

class Contacto
{
    // valida los tres campos y devuelve los errores por campo
    public static function validar(string $nombre, string $telefono, string $correo): array
    {
        $errores = [];

        if ($nombre === '') {
            $errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (!preg_match('/^[\p{L}]+(?:\s[\p{L}]+)*$/u', $nombre)) {
            $errores['nombre'] = 'El nombre solo puede contener letras (y espacios entre palabras).';
        }

        if ($telefono === '') {
            $errores['telefono'] = 'El teléfono es obligatorio.';
        } elseif (!preg_match('/^\d{9}$/', $telefono)) {
            $errores['telefono'] = 'El teléfono debe tener exactamente 9 dígitos.';
        }

        if ($correo === '') {
            $errores['correo'] = 'El correo es obligatorio.';
        } elseif (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
            $errores['correo'] = 'El correo no tiene un formato válido.';
        }

        return $errores;
    }
}
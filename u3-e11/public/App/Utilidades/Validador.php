<?php
// App/Utilidades/Validador.php

namespace App\Utilidades;

class Validador
{
    /**
     * Método estático que valida un email
     */
    public static function validarEmail(string $email): bool
    {
        // filter_var es la forma más fiable en PHP
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
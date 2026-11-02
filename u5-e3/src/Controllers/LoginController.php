<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;

class LoginController
{
    public function formulario(): void
    {
        Pages::render('login/formulario', [], 'inicio de sesión');
    }

    // comprueba que ha llegado y lo muestra con fines didacticos
    public function procesar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=login&action=formulario');
            return;
        }

        $campos = ['usuario', 'password'];
        $filas = [];
        $faltan = [];

        foreach ($campos as $campo) {
            // array_key_exists distingue "no enviado" de "enviado vacio"
            $enviado = array_key_exists($campo, $_POST);
            $valor = $enviado && is_string($_POST[$campo]) ? trim($_POST[$campo]) : '';
            $vacio = $valor === '';

            if (!$enviado || $vacio) {
                $faltan[] = $campo;
            }

            $filas[] = [
                'campo' => $campo,
                'enviado' => $enviado,
                'vacio' => $vacio,
                // la contraseña nunca se muestra
                'valor' => $campo === 'password' ? ($vacio ? '' : '(oculta, ' . strlen($valor) . ' caracteres)') : $valor,
            ];
        }

        Pages::render('login/resultado', [
            'filas' => $filas,
            'faltan' => $faltan,
        ], 'resultado del login');
    }
}
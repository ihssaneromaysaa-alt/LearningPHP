<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;

class AlumnoController
{
    // muestra el formulario de alta
    public function formulario(): void
    {
        Pages::render('alumno/formulario', [], 'alta alumno');
    }

    // recibe el post y muestra todos los datos con su tipo
    public function recibir(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=alumno&action=formulario');
            return;
        }

        $filas = [];

        foreach ($_POST as $campo => $valor) {
            if (in_array($campo, ['password', 'password2'], true)) {
                // no se muestran las contraseñas, solo su longitud
                $texto = is_string($valor) ? str_repeat('•', strlen($valor)) . ' (' . strlen($valor) . ' caracteres)' : '(valor no válido)';
                $tipo = 'string (oculto)';
            } elseif (is_array($valor)) {
                // los checkbox con name="lenguajes[]" llegan como array
                $texto = implode(', ', array_map('strval', $valor));
                $tipo = 'array';
            } else {
                $texto = (string) $valor;
                $tipo = gettype($valor);
            }
            $filas[] = ['campo' => $campo, 'tipo' => $tipo, 'valor' => $texto];
        }

        // si no se marca ningun checkbox el navegador no envia el campo
        if (!isset($_POST['lenguajes'])) {
            $filas[] = ['campo' => 'lenguajes', 'tipo' => 'no recibido', 'valor' => '(ninguno marcado: el navegador no envía nada)'];
        }

        $coinciden = isset($_POST['password'], $_POST['password2'])
            && $_POST['password'] === $_POST['password2'];

        Pages::render('alumno/resultado', [
            'filas' => $filas,
            'coinciden' => $coinciden,
        ], 'datos recibidos');
    }
}
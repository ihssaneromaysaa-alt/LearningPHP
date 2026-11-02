<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Candidato;

class CandidatoController
{
    // get: formulario vacio. post: recibe, sanea y valida en el servidor
    public function formulario(): void
    {
        $candidato = [
            'nombre' => '', 'apellidos' => '', 'correo' => '', 'telefono' => '',
            'situacion' => '', 'lenguajes' => [], 'url' => '',
        ];
        $errores = [];
        $enviado = $_SERVER['REQUEST_METHOD'] === 'POST';

        if ($enviado) {
            [$candidato, $errores] = Candidato::procesar($_POST);
        }

        // campos que han pasado la validacion
        $validos = array_diff_key($candidato, $errores);

        Pages::render('candidato/formulario', [
            'candidato' => $candidato,
            'errores' => $errores,
            'validos' => $validos,
            'enviado' => $enviado,
            'situaciones' => Candidato::SITUACIONES,
            'lenguajes' => Candidato::LENGUAJES,
        ], 'candidatura');
    }
}
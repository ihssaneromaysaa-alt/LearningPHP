<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Triangulo;

class TrianguloController
{
    // una sola accion: distingue entre acceso inicial (get) y envio (post)
    public function area(): void
    {
        $base = '';
        $altura = '';
        $errores = [];
        $area = null;
        $enviado = $_SERVER['REQUEST_METHOD'] === 'POST';

        if ($enviado) {
            $base = $this->leer('base');
            $altura = $this->leer('altura');
            $errores = Triangulo::validar($base, $altura);

            // el resultado solo se calcula si los datos son validos
            if (!$errores) {
                $area = number_format(Triangulo::area($base, $altura), 2, ',', '.');
            }
        }

        Pages::render('triangulo/area', compact('base', 'altura', 'errores', 'area', 'enviado'), 'área del triángulo');
    }

    private function leer(string $clave): string
    {
        $valor = $_POST[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }
}
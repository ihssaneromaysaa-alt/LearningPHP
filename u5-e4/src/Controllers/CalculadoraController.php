<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Calculadora;

class CalculadoraController
{
    public function formulario(): void
    {
        Pages::render('calculadora/formulario', [], 'calculadora');
    }

    // procesa segun el boton pulsado (name="operacion")
    public function calcular(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=calculadora&action=formulario');
            return;
        }

        $n1 = $this->leer('numero1');
        $n2 = $this->leer('numero2');
        $operacion = $this->leer('operacion');

        $error = null;
        $resultado = null;
        $simbolo = Calculadora::OPERACIONES[$operacion] ?? '?';

        if (!is_numeric($n1) || !is_numeric($n2)) {
            $error = 'Introduce dos números válidos.';
        } elseif (!array_key_exists($operacion, Calculadora::OPERACIONES)) {
            $error = 'Operación no válida.';
        } else {
            try {
                $resultado = Calculadora::formatear(Calculadora::operar((float) $n1, (float) $n2, $operacion));
            } catch (\InvalidArgumentException $ex) {
                $error = ucfirst($ex->getMessage()) . '.';
            }
        }

        Pages::render('calculadora/formulario', [
            'numero1' => $n1,
            'numero2' => $n2,
            'operacion' => $operacion,
            'simbolo' => $simbolo,
            'resultado' => $resultado,
            'error' => $error,
        ], 'calculadora');
    }

    private function leer(string $clave): string
    {
        $valor = $_POST[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }
}
<?php
declare(strict_types=1);

namespace Controllers;

use InvalidArgumentException;
use lib\Pages;
use Models\Edad;

class EdadController
{
    // muestra el formulario y, si es post, tambien el resultado
    public function comprobar(): void
    {
        $dia = '';
        $mes = '';
        $anio = '';
        $error = null;
        $edad = null;
        $clase = '';
        $mensaje = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dia = $this->leer('dia');
            $mes = $this->leer('mes');
            $anio = $this->leer('anio');

            $d = filter_var($dia, FILTER_VALIDATE_INT);
            $m = filter_var($mes, FILTER_VALIDATE_INT);
            $a = filter_var($anio, FILTER_VALIDATE_INT);

            if ($d === false || $m === false || $a === false) {
                $error = 'Día, mes y año deben ser números enteros.';
            } else {
                try {
                    $edad = Edad::calcular($d, $m, $a);
                    [$clase, $mensaje] = Edad::mensaje($edad);
                } catch (InvalidArgumentException $ex) {
                    $error = $ex->getMessage();
                }
            }
        }

        Pages::render('edad/formulario', compact('dia', 'mes', 'anio', 'error', 'edad', 'clase', 'mensaje'), 'control de acceso');
    }

    private function leer(string $clave): string
    {
        $valor = $_POST[$clave] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }
}
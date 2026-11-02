<?php
declare(strict_types=1);

namespace Models;

class Triangulo
{
    // acepta coma o punto decimal
    public static function normalizar(string $valor): string
    {
        return str_replace(',', '.', trim($valor));
    }

    // devuelve un array de errores por campo (vacio si todo es correcto)
    public static function validar(string $base, string $altura): array
    {
        $errores = [];

        foreach (['base' => $base, 'altura' => $altura] as $nombre => $valor) {
            $valor = self::normalizar($valor);

            if ($valor === '') {
                $errores[$nombre] = 'Este campo es obligatorio.';
            } elseif (!is_numeric($valor)) {
                $errores[$nombre] = 'Debe ser un número.';
            } elseif ((float) $valor <= 0) {
                $errores[$nombre] = 'Debe ser mayor que cero.';
            }
        }

        return $errores;
    }

    // area = base x altura / 2
    public static function area(string $base, string $altura): float
    {
        return ((float) self::normalizar($base) * (float) self::normalizar($altura)) / 2;
    }
}
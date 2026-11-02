<?php
declare(strict_types=1);

namespace Models;

// logica de la calculadora
class Calculadora
{
    public const OPERACIONES = [
        'sumar' => '+',
        'restar' => '−',
        'multiplicar' => '×',
        'dividir' => '÷',
    ];

    public static function operar(float $a, float $b, string $operacion): float
    {
        return match ($operacion) {
            'sumar' => $a + $b,
            'restar' => $a - $b,
            'multiplicar' => $a * $b,
            'dividir' => $b == 0.0
                ? throw new \InvalidArgumentException('no se puede dividir entre cero')
                : $a / $b,
            default => throw new \InvalidArgumentException('operación no válida'),
        };
    }

    // quita ceros decimales sobrantes: 5.000000 -> 5
    public static function formatear(float $numero): string
    {
        $texto = rtrim(rtrim(number_format($numero, 6, '.', ''), '0'), '.');
        return $texto === '' || $texto === '-0' ? '0' : $texto;
    }
}
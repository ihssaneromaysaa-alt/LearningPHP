<?php
declare(strict_types=1);

namespace Models;

use DateTime;
use InvalidArgumentException;

class Edad
{
    public const ANIO_MINIMO = 1900;

    // calcula la edad exacta con datetime::diff (cuenta si el cumpleaños ya ha pasado)
    public static function calcular(int $dia, int $mes, int $anio): int
    {
        if ($anio < self::ANIO_MINIMO || !checkdate($mes, $dia, $anio)) {
            throw new InvalidArgumentException('La fecha introducida no es válida.');
        }

        $nacimiento = new DateTime(sprintf('%04d-%02d-%02d', $anio, $mes, $dia));
        $hoy = new DateTime('today');

        if ($nacimiento > $hoy) {
            throw new InvalidArgumentException('La fecha de nacimiento no puede estar en el futuro.');
        }

        return $nacimiento->diff($hoy)->y;
    }

    // devuelve [clase css, texto] segun la edad
    public static function mensaje(int $edad): array
    {
        if ($edad < 18) {
            return ['alerta-error', 'Con ' . $edad . ' años todavía no tienes edad suficiente para entrar.'];
        }

        if ($edad <= 85) {
            return ['alerta-ok', 'Con ' . $edad . ' años tienes permitido el acceso. ¡Bienvenido!'];
        }

        return ['alerta-error', 'Con ' . $edad . ' años superas la edad máxima admitida por el establecimiento.'];
    }
}
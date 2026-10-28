<?php

declare(strict_types=1);

namespace Enums;

enum Valor: int
{
    case As      = 1;
    case Dos     = 2;
    case Tres    = 3;
    case Cuatro  = 4;
    case Cinco   = 5;
    case Seis    = 6;
    case Siete   = 7;
    case Sota    = 10;
    case Caballo = 11;
    case Rey     = 12;

    public function toString(): string
    {
        return match ($this) {
            self::As      => 'as',
            self::Dos     => 'dos',
            self::Tres    => 'tres',
            self::Cuatro  => 'cuatro',
            self::Cinco   => 'cinco',
            self::Seis    => 'seis',
            self::Siete   => 'siete',
            self::Sota    => 'sota',
            self::Caballo => 'caballo',
            self::Rey     => 'rey',
        };
    }
}
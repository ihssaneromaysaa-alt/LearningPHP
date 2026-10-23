<?php

declare(strict_types=1);

namespace Enums;

enum Palo: string
{
    case Oros    = 'oros';
    case Copas   = 'copas';
    case Espadas = 'espadas';
    case Bastos  = 'bastos';

    public function toString(): string{
        return $this->value;
    }
}
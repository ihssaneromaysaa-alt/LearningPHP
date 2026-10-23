<?php

declare(strict_types=1);

namespace Models;

use Enums\Palo;
use Enums\Valor;
use InvalidArgumentException;

class Carta
{
    public function __construct(
        private readonly Valor $valor,
        private readonly Palo $palo
    ) {}

    public function toString(): string
    {
        return $this->valor->toString() . ' de ' . $this->palo->toString();
    }

    public function getValor(): Valor
    {
        return $this->valor;
    }

    public function getPalo(): Palo
    {
        return $this->palo;
    }
    public function getImagen(): string
    {
    return $this->palo->value . '_' . $this->valor->value . '.jpg';
    }
    public function __toString(): string
    {
        return $this->toString();
    }
}

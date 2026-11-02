<?php
// src/Pajaro.php

require_once __DIR__ . '/Animal.php';

class Pajaro extends Animal
{
    public function __construct(float $tamano, string $raza, string $color, string $nombre)
    {
        parent::__construct($tamano, $raza, $color, $nombre);
    }

    public function set_tamano(float $tamano): bool
    {
        if ($tamano <= 0 || $tamano > 15) {
            $this->ultimoError = "El tamaño del pájaro debe estar entre 0.1 y 15.";
            return false;
        }
        $this->tamano = $tamano;
        $this->ultimoError = '';
        return true;
    }

    public function speak(): string
    {
        return $this->nombre . ": pío pío";
    }

    public function mostrar_propiedades(): void
    {
        echo $this->nombre . " es un pájaro de especie " . $this->raza
           . ", mide " . $this->tamano
           . " y es de color " . $this->color;
    }
}
<?php
// src/Gato.php

require_once __DIR__ . '/Animal.php';

class Gato extends Animal
{
    public function __construct(float $tamano, string $raza, string $color, string $nombre)
    {
        parent::__construct($tamano, $raza, $color, $nombre);
    }

    // Validación más estricta de tamaño para gatos
    public function set_tamano(float $tamano): bool
    {
        if ($tamano <= 0 || $tamano > 30) {
            $this->ultimoError = "El tamaño del gato debe estar entre 0.1 y 30.";
            return false;
        }
        $this->tamano = $tamano;
        $this->ultimoError = '';
        return true;
    }

    public function speak(): string
    {
        return $this->nombre . ": miau";
    }

    public function mostrar_propiedades(): void
    {
        echo $this->nombre . " es un gato de raza " . $this->raza
           . ", mide " . $this->tamano
           . " y es de color " . $this->color;
    }
}
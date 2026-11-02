<?php
// src/Perro.php

require_once __DIR__ . '/Animal.php';

class Perro extends Animal
{
    // Sobreescribimos el constructor si queremos validaciones específicas
    public function __construct(float $tamano, string $raza, string $color, string $nombre)
    {
        // Llamamos al constructor del padre
        parent::__construct($tamano, $raza, $color, $nombre);
    }

    // Sobreescribimos set_tamano con límites más realistas para perros
    public function set_tamano(float $tamano): bool
    {
        if ($tamano <= 0 || $tamano > 100) {
            $this->ultimoError = "El tamaño del perro debe estar entre 0.1 y 100.";
            return false;
        }
        $this->tamano = $tamano;
        $this->ultimoError = '';
        return true;
    }

    // Sobreescribimos el método speak
    public function speak(): string
    {
        return $this->nombre . ": guau";
    }

    // También podemos sobreescribir mostrar_propiedades si queremos
    public function mostrar_propiedades(): void
    {
        echo $this->nombre . " es un perro de raza " . $this->raza
           . ", mide " . $this->tamano
           . " y es de color " . $this->color;
    }
}
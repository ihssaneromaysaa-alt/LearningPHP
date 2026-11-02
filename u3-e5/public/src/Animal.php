<?php

class Animal {
    public function __construct(
        protected float $tamano,
        protected string $raza,
        protected string $color,
        protected string $nombre,
    ) {}

    public function mostrar_propiedades(): void {
        echo $this->nombre . " es de raza " . $this->raza
           . ", su tamaño es de " . $this->tamano
           . " y es de color " . $this->color;
    }

    public function speak(): string {
        return $this->nombre . ": ...";
    }
}
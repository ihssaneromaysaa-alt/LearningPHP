<?php

namespace Models;

class Producto
{
    private int $id;
    private string $nombre;
    private float $precio;
    private int $stock;

    public function __construct(
        int $id,
        string $nombre,
        float $precio,
        int $stock
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getPrecioConIva(float $iva = 0.21): float
    {
        return $this->precio * (1 + $iva);
    }
}
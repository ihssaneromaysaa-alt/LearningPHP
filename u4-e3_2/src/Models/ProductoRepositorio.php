<?php

namespace Models;

class ProductoRepositorio
{
    private array $productos = [];

    public function __construct()
    {
        $datos = [
            ['id' => 1, 'nombre' => 'Teclado', 'precio' => 25.50, 'stock' => 10],
            ['id' => 2, 'nombre' => 'Ratón', 'precio' => 15.99, 'stock' => 20],
            ['id' => 3, 'nombre' => 'Monitor', 'precio' => 189.99, 'stock' => 5],
            ['id' => 4, 'nombre' => 'Auriculares', 'precio' => 45.00, 'stock' => 0],
            ['id' => 5, 'nombre' => 'Portátil', 'precio' => 799.99, 'stock' => 3],
            ['id' => 6, 'nombre' => 'Webcam', 'precio' => 35.75, 'stock' => 8]
        ];

        foreach ($datos as $dato) {
            $this->productos[] = new Producto(
                $dato['id'],
                $dato['nombre'],
                $dato['precio'],
                $dato['stock']
            );
        }
    }

    public function getTodos(): array
    {
        return $this->productos;
    }

    public function getValorTotalInventario(): float
    {
        $total = 0;

        foreach ($this->productos as $producto) {
            $total += $producto->getPrecio() * $producto->getStock();
        }

        return $total;
    }
}
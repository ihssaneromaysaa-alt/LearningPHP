<?php 

class Producto
{
    public string $nombre;

    #[Rango(1, 1000)]
    public float $precio;

    #[Rango(0, 100)]
    public int $stock;

    public function __construct(string $nombre, float $precio, int $stock)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }
}
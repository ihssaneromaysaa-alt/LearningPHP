<?php

namespace Controllers;

use Models\ProductoRepositorio;

class ProductoController
{
    private ProductoRepositorio $repositorio;

    public function __construct()
    {
        $this->repositorio = new ProductoRepositorio();
    }

    public function index(): void
    {
        $productos = $this->repositorio->getTodos();

        $totalProductos = count($productos);

        $valorTotalInventario =
            $this->repositorio->getValorTotalInventario();

        require VIEWS_PATH . '/productos/listado.php';
    }
}
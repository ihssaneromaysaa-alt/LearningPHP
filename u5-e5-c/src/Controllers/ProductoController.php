<?php
namespace Controllers;
class ProductoController
{
    public function mostrar(string $categoria, string $marca, string $id): void
    {
        // URL: /tienda/zapatos/nike/producto/10
        // $categoria = 'zapatos', $marca = 'nike', $id = '10'
    }
}
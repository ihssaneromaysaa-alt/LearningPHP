<?php
include_once __DIR__."/src/Producto.php";

$p1 = new Producto();
$p2 = new Producto();
$p3 = new Producto();
$p4 = new Producto();
$p5 = new Producto();

echo "cantidad de productos creados: ". Producto::obtenerCantidadProductos();
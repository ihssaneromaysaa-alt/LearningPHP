<?php 
include_once __DIR__."/src/funciones.php";
include_once __DIR__."/src/Rango.php";
include_once __DIR__."/src/Producto.php";

// Crear un producto con valores fuera de rango
$producto = new Producto("Portátil", -10, 150);

// Validar el producto
$errores = validarObjeto($producto);

// Mostrar los errores
if (empty($errores)) {
    echo "El producto es válido.";
} else {
    foreach ($errores as $error) {
        echo $error . PHP_EOL;
    }
}
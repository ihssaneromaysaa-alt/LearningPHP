<?php
declare(strict_types=1);

namespace Controllers;

use Core\Sesion;
use Core\Pages;   // si usas Pages para renderizar

class CarritoController
{
    /**
     * Muestra el formulario para añadir productos
     */
    public function index(): void
    {
        new Pages()->render('carrito/index');
    }

    /**
     * Añade un producto a la cesta (POST)
     */
    public function anadir(): void
    {
        $producto = trim($_POST['producto'] ?? '');
        $cantidad = (int)($_POST['cantidad'] ?? 0);

        if ($producto === '' || $cantidad <= 0) {
            // Puedes redirigir con un mensaje de error
            header('Location: /');
            exit;
        }

        // Recuperamos el carrito actual (o array vacío)
        $cesta = Sesion::get('productosEnCesta', []);

        // Si el producto ya existe → sumamos la cantidad
        if (isset($cesta[$producto])) {
            $cesta[$producto] += $cantidad;
        } else {
            // Si no existe → lo creamos
            $cesta[$producto] = $cantidad;
        }

        // Guardamos de nuevo en la sesión
        Sesion::set('productosEnCesta', $cesta);

        // Volvemos al formulario
        header('Location: /');
        exit;
    }

    /**
     * Muestra el contenido del carrito
     */
    public function pedidos(): void
    {
        $cesta = Sesion::get('productosEnCesta', []);

        // Pasamos la cesta a la vista
        new Pages()->render('carrito/pedidos', ['cesta' => $cesta]);
    }
}
<?php

class Producto{
    const IVA = 0.21;
    private static int $contadorObjetos = 0;
    public function __construct()
    {
        self::$contadorObjetos += 1;
    }
    public static function obtenerCantidadProductos(): int{
        return self::$contadorObjetos;
    }
}

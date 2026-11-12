<?php
declare(strict_types=1);

// primero decidimos qué mensaje mostrar (sin imprimir todavía)
if (isset($_COOKIE['ultimo_acceso'])) {
    $mensaje = "Su último acceso registrado fue el: " . $_COOKIE['ultimo_acceso'];
} else {
    $mensaje = "Es la primera vez que accede a esta sección";
}

// capturamos la fecha y hora actuales
$fechaActual = date('d/m/Y H:i:s');

// establecemos la cookie ANTES de cualquier salida
setcookie(
    'ultimo_acceso',
    $fechaActual,
    [
        'expires'  => time() + 3600,   // 1 hora exacta
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

// ahora sí, mostramos el mensaje
echo $mensaje;
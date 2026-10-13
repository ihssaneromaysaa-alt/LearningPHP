<?php declare(strict_types=1);

require_once __DIR__ . "/src/Persona.php";
require_once __DIR__ . "/src/Cliente.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba objetos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php 
    $persona=new Persona("juanito", "perez");
    $cliente=new Cliente("juanito", "perez","234");
    var_dump(__DIR__);
    var_dump($cliente);
//      Hacer: 6.1 para el jueves viernes?
//     Ejercicio propuesto:
// crea una clase CuentaBancaria y una clase hija CuentaAhorro.

// CuentaBancaria tiene:
// titular (protected, string)
// saldo (private, float, inicia en 0)
// Un constructor que recibe el titular.
// getSaldo().
// ingresar(float $cantidad): lanza una excepción si la cantidad no es positiva.
// retirar(float $cantidad): lanza una excepción si la cantidad no es positiva o si supera el saldo.
// CuentaAhorro hereda de CuentaBancaria y tiene:
// interes (private, float), recibido en el constructor.
// resumen(): devuelve una cadena con el titular y el saldo (por ejemplo, "Titular: Ana | Saldo: 500 €"). Debe usar $this->titular directamente y getSaldo() para el saldo.
// Prueba el código desde fuera de las clases e indica qué ocurre al ejecutar $cuenta->saldo y $cuenta->titular.
    ?>
</body>
</html>
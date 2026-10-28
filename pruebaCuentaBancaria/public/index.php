<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio propuesto</title>
</head>
<body>
    <?php 
    require_once __DIR__ . "/src/CuentaAhorro.php";
    $cuenta = new CuentaBancaria("manolo", 23.5);
    echo "<h2>cuenta bancaria</h2>";

    $cuenta->ingresar(100);
    echo $cuenta->getSaldo(); // 100
    echo "<br>";

    $cuenta->retirar(30);
    echo $cuenta->getSaldo(); // 70
    echo "<br>";

    $cuenta->retirar(200); // ERROR: Saldo insuficiente
    echo $cuenta->getSaldo(); // 70

    echo "<h2>cuenta ahorro</h2>";
    $cuentaA = new CuentaAhorro("manolo",234, 23.5);
    echo "<br>";

    $cuentaA->ingresar(100);
    echo $cuentaA->getSaldo();
    echo "<br>";
    $cuentaA->retirar(30);
    echo $cuentaA->getSaldo(); 
    echo "<br>";
    $cuentaA->retirar(200);
    echo $cuentaA->getSaldo();
    echo "<br>";
    echo $cuentaA->resumen();
    echo "<br>";
    ?>
</body>
</html>
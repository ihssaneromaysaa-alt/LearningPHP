<!--?php
    declare(scrict_types=1);
?-->
<?php
    include "funciones.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relación 3 arrays</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <!--h2>11. Jugando con cartas</h2-->
    <?php
    $palabras=["bastos", "copas", "espadas", "oros"];
    $palos=crearBarajaCompleta($palabras);
    barajarBaraja($palos);
    //print_r($palos);
    //var_dump(sacarCarta($palos));
    //var_dump($palos);
    mostrarCarta(sacarCarta($palos));
    ?>
</body>
</html>